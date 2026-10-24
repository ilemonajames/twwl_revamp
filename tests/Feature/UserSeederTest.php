<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_be_seeded_twice_without_duplicates_or_password_changes(): void
    {
        $this->seed(UserSeeder::class);
        $user = User::where('email', 'ilemonaj@gmail.com')->firstOrFail();
        $this->assertSame('Website Admin', $user->user_type);
        $password = $user->password;
        $this->seed(UserSeeder::class);
        $this->assertDatabaseCount('users', 3);
        $this->assertSame($password, $user->fresh()->password);
    }
}
