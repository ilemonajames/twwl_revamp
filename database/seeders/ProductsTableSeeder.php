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
                    'product_name' => 'Sample Product 1',
                    'description' => 'Description for Sample Product 1',
                    'price' => 19.99,
                    'photo' => 'path/to/photo1.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'product_name' => 'Sample Product 2',
                    'description' => 'Description for Sample Product 2',
                    'price' => 29.99,
                    'photo' => 'path/to/photo2.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                // Add more products as needed
            ]);
        }
    }
    
