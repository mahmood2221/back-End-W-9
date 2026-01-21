<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductAccessTest extends TestCase
{
    use RefreshDatabase; // لتنظيف قاعدة بيانات الاختبار بعد كل فحص

   public function test_user_cannot_edit_others_product()
{
    // 1. إنشاء مستخدمين
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    
    // 2. إنشاء فئة يدوياً بدلاً من استخدام Factory
    $category = \App\Models\Category::create(['name' => 'Electronics']);

    // 3. إنشاء منتج مملوك للمستخدم الأول
    $product = Product::create([
        'name' => 'User 1 Product',
        'price' => 100,
        'category_id' => $category->id,
        'user_id' => $user1->id
    ]);

    // 4. محاولة الدخول بصفة المستخدم الثاني لتعديل منتج المستخدم الأول
    $response = $this->actingAs($user2)->get(route('products.edit', $product));

    // 5. التأكد أن النظام منعه
    $response->assertStatus(403);
}
}