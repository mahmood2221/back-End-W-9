<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            ['name' => 'Laptop', 'price' => 1200],
            ['name' => 'Mouse', 'price' => 25],
            ['name' => 'Keyboard', 'price' => 45],
            ['name' => 'Monitor', 'price' => 300],
            ['name' => 'USB Cable', 'price' => 10],
        ]);
    }
}
