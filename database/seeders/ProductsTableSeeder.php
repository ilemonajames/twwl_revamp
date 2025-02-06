<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class ProductsTableSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            DB::table('products')->insert([
                [
                    'product_name' => 'Hoodies: inhale peace exhale chaos ',
                    'description' => 'Hoodies: inhale peace exhale chaos ',
                    'price' => 19.99,
                    'photo' => 'hood.jpeg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'product_name' => 'T-shirt',
                    'description' => 'T-shirt',
                    'price' => 29.99,
                    'photo' => 'tshirt.jpeg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                // Add more products as needed
            ]);
        }
    }

