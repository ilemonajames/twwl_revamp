<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\User;
use App\Notifications\BookingReceived;
use App\Notifications\SetUpPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class OnboardingAndBookingMailTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_requires_emailed_password_setup_before_login(): void
    {
        Notification::fake();
        Http::fake(['www.google.com/*' => Http::response(['success' => true])]);
        $this->post('/register', ['surname' => 'Test', 'othernames' => 'Client', 'phoneno' => '123456789', 'email' => 'new@example.com', 'g-recaptcha-response' => 'test'])->assertRedirect(route('login'));
        $user = User::where('email', 'new@example.com')->firstOrFail();
        $this->assertGuest();
        Notification::assertSentTo($user, SetUpPassword::class, function ($mail) use ($user) {
            $this->get(route('password.reset', ['token' => $mail->token, 'email' => $user->email]))->assertOk();
            $data = ['email' => $user->email, 'token' => $mail->token, 'password' => 'new-password-123', 'password_confirmation' => 'new-password-123'];
            $this->post('/reset-password', $data)->assertSessionHasNoErrors()->assertRedirect(route('login'));
            $this->assertFalse($user->fresh()->password_setup_required);
            $this->assertTrue($user->fresh()->hasVerifiedEmail());
            $this->assertTrue(Hash::check('new-password-123', $user->fresh()->password));
            $this->post('/reset-password', $data)->assertSessionHasErrors('email');
            return true;
        });
        $this->post('/login', ['email' => $user->email, 'password' => 'new-password-123'])->assertSessionHasNoErrors();
        $this->assertAuthenticatedAs($user);
    }

    public function test_expired_setup_token_cannot_activate_account_and_resend_uses_setup_email(): void
    {
        Notification::fake();
        $user = User::factory()->unverified()->create();
        $user->forceFill(['password_setup_required' => true])->save();
        $token = Password::createToken($user);
        $this->travel(61)->minutes();
        $this->post('/reset-password', ['email' => $user->email, 'token' => $token, 'password' => 'new-password-123', 'password_confirmation' => 'new-password-123'])->assertSessionHasErrors('email');
        $this->assertTrue($user->fresh()->password_setup_required);
        $this->assertFalse($user->fresh()->hasVerifiedEmail());
        $this->post('/forgot-password', ['email' => $user->email]);
        Notification::assertSentTo($user, SetUpPassword::class);
    }

    public function test_normal_reset_does_not_verify_existing_unverified_user(): void
    {
        $user = User::factory()->unverified()->create();
        $this->post('/reset-password', ['email' => $user->email, 'token' => Password::createToken($user), 'password' => 'new-password-123', 'password_confirmation' => 'new-password-123'])->assertSessionHasNoErrors();
        $this->assertFalse($user->fresh()->hasVerifiedEmail());
    }

    public function test_acknowledgement_routes_to_guest_or_client_and_not_on_updates(): void
    {
        Notification::fake();
        $data = ['appointment_date' => now()->addDays(2)->toDateString(), 'appointment_time' => '10:00', 'status' => 'pending'];
        $guest = Appointment::create($data + ['email' => 'guest@example.com']);
        $client = User::factory()->create();
        Appointment::create($data + ['user_id' => $client->id]);
        $guest->update(['status' => 'Paid']);
        Notification::assertSentOnDemand(BookingReceived::class, fn ($mail, $channels, $recipient) => $recipient->routes['mail'] === 'guest@example.com' && str_contains(implode(' ', $mail->toMail($recipient)->introLines), 'once payment has been received and verified'));
        Notification::assertSentOnDemand(BookingReceived::class, fn ($mail, $channels, $recipient) => $recipient->routes['mail'] === $client->email);
        foreach (['booking@thewaywelove.com', 'thewaywelove24@gmail.com'] as $recipientEmail) {
            Notification::assertSentOnDemandTimes(\App\Notifications\StaffBookingReceived::class, 4);
            Notification::assertSentOnDemand(\App\Notifications\StaffBookingReceived::class, fn ($mail, $channels, $recipient) => $recipient->routes['mail'] === $recipientEmail && $mail->appointmentId === $guest->id);
        }
        Notification::assertCount(6);
    }

    public function test_staff_are_notified_for_online_booking_even_without_customer_email(): void
    {
        Notification::fake();
        $appointment = Appointment::create(['appointment_date' => now()->addDays(2)->toDateString(), 'appointment_time' => '10:00', 'status' => 'pending_payment']);
        foreach (['booking@thewaywelove.com', 'thewaywelove24@gmail.com'] as $email) {
            Notification::assertSentOnDemand(\App\Notifications\StaffBookingReceived::class, fn ($mail, $channels, $recipient) => $recipient->routes['mail'] === $email && $mail->appointmentId === $appointment->id);
        }
        Notification::assertNotSentTo(new \Illuminate\Notifications\AnonymousNotifiable, BookingReceived::class);
        Notification::assertCount(2);
    }
}
