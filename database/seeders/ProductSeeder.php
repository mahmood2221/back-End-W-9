<?php

namespace Database\Seeders;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
   

public function run()
{
            // إضافة منتجات تجريبية
    Product::create([
        'name' => 'Car',
        'price' => 35000.00
    ]);

    Product::create([
        'name' => 'Phone',
        'price' => 1200.50
    ]);

    Product::create([
        'name' => 'Smart watch',
        'price' => 800.99
    ]);
}

}
