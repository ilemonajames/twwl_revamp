<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Order;
use App\Models\PaymentAttempt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Square\Models\CreatePaymentRequest;
use Square\Models\Money;
use Square\SquareClient;

class SquarePaymentService
{
    public function charge(PaymentAttempt $attempt, string $token): PaymentAttempt
    {
        if (! config('services.square.access_token') || ! config('services.square.location_id')) {
            throw ValidationException::withMessages(['payment' => 'Payments are currently unavailable. Please contact support.']);
        }
        if ($token === '' || strlen($token) > 512) {
            throw ValidationException::withMessages(['payment' => 'Please enter valid payment details.']);
        }
        if (RateLimiter::tooManyAttempts('payment:'.request()->ip(), 10)) {
            throw ValidationException::withMessages(['payment' => 'Too many payment attempts. Please try again later.']);
        }
        RateLimiter::hit('payment:'.request()->ip(), 60);
        // Claim the attempt before the network call, preventing simultaneous token changes.
        $attempt = DB::transaction(function () use ($attempt, $token) {
            $locked = PaymentAttempt::lockForUpdate()->findOrFail($attempt->id);
            if (in_array($locked->status, ['completed', 'failed'], true)) {
                return $locked;
            }
            if ($locked->source_hash && ! hash_equals($locked->source_hash, hash('sha256', $token))) {
                throw ValidationException::withMessages(['payment' => 'This payment is already being processed. Please check its status before trying another card.']);
            }
            if ($locked->appointment_id) {
                $date = Appointment::findOrFail($locked->appointment_id)->appointment_date->toDateString();
                app(BookingService::class)->lockCalendarDates([$date]);
                $appointment = Appointment::lockForUpdate()->findOrFail($locked->appointment_id);
                if ($appointment->status === 'pending_payment' && $appointment->reserved_until?->isPast()) {
                    throw ValidationException::withMessages(['payment' => 'Your reservation expired. Please book another time.']);
                }
                if (! in_array($appointment->status, ['pending_payment', 'payment_processing', 'payment_review'], true)) {
                    throw ValidationException::withMessages(['payment' => 'This appointment cannot be charged.']);
                }
                $appointment->update(['status' => 'payment_processing']);
            }
            $locked->update(['source_hash' => hash('sha256', $token), 'status' => 'processing']);

            return $locked;
        });
        if (in_array($attempt->status, ['completed', 'failed'], true)) {
            return $attempt;
        }
        $money = new Money;
        $money->setAmount($attempt->amount_minor);
        $money->setCurrency($attempt->currency);
        $body = new CreatePaymentRequest($token, $attempt->id);
        $body->setAmountMoney($money);
        $body->setReferenceId($attempt->id);
        $body->setLocationId(config('services.square.location_id'));
        $body->setAutocomplete(true);
        try {
            $response = app(SquareClient::class)->getPaymentsApi()->createPayment($body);
            if (! $response->isSuccess() || ! $response->getResult()?->getPayment()) {
                // Errors/timeouts can be ambiguous. Keep the same idempotency key for reconciliation.
                $this->review($attempt);
                throw ValidationException::withMessages(['payment' => 'Payment could not be confirmed. Please check its status before paying again.']);
            }
            $payment = $response->getResult()->getPayment();
            $this->reconcile([
                'id' => $payment->getId(),
                'reference_id' => $payment->getReferenceId(),
                'location_id' => $payment->getLocationId(),
                'status' => $payment->getStatus(),
                'amount_money' => ['amount' => $payment->getAmountMoney()?->getAmount(), 'currency' => $payment->getAmountMoney()?->getCurrency()],
            ]);
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Throwable $e) {
            $this->review($attempt);
            // Never log request bodies or card tokens.
            \Log::warning('Square payment requires reconciliation', ['attempt_id' => $attempt->id, 'exception' => get_class($e)]);
            throw ValidationException::withMessages(['payment' => 'Payment confirmation is delayed. Please check its status before paying again.']);
        }

        return $attempt->fresh();
    }

    private function review(PaymentAttempt $attempt): void
    {
        DB::transaction(function () use ($attempt) {
            $locked = PaymentAttempt::lockForUpdate()->findOrFail($attempt->id);
            if (! in_array($locked->status, ['completed', 'failed'], true)) {
                $locked->update(['status' => 'review']);
                Appointment::whereKey($locked->appointment_id)->where('status', 'payment_processing')->update(['status' => 'payment_review']);
            }
        });
    }

    // Called only with an authenticated API response or a signature-verified webhook.
    public function reconcile(array $payment): void
    {
        DB::transaction(function () use ($payment) {
            $attempt = PaymentAttempt::whereKey($payment['reference_id'] ?? '')->lockForUpdate()->first();
            if (! $attempt) {
                return; // Payments outside this checkout are not attached by guessed user/email.
            }
            if (empty($payment['id'])
                || ($payment['location_id'] ?? null) !== config('services.square.location_id')
                || ($payment['amount_money']['amount'] ?? null) !== $attempt->amount_minor
                || ($payment['amount_money']['currency'] ?? null) !== $attempt->currency
                || ($attempt->provider_id && $attempt->provider_id !== $payment['id'])) {
                throw ValidationException::withMessages(['payment' => 'Payment details did not match the recorded purchase.']);
            }
            if ($attempt->status === 'completed') {
                return; // Late/duplicate events cannot undo fulfillment.
            }
            $status = match ($payment['status'] ?? '') {
                'COMPLETED' => 'completed',
                'FAILED', 'CANCELED' => 'failed',
                default => 'processing',
            };
            $attempt->update(['provider_id' => $payment['id'], 'status' => $status]);
            if ($attempt->appointment_id) {
                Appointment::whereKey($attempt->appointment_id)->update(['status' => match ($status) {
                    'completed' => 'Paid', 'failed' => 'failed', default => 'payment_processing',
                }]);
                if ($status === 'completed') {
                    $appointment = Appointment::findOrFail($attempt->appointment_id);
                    \App\Models\Payment::firstOrCreate(['transaction_id' => $payment['id']], [
                        'user_id' => $appointment->user_id, 'appointment_id' => $appointment->id,
                        'program_id' => $appointment->program_id, 'service_id' => $appointment->service_id,
                        'payment_type' => 'program', 'amount' => $attempt->amount_minor / 100,
                        'payment_status' => 'Paid', 'payment_method' => 'Square',
                        'transaction_status' => 'COMPLETED', 'transaction_currency' => $attempt->currency,
                    ]);
                }
            }
            if ($attempt->order_id) {
                Order::whereKey($attempt->order_id)->update(['status' => $status === 'completed' ? 'paid' : $status]);
            }
        });
    }
}
