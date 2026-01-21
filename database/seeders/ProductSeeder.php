<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\User; // لا تنسى استدعاء موديل المستخدم

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        // جلب أول مستخدم موجود في القاعدة (الذي أنشأناه في DatabaseSeeder)
        $user = User::first(); 

        $products = [
            ['name' => 'Laptop', 'price' => 1200],
            ['name' => 'Mouse', 'price' => 25],
            ['name' => 'Keyboard', 'price' => 45],
            ['name' => 'Monitor', 'price' => 300],
            ['name' => 'USB Cable', 'price' => 10],
        ];

        foreach ($products as $productData) {
            Product::create([
                'name' => $productData['name'],
                'price' => $productData['price'],
                'category_id' => $categories->first()->id,
                'user_id' => $user->id, // إضافة الـ user_id هنا
            ]);
        }
    }
}