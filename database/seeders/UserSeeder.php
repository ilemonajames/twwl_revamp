<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Branch;
use App\Models\Department;
use Illuminate\Support\Collection;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::firstOrCreate(['email' => 'info@twwc.org'], [
            'surname' => 'The way we Love',
            'othernames' => 'Counselling',
            'email' => 'info@twwc.org',
            'phoneno' => '8047210983',
            'password' => Hash::make('TWWC@2024'),
            'user_type' => 'Website Admin',
            'status' => "Active",
            'resident_address' => "Abuja"
        ]);

        User::firstOrCreate(['email' => 'thewaywelove24@gmail.com'], [
            'surname' => 'Elizabeth',
            'othernames' => 'Hall',
            'email' => 'thewaywelove24@gmail.com',
            'phoneno' => '08134305556',
            'password' => Hash::make('Twwl@1991'),
            'user_type' => 'Website Admin',
            'status' => "Active",
            'resident_address' => "Abuja"
        ]);
        User::firstOrCreate(['email' => 'ilemonaj@gmail.com'], [
            'surname' => 'Ilemona',
            'othernames' => 'James',
            'email' => 'ilemonaj@gmail.com',
            'phoneno' => '08175840244',
            'password' => Hash::make('TWWC@2024'),
            'user_type' => 'Website Admin',
            'status' => "Active",
            'resident_address' => "Abuja"
        ]);
    }
}
