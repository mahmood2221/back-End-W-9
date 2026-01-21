<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
   public function run(): void
{
    // 1️. إنشاء المستخدم أولاً (ضروري لأن المنتجات تعتمد عليه)
    $user = User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => bcrypt('password'), // كلمة السر الافتراضية
    ]);

    // 2. تعبئة الجداول الأخرى
    $this->call([
        CategorySeeder::class,
        SupplierSeeder::class,
    ]);

    // 3. الآن استدعاء الـ ProductSeeder 
    // ملاحظة: يجب تعديل ملف ProductSeeder ليستخدم $user->id
    $this->call([
        ProductSeeder::class,
        ProductSupplierSeeder::class,
    ]);
}
}
