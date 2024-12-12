<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Podcast;

class PodcastSeeder extends Seeder
{
    public function run()
    {
        Podcast::create([
            'title' => 'The Laravel Journey',
            'description' => 'Learn about Laravel from the basics to advanced concepts.',
            'host' => 'John Doe',
            'photo' => 'group.jpg',
            'category' => "Media",
            'release_date' => '2024-11-01',
            'audio_url' => 'https://example.com/audio/laravel-journey.mp3',
        ]);

        Podcast::create([
            'title' => 'Tech Trends 2024',
            'description' => 'Explore the latest trends in technology for 2024.',
            'host' => 'Jane Smith',
            'photo' => 'group.jpg',
            'category' => "Podcast",
            'release_date' => '2024-10-15',
            'audio_url' => 'https://example.com/audio/tech-trends.mp3',
        ]);
    }
}
