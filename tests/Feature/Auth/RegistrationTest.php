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

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
