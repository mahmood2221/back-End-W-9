<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        Product::create([
            'name' => 'Laptop',
            'price' => 1200,
            'category_id' => $categories->first()->id,
        ]);

        Product::create([
            'name' => 'Mouse',
            'price' => 25,
            'category_id' => $categories->first()->id,
        ]);

        Product::create([
            'name' => 'Keyboard',
            'price' => 45,
            'category_id' => $categories->first()->id,
        ]);

        Product::create([
            'name' => 'Monitor',
            'price' => 300,
            'category_id' => $categories->first()->id,
        ]);

        Product::create([
            'name' => 'USB Cable',
            'price' => 10,
            'category_id' => $categories->first()->id,
        ]);
    }
}
