<?php

namespace Tests\Feature;

use App\Livewire\Client\ConsulationBooking;
use App\Livewire\WebsiteAdmin\Programs\ProgramListComponent;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Livewire\Livewire;
use Tests\TestCase;

class SecurityRegressionTest extends TestCase
{
    use RefreshDatabase;

    public function test_legacy_password_change_requires_a_token_and_preserves_account_state(): void
    {
        $user = User::factory()->unverified()->create(['status' => 'Disabled']);
        $this->post('/change-password', ['email' => $user->email, 'password' => 'new-password', 'password_confirmation' => 'new-password'])
            ->assertSessionHasErrors('token');
        $this->assertTrue(Hash::check('password', $user->fresh()->password));
        $token = Password::createToken($user);
        $this->post('/change-password', ['email' => $user->email, 'token' => $token, 'password' => 'new-password', 'password_confirmation' => 'new-password'])
            ->assertRedirect(route('login'));
        $this->assertTrue(Hash::check('new-password', $user->fresh()->password));
        $this->assertNull($user->fresh()->email_verified_at);
        $this->assertSame('Disabled', $user->fresh()->status);
        $this->post('/change-password', ['email' => $user->email, 'token' => $token, 'password' => 'another-password', 'password_confirmation' => 'another-password'])
            ->assertSessionHasErrors('email');
    }

    public function test_reset_rejects_invalid_expired_and_other_users_tokens(): void
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $token = Password::createToken($user);
        foreach ([['email' => $user->email, 'token' => 'invalid'], ['email' => $other->email, 'token' => $token]] as $data) {
            $this->post('/change-password', $data + ['password' => 'new-password', 'password_confirmation' => 'new-password'])
                ->assertSessionHasErrors('email');
        }
        $this->travel(61)->minutes();
        $this->post('/change-password', ['email' => $user->email, 'token' => $token, 'password' => 'new-password', 'password_confirmation' => 'new-password'])
            ->assertSessionHasErrors('email');
        $this->assertTrue(Hash::check('password', $user->fresh()->password));
    }

    public function test_service_writes_require_an_active_verified_administrator(): void
    {
        $service = Service::create(['service_title' => 'Original', 'service_description' => 'Description', 'service_image' => '', 'price' => '12.00']);
        $this->delete('/services/'.$service->id)->assertRedirect(route('login'));
        $this->actingAs(User::factory()->create())->delete('/services/'.$service->id)->assertForbidden();
        $this->assertModelExists($service);
        $admin = User::factory()->create(['user_type' => 'Website Admin']);
        $this->actingAs($admin)->put('/services/'.$service->id, ['name' => 'Updated', 'description' => 'Description', 'price' => '15.00'])
            ->assertRedirect(route('services.index'));
        $this->assertSame('Updated', $service->fresh()->service_title);
        $admin->update(['status' => 'Disabled']);
        $this->delete('/services/'.$service->id)->assertForbidden();
    }

    public function test_administrator_component_rejects_client_calls(): void
    {
        Livewire::actingAs(User::factory()->create())->test(ProgramListComponent::class)->assertForbidden();
    }

    public function test_booking_component_has_no_public_paid_finalizer(): void
    {
        $this->assertFalse(method_exists(ConsulationBooking::class, 'completeBooking'));
        Livewire::actingAs(User::factory()->create())->test(ConsulationBooking::class)
            ->call('processPayment', 'forged-token')->assertStatus(422);
        $this->assertDatabaseCount('appointments', 0);
    }

    public function test_unverified_users_cannot_access_client_dashboard(): void
    {
        $this->actingAs(User::factory()->unverified()->create())->get('/client/client-dashboard')
            ->assertRedirect(route('verification.notice'));
    }

    public function test_program_deletion_cannot_be_triggered_by_get(): void
    {
        $this->actingAs(User::factory()->create(['user_type' => 'Website Admin']))
            ->get('/website-admin/programs/example/delete')->assertStatus(405);
    }

    public function test_route_names_are_unique_and_controller_targets_exist(): void
    {
        $names = [];
        foreach (app('router')->getRoutes() as $route) {
            if ($name = $route->getName()) {
                $this->assertNotContains($name, $names, 'Duplicate route name: '.$name);
                $names[] = $name;
            }
            if (is_string($action = $route->getAction('controller')) && str_contains($action, '@')) {
                [$class, $method] = explode('@', $action);
                $this->assertTrue(class_exists($class), $class.' is missing');
                $this->assertTrue(method_exists($class, $method), $action.' is missing');
            }
        }
    }
}
