<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    public function test_recovery_form_is_usable_without_captcha_and_displays_errors(): void
    {
        $this->get('/forgot-password')->assertOk()
            ->assertSee('action="'.route('password.email').'"', false)
            ->assertDontSee('g-recaptcha')->assertDontSee('disabled');
        $this->from('/forgot-password')->post('/forgot-password', ['email' => 'not-an-email'])
            ->assertRedirect('/forgot-password')->assertSessionHasErrors('email');
        $this->get('/forgot-password')->assertSee('reset-email-error');
    }

    public function test_transport_failure_returns_safe_visible_error(): void
    {
        \Illuminate\Support\Facades\Password::shouldReceive('sendResetLink')->once()
            ->andThrow(new \Symfony\Component\Mailer\Exception\TransportException('private-smtp-secret'));
        $this->from('/forgot-password')->post('/forgot-password', ['email' => 'test@example.com'])
            ->assertRedirect('/forgot-password')->assertSessionHasErrors('email');
        $this->get('/forgot-password')->assertSee('We could not send your reset email')->assertDontSee('private-smtp-secret');
    }

    public function test_email_is_normalized_before_requesting_reset(): void
    {
        Notification::fake();
        $user = User::factory()->create(['email' => 'test@example.com']);
        $this->post('/forgot-password', ['email' => ' TEST@EXAMPLE.COM '])->assertSessionHasNoErrors();
        Notification::assertSentTo($user, ResetPassword::class);
    }

    public function test_reset_password_link_screen_can_be_rendered(): void
    {
        $response = $this->get('/forgot-password');

        $response->assertStatus(200);
    }

    public function test_reset_password_link_can_be_requested(): void
    {
        Notification::fake();

        $user = User::factory()->create();

        $this->post('/forgot-password', ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class);
    }

    public function test_reset_password_screen_can_be_rendered(): void
    {
        Notification::fake();

        $user = User::factory()->create();

        $this->post('/forgot-password', ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) {
            $response = $this->get('/reset-password/'.$notification->token);

            $response->assertStatus(200);

            return true;
        });
    }

    public function test_password_can_be_reset_with_valid_token(): void
    {
        Notification::fake();

        $user = User::factory()->create();

        $this->post('/forgot-password', ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
            $response = $this->post('/reset-password', [
                'token' => $notification->token,
                'email' => $user->email,
                'password' => 'password',
                'password_confirmation' => 'password',
            ]);

            $response
                ->assertSessionHasNoErrors()
                ->assertRedirect(route('login'));

            return true;
        });
    }
}
