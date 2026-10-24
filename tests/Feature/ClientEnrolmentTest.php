<?php

namespace Tests\Feature;

use App\Models\Program;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientEnrolmentTest extends TestCase
{
    use RefreshDatabase;

    private function newClient(): User
    {
        $user = User::factory()->create();
        $user->forceFill(['enrolment_required' => true])->save();
        return $user;
    }

    public function test_first_login_overrides_intended_destination_and_client_routes_require_selection(): void
    {
        $user = $this->newClient();
        $this->withSession(['url.intended' => route('client.book')])->post('/login', ['email' => $user->email, 'password' => 'password'])->assertRedirect(route('client.enrolment.create'));
        $this->get(route('client.book'))->assertRedirect(route('client.enrolment.create'));
        $this->get(route('client.enrolment.create'))->assertOk()->assertSee('What would you like support with?');
    }

    public function test_program_choice_is_saved_only_for_current_user_and_is_not_a_booking(): void
    {
        $user = $this->newClient();
        $other = $this->newClient();
        $program = Program::create(['program_title' => 'Couples support', 'program_image' => '']);
        $this->actingAs($user)->post(route('client.enrolment.store'), ['selection' => 'program:'.$program->id, 'user_id' => $other->id])->assertRedirect(route('client-dashboard'));
        $this->assertSame($program->id, $user->fresh()->preferred_program_id);
        $this->assertFalse($user->fresh()->enrolment_required);
        $this->assertNotNull($user->fresh()->enrolment_selected_at);
        $this->assertTrue($other->fresh()->enrolment_required);
        $this->assertDatabaseCount('appointments', 0);
        $this->actingAs($user->fresh())->get(route('client.enrolment.create'))->assertRedirect(route('client-dashboard'));
    }

    public function test_service_choice_and_invalid_choices(): void
    {
        $user = $this->newClient();
        $service = Service::create(['service_title' => 'Individuals', 'service_image' => '', 'service_description' => '', 'service_icon' => '']);
        $this->actingAs($user)->post(route('client.enrolment.store'), [])->assertSessionHasErrors('selection');
        $this->post(route('client.enrolment.store'), ['selection' => 'program:'.$service->id])->assertSessionHasErrors('selection');
        $this->assertTrue($user->fresh()->enrolment_required);
        $this->post(route('client.enrolment.store'), ['selection' => 'service:'.$service->id])->assertRedirect(route('client-dashboard'));
        $this->assertSame($service->id, $user->fresh()->preferred_service_id);
        $this->assertNull($user->fresh()->preferred_program_id);
    }

    public function test_guest_unverified_and_admin_cannot_submit_client_enrolment(): void
    {
        $this->get(route('client.enrolment.create'))->assertRedirect(route('login'));
        $user = User::factory()->unverified()->create();
        $this->actingAs($user)->get(route('client.enrolment.create'))->assertRedirect(route('verification.notice'));
        $admin = User::factory()->create(['user_type' => 'Website Admin']);
        $this->actingAs($admin)->post(route('client.enrolment.store'), [])->assertForbidden();
    }
}
