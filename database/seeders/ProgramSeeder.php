<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Program;
use Illuminate\Support\Str;

class ProgramSeeder extends Seeder
{
    public function run()
    {
        Program::create([
                'id' => Str::uuid(),
                'program_image' => 'path/to/couples_program_image.jpg',
                'icon_class' => 'fas fa-heart', // Font Awesome icon class
                'program_title' => '8-Week Couples Program',
                'program_description' => 'A structured, self-paced 8-week program designed to help couples strengthen their connection, improve communication, and resolve conflicts.',
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
        Program::create([
                'id' => Str::uuid(),
                'program_image' => 'path/to/parenting_class_image.jpg',
                'icon_class' => 'fas fa-child', // Font Awesome icon class
                'program_title' => '8-Week Parenting Class',
                'program_description' => 'An online self-paced parenting course focusing on parenting styles, emotional intelligence, communication, and building stronger family bonds.',
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
        Program::create([
                'id' => Str::uuid(),
                'program_image' => 'path/to/ptsd_support_group_image.jpg',
                'icon_class' => 'fas fa-user-shield', // Font Awesome icon class
                'program_title' => 'Trauma & PTSD Support Group',
                'program_description' => 'An online support group that provides a safe space for individuals dealing with trauma and PTSD to share, grow, and heal.',
                'is_featured' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]); 

        Program::create([
                'id' => Str::uuid(),
                'program_image' => 'path/to/couples_seminar_image.jpg',
                'icon_class' => 'fas fa-users', // Font Awesome icon class
                'program_title' => 'Couples Seminar',
                'program_description' => 'A seminar led by a licensed mental health provider designed to help couples foster deeper emotional connections, improve communication, and resolve conflicts.',
                'is_featured' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        Program::create([
                'id' => Str::uuid(),
                'program_image' => 'path/to/weight_release_program_image.jpg',
                'icon_class' => 'fas fa-weight', // Font Awesome icon class
                'program_title' => 'Weight Release Program',
                'program_description' => 'A holistic program combining health coaching, hypnotherapy, and a 14-day detox cleanse to help individuals achieve a healthier lifestyle.',
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        Program::create([
                'id' => Str::uuid(),
                'program_image' => 'path/to/group_therapy_image.jpg',
                'icon_class' => 'fas fa-comments', // Font Awesome icon class
                'program_title' => 'Group Therapy Program',
                'program_description' => 'Weekly online group therapy sessions providing emotional support and coping strategies for trauma and PTSD.',
                'is_featured' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }
}
