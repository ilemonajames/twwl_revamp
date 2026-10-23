<?php

namespace App\Livewire\Client;

use App\Models\Appointment;
use App\Models\PaymentAttempt;
use App\Models\ProgramFee;
use App\Services\BookingService;
use App\Services\SquarePaymentService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;
use Livewire\Component;

class ConsulationBooking extends Component
{
    public $selApp;

    public $program;

    public $ap_date;

    public $ap_time;

    public $comment;

    public $total_amount;

    #[Locked]
    public ?int $reservationId = null;

    #[Locked]
    public ?string $attemptId = null;

    public function mount(): void
    {
        $this->authorizeClient();
        $id = session('booking_attempt_id');
        $attempt = $id ? PaymentAttempt::with('appointment')->find($id) : null;
        if ($attempt?->appointment?->user_id === auth()->id()) {
            $this->attemptId = $attempt->id;
            $this->reservationId = $attempt->appointment_id;
            $this->program = $attempt->appointment->program_id;
            $this->ap_date = $attempt->appointment->appointment_date->toDateString();
            $this->ap_time = substr($attempt->appointment->appointment_time, 0, 5);
            $this->comment = $attempt->appointment->comment;
            $this->total_amount = $attempt->amount_minor / 100;
            $this->updatedProgram();
        }
    }

    private function authorizeClient(): void
    {
        abort_unless(auth()->user()?->user_type === 'Client'
            && auth()->user()?->status === 'Active'
            && auth()->user()?->hasVerifiedEmail(), 403);
    }

    public function updatedProgram(): void
    {
        $this->selApp = ProgramFee::where('program_id', $this->program)->first();
    }

    public function bookConsulation()
    {
        $this->authorizeClient();
        if (! $this->reservationId) {
            $data = $this->validate([
                'program' => 'required|uuid|exists:programs,id',
                'ap_date' => 'required|date_format:Y-m-d|after:today',
                'ap_time' => 'required|date_format:H:i',
                'comment' => 'nullable|string|max:2000',
            ]);
            $appointment = DB::transaction(function () use ($data) {
                $appointment = app(BookingService::class)->reserve([
                    'program_id' => $data['program'], 'appointment_date' => $data['ap_date'],
                    'appointment_time' => $data['ap_time'], 'comment' => $data['comment'],
                ], auth()->id(), true);
                $attempt = PaymentAttempt::create([
                    'id' => (string) Str::uuid(), 'appointment_id' => $appointment->id,
                    'amount_minor' => $appointment->amount_minor,
                    'currency' => config('services.square.currency', 'USD'),
                ]);
                $this->attemptId = $attempt->id;

                return $appointment;
            });
            $this->reservationId = $appointment->id;
            $this->total_amount = $appointment->amount_minor / 100;
            session()->put('booking_attempt_id', $this->attemptId);
        }
        $this->dispatch('payment', payment: 'payment');
    }

    public function processPayment(string $token)
    {
        $this->authorizeClient();
        abort_unless($this->attemptId && $this->reservationId, 422);
        $attempt = PaymentAttempt::whereKey($this->attemptId)
            ->where('appointment_id', $this->reservationId)->firstOrFail();
        abort_unless(Appointment::whereKey($this->reservationId)->where('user_id', auth()->id())->exists(), 403);
        $attempt = app(SquarePaymentService::class)->charge($attempt, $token);
        if ($attempt->status === 'completed') {
            session()->forget('booking_attempt_id');

            return redirect()->route('client.bookings')->with('feedback', 'Payment confirmed. Your appointment has been booked.');
        }
        $this->addError('payment', 'Payment has not completed. Please check its status before trying again.');
    }

    public function render()
    {
        return view('livewire.client.consulation-booking');
    }

    public function cancelUnpaidReservation(): void
    {
        $this->authorizeClient();
        abort_unless($this->attemptId && $this->reservationId, 422);
        DB::transaction(function () {
            $attempt = PaymentAttempt::lockForUpdate()->findOrFail($this->attemptId);
            $appointment = $attempt->appointment;
            abort_unless($appointment?->user_id === auth()->id() && $appointment->id === $this->reservationId, 403);
            if (! in_array($attempt->status, ['pending', 'failed'], true) || ($attempt->status === 'pending' && $attempt->source_hash)) {
                throw \Illuminate\Validation\ValidationException::withMessages(['payment' => 'This payment needs confirmation before the reservation can be cancelled.']);
            }
            app(BookingService::class)->lockCalendarDates([$appointment->appointment_date->toDateString()]);
            $appointment->update(['status' => 'cancelled']);
            $attempt->update(['status' => 'failed']);
        });
        session()->forget('booking_attempt_id');
        $this->reset('reservationId', 'attemptId', 'total_amount');
    }
}
