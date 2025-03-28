<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ServiceSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PodcastSeeder::class);
        $this->call(ProgramSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(BlogsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
    }
}
