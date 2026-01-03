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
      

        // 2️ تعبئة جدول المنتجات بعد الفئات
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            SupplierSeeder::class,
            ProductSupplierSeeder::class,

        ]);

        // 3️ إنشاء مستخدم تجريبي
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
