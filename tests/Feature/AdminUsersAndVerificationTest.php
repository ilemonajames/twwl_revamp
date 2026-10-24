<?php

namespace Tests\Feature;

use App\Livewire\WebsiteAdmin\Users\UsersComponent;
use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use Tests\TestCase;

class AdminUsersAndVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_verification_screen_uses_site_layout_and_resend_and_logout_work(): void
    {
        Notification::fake();
        $user = User::factory()->unverified()->create();
        $this->actingAs($user)->get('/verify-email')->assertOk()
            ->assertSee('site-auth-card')->assertSee('action="'.route('verification.send').'"', false)
            ->assertSee('action="'.route('logout').'"', false);
        $this->from('/verify-email')->post(route('verification.send'))->assertSessionHas('status', 'verification-link-sent');
        Notification::assertSentTo($user, VerifyEmail::class);
        $this->post(route('logout'))->assertRedirect('/');
        $this->assertGuest();
    }

    public function test_verification_mail_failure_is_reported_safely(): void
    {
        $user = User::factory()->unverified()->create();
        Notification::shouldReceive('send')->once()->andThrow(new \Symfony\Component\Mailer\Exception\TransportException('private-smtp-error'));
        $this->actingAs($user)->from('/verify-email')->post(route('verification.send'))->assertRedirect('/verify-email')->assertSessionHasErrors('email');
        $this->get('/verify-email')->assertSee('The verification email could not be sent')->assertDontSee('private-smtp-error');
    }

    public function test_directory_is_restricted_to_verified_active_administrators(): void
    {
        $this->get(route('websiteadmin.users'))->assertRedirect(route('login'));
        $this->actingAs(User::factory()->create())->get(route('websiteadmin.users'))->assertForbidden();
        $this->actingAs(User::factory()->unverified()->create(['user_type' => 'Website Admin']))->get(route('websiteadmin.users'))->assertRedirect(route('verification.notice'));
        $this->actingAs(User::factory()->create(['user_type' => 'Website Admin', 'status' => 'Disabled']))->get(route('websiteadmin.users'))->assertForbidden();
        foreach (['Website Admin', 'Super Admin'] as $role) {
            $this->actingAs(User::factory()->create(['user_type' => $role]))->get(route('websiteadmin.users'))->assertOk();
        }
    }

    public function test_admin_can_search_and_filter_without_exposing_passwords(): void
    {
        $admin = User::factory()->create(['user_type' => 'Website Admin', 'email' => 'administrator@example.com']);
        $client = User::factory()->create(['surname' => 'CustomerUnique', 'email' => 'customer@example.com']);
        $this->actingAs($admin);
        Livewire::test(UsersComponent::class)->assertSee('customer@example.com')->assertDontSee($client->password)
            ->set('search', 'no-such-user')->assertSee('No users match your search.')
            ->set('search', '')->set('type', 'Website Admin')->assertSee('administrator@example.com')->assertDontSee('customer@example.com');
    }

    public function test_client_cannot_access_directory_component_directly(): void
    {
        $this->actingAs(User::factory()->create());
        Livewire::test(UsersComponent::class)->assertForbidden();
    }
}
