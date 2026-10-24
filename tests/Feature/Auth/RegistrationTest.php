<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('id="submit-btn">Create account', false);
    }

    public function test_registration_still_requires_server_side_captcha(): void
    {
        $this->post('/register', ['surname' => 'Test', 'othernames' => 'Client', 'email' => 'client@example.com', 'phoneno' => '123456'])
            ->assertSessionHasErrors('g-recaptcha-response');
        $this->assertDatabaseCount('users', 0);
    }

    public function test_captcha_settings_use_configuration(): void
    {
        config(['services.recaptcha.site_key' => 'configured-public-key', 'services.recaptcha.secret_key' => 'configured-secret']);
        $this->get('/register')->assertSee('configured-public-key')->assertDontSee('configured-secret');
        \Illuminate\Support\Facades\Http::fake(['www.google.com/*' => \Illuminate\Support\Facades\Http::response(['success' => false])]);
        $this->post('/register', ['surname' => 'Test', 'othernames' => 'Client', 'email' => 'client@example.com', 'phoneno' => '123456', 'g-recaptcha-response' => 'test-token'])
            ->assertSessionHasErrors('g-recaptcha-response');
        \Illuminate\Support\Facades\Http::assertSent(fn ($request) => $request['secret'] === 'configured-secret');
    }

    public function test_new_users_can_register(): void
    {
        \Illuminate\Support\Facades\Http::fake(['www.google.com/recaptcha/api/siteverify' => \Illuminate\Support\Facades\Http::response(['success' => true])]);
        $response = $this->post('/register', [
            'surname' => 'User',
            'othernames' => 'Test',
            'phoneno' => '08012345678',
            'g-recaptcha-response' => 'test-token',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertGuest();
        $response->assertRedirect(route('login'));
        $this->assertDatabaseHas('users', ['email' => 'test@example.com', 'password_setup_required' => true, 'email_verified_at' => null]);
    }
}
