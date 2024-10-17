<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        Service::create([
            'name' => 'Individual Therapy',
            'description' => 'Personalized therapy sessions to address individual mental health needs.',
            'price' => 120.00,
            'is_featured' => true,
        ]);

        Service::create([
            'name' => 'Couples Therapy',
            'description' => 'Therapy sessions aimed at improving communication and relationship satisfaction.',
            'price' => 175.00,
            'is_featured' => true,
        ]);

        Service::create([
            'name' => 'Group Therapy',
            'description' => 'Supportive group sessions for shared experiences and healing.',
            'price' => 150.00,
            'is_featured' => true,
        ]);
    }
}
