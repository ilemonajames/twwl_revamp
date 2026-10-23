<?php

namespace Tests\Feature;

use App\Models\PaymentAttempt;
use App\Models\Product;
use App\Models\Program;
use App\Models\ProgramFee;
use App\Models\User;
use App\Services\BookingService;
use App\Services\CheckoutService;
use App\Services\SquarePaymentService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class BookingAndPaymentTest extends TestCase
{
    use RefreshDatabase;

    private function program(): Program
    {
        $program = Program::create(['program_title' => 'Counselling', 'program_image' => '']);
        ProgramFee::create(['program_id' => $program->id, 'program_fees' => '20.50', 'session_fees' => '10.25', 'consultation_fees' => '5.00', 'duration' => '2 hours']);

        return $program;
    }

    private function attempt(): PaymentAttempt
    {
        $program = $this->program();
        $appointment = app(BookingService::class)->reserve([
            'program_id' => $program->id, 'appointment_date' => now()->addDays(2)->toDateString(), 'appointment_time' => '10:00',
        ], User::factory()->create()->id, true);

        return PaymentAttempt::create(['id' => (string) Str::uuid(), 'appointment_id' => $appointment->id, 'amount_minor' => 3575, 'currency' => 'USD']);
    }

    private function payment(PaymentAttempt $attempt, array $changes = []): array
    {
        return array_replace_recursive([
            'id' => 'provider-payment', 'reference_id' => $attempt->id, 'location_id' => 'location',
            'status' => 'COMPLETED', 'amount_money' => ['amount' => 3575, 'currency' => 'USD'],
        ], $changes);
    }

    protected function setUp(): void
    {
        parent::setUp();
        config(['services.square.location_id' => 'location', 'services.square.access_token' => 'test-key']);
    }

    public function test_guest_booking_ignores_submitted_amount_and_does_not_mark_paid(): void
    {
        $program = $this->program();
        $this->post('/booking', [
            'program' => $program->id, 'date' => now()->addDays(2)->toDateString(), 'time' => '10:00',
            'name' => 'Guest', 'email' => 'guest@example.com', 'phone' => '12345678', 'amount' => '0.01',
        ])->assertRedirect(route('booking.success'));
        $this->assertDatabaseHas('appointments', ['name' => 'Guest', 'user_id' => null, 'service_id' => null, 'status' => 'pending', 'amount_minor' => 3575]);
    }

    public function test_overlapping_reservations_are_rejected_and_expired_unpaid_holds_release(): void
    {
        $attempt = $this->attempt();
        $appointment = $attempt->appointment;
        $data = ['program_id' => $appointment->program_id, 'appointment_date' => $appointment->appointment_date->toDateString(), 'appointment_time' => '11:00'];
        try {
            app(BookingService::class)->reserve($data, null);
            $this->fail('Overlapping reservation accepted.');
        } catch (ValidationException $e) {
            $this->assertArrayHasKey('appointment_time', $e->errors());
        }
        $appointment->update(['reserved_until' => now()->subMinute()]);
        $second = app(BookingService::class)->reserve($data, null);
        $this->assertNotSame($appointment->id, $second->id);
    }

    public function test_cart_is_repriced_from_database_and_order_is_frozen_on_retry(): void
    {
        config(['cart.tax' => 0]);
        $product = Product::create(['product_name' => 'Book', 'description' => 'Book', 'price' => '12.34', 'photo' => '']);
        Cart::instance('cart')->add($product->id, 'Forged title', 2, 0.01);
        $id = (string) Str::uuid();
        $billing = ['name' => 'Buyer', 'email' => 'buyer@example.com', 'address' => 'Address'];
        $attempt = app(CheckoutService::class)->prepare($id, $billing);
        $this->assertSame(2468, $attempt->amount_minor);
        $product->update(['price' => '99.00']);
        $retry = app(CheckoutService::class)->prepare($id, $billing);
        $this->assertSame(2468, $retry->amount_minor);
        $this->assertDatabaseCount('orders', 1);
    }

    public function test_wrong_payment_amount_does_not_mark_appointment_paid(): void
    {
        $attempt = $this->attempt();
        try {
            app(SquarePaymentService::class)->reconcile($this->payment($attempt, ['amount_money' => ['amount' => 1]]));
            $this->fail('Mismatched amount accepted.');
        } catch (ValidationException $e) {
            $this->assertSame('pending_payment', $attempt->appointment->fresh()->status);
        }
    }

    public function test_verified_completion_is_idempotent_and_cannot_be_undone_by_late_events(): void
    {
        $attempt = $this->attempt();
        $service = app(SquarePaymentService::class);
        $service->reconcile($this->payment($attempt));
        $service->reconcile($this->payment($attempt));
        $service->reconcile($this->payment($attempt, ['status' => 'FAILED']));
        $this->assertSame('Paid', $attempt->appointment->fresh()->status);
        $this->assertSame('completed', $attempt->fresh()->status);
    }

    public function test_forged_webhook_is_rejected_and_signed_replay_is_processed_once(): void
    {
        config(['services.square.webhook_signature_key' => 'signature-key', 'services.square.webhook_notification_url' => 'https://example.com/square/webhook']);
        $attempt = $this->attempt();
        $payload = ['event_id' => 'event-1', 'type' => 'payment.updated', 'data' => ['object' => ['payment' => $this->payment($attempt)]]];
        $this->postJson('/square/webhook', $payload)->assertForbidden();
        $body = json_encode($payload);
        $signature = base64_encode(hash_hmac('sha256', 'https://example.com/square/webhook'.$body, 'signature-key', true));
        for ($i = 0; $i < 2; $i++) {
            $this->call('POST', '/square/webhook', [], [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_X_SQUARE_HMACSHA256_SIGNATURE' => $signature], $body)->assertNoContent();
        }
        $this->assertDatabaseCount('payment_webhook_events', 1);
        $this->assertSame('Paid', $attempt->appointment->fresh()->status);
    }

    public function test_provider_request_uses_recorded_price_and_repeat_does_not_charge_again(): void
    {
        $attempt = $this->attempt();
        $payment = new \Square\Models\Payment;
        $payment->setId('provider-payment');
        $payment->setReferenceId($attempt->id);
        $payment->setLocationId('location');
        $payment->setStatus('COMPLETED');
        $money = new \Square\Models\Money;
        $money->setAmount(3575);
        $money->setCurrency('USD');
        $payment->setAmountMoney($money);
        $result = new \Square\Models\CreatePaymentResponse;
        $result->setPayment($payment);
        $response = \Mockery::mock(\Square\Http\ApiResponse::class);
        $response->shouldReceive('isSuccess')->andReturn(true);
        $response->shouldReceive('getResult')->andReturn($result);
        $api = \Mockery::mock(\Square\Apis\PaymentsApi::class);
        $api->shouldReceive('createPayment')->once()->withArgs(function ($body) use ($attempt) {
            return $body instanceof \Square\Models\CreatePaymentRequest
                && $body->getSourceId() === 'card-token'
                && $body->getIdempotencyKey() === $attempt->id
                && $body->getAmountMoney()->getAmount() === 3575;
        })->andReturn($response);
        $client = \Mockery::mock(\Square\SquareClient::class);
        $client->shouldReceive('getPaymentsApi')->once()->andReturn($api);
        $this->app->instance(\Square\SquareClient::class, $client);
        app(SquarePaymentService::class)->charge($attempt, 'card-token');
        app(SquarePaymentService::class)->charge($attempt, 'card-token');
        $this->assertSame('Paid', $attempt->appointment->fresh()->status);
    }

    public function test_expired_reservation_cannot_be_charged(): void
    {
        $attempt = $this->attempt();
        $attempt->appointment->update(['reserved_until' => now()->subMinute()]);
        $this->expectException(ValidationException::class);
        app(SquarePaymentService::class)->charge($attempt, 'card-token');
    }

    public function test_rescheduling_cannot_overlap_another_booking(): void
    {
        $attempt = $this->attempt();
        $date = $attempt->appointment->appointment_date->toDateString();
        $other = app(BookingService::class)->reserve([
            'program_id' => $attempt->appointment->program_id,
            'appointment_date' => $date, 'appointment_time' => '14:00',
        ], null);
        $this->expectException(ValidationException::class);
        app(BookingService::class)->reschedule($other, [
            'appointment_date' => $date, 'appointment_time' => '11:00',
            'consulation_link' => 'https://example.com/meeting',
        ]);
    }

    public function test_overlaps_across_midnight_are_rejected(): void
    {
        $program = $this->program();
        $date = now()->addDays(2);
        app(BookingService::class)->reserve([
            'program_id' => $program->id, 'appointment_date' => $date->toDateString(), 'appointment_time' => '23:00',
        ], null);
        $this->expectException(ValidationException::class);
        app(BookingService::class)->reserve([
            'program_id' => $program->id, 'appointment_date' => $date->addDay()->toDateString(), 'appointment_time' => '00:30',
        ], null);
    }

    public function test_completed_webhook_writes_client_history_only_once(): void
    {
        $attempt = $this->attempt();
        app(SquarePaymentService::class)->reconcile($this->payment($attempt));
        app(SquarePaymentService::class)->reconcile($this->payment($attempt));
        $this->assertDatabaseCount('payments', 1);
        $this->assertDatabaseHas('payments', ['appointment_id' => $attempt->appointment_id, 'amount' => 35.75, 'transaction_id' => 'provider-payment']);
    }

    public function test_program_with_history_cannot_be_deleted(): void
    {
        $attempt = $this->attempt();
        $this->actingAs(User::factory()->create(['user_type' => 'Website Admin']))
            ->delete('/website-admin/programs/'.$attempt->appointment->program_id.'/delete')
            ->assertSessionHasErrors('program');
        $this->assertModelExists($attempt->appointment->program);
    }

    public function test_unused_program_and_its_pricing_can_be_deleted(): void
    {
        $program = $this->program();
        $this->actingAs(User::factory()->create(['user_type' => 'Website Admin']))
            ->delete('/website-admin/programs/'.$program->id.'/delete')->assertRedirect(route('programs.index'));
        $this->assertModelMissing($program);
        $this->assertDatabaseMissing('program_fees', ['program_id' => $program->id]);
    }

    public function test_account_with_history_returns_a_validation_error_on_deletion(): void
    {
        $attempt = $this->attempt();
        $user = $attempt->appointment->user;
        $this->actingAs($user)->delete('/profile', ['password' => 'password'])
            ->assertSessionHasErrorsIn('userDeletion', 'password');
        $this->assertModelExists($user);
    }

    public function test_unpaid_reservation_can_be_cancelled_without_charging(): void
    {
        $attempt = $this->attempt();
        session(['booking_attempt_id' => $attempt->id]);
        \Livewire\Livewire::actingAs($attempt->appointment->user)
            ->test(\App\Livewire\Client\ConsulationBooking::class)
            ->call('cancelUnpaidReservation')->assertHasNoErrors();
        $this->assertSame('cancelled', $attempt->appointment->fresh()->status);
        $this->assertSame('failed', $attempt->fresh()->status);
    }

    public function test_processing_payment_cannot_be_cancelled_to_release_its_slot(): void
    {
        $attempt = $this->attempt();
        $attempt->update(['status' => 'processing']);
        $attempt->appointment->update(['status' => 'payment_processing']);
        session(['booking_attempt_id' => $attempt->id]);
        \Livewire\Livewire::actingAs($attempt->appointment->user)
            ->test(\App\Livewire\Client\ConsulationBooking::class)
            ->call('cancelUnpaidReservation')->assertHasErrors('payment');
        $this->assertSame('payment_processing', $attempt->appointment->fresh()->status);
    }

    public function test_timeout_keeps_attempt_for_review_and_does_not_mark_paid(): void
    {
        $attempt = $this->attempt();
        $api = \Mockery::mock(\Square\Apis\PaymentsApi::class);
        $api->shouldReceive('createPayment')->once()->andThrow(new \RuntimeException('private provider detail'));
        $client = \Mockery::mock(\Square\SquareClient::class);
        $client->shouldReceive('getPaymentsApi')->andReturn($api);
        $this->app->instance(\Square\SquareClient::class, $client);
        try {
            app(SquarePaymentService::class)->charge($attempt, 'card-token');
            $this->fail('Timeout was ignored.');
        } catch (ValidationException $e) {
            $this->assertStringNotContainsString('private provider detail', $e->getMessage());
            $this->assertSame('review', $attempt->fresh()->status);
            $this->assertSame('payment_review', $attempt->appointment->fresh()->status);
        }
    }
}
