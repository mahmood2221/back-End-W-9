<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductAccessTest extends TestCase
{
    use RefreshDatabase;

    // حالة 1: الضيف لا يمكنه الدخول
    public function test_guest_cannot_access_protected_routes()
    {
        $response = $this->get(route('products.create'));
        $response->assertRedirect('/login');
    }

    // حالة 2: المستخدم لا يمكنه تعديل منتج غيره (الكود الخاص بك)
    public function test_user_cannot_edit_others_product()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $category = Category::create(['name' => 'Electronics']);

        $product = Product::create([
            'name' => 'User 1 Product',
            'price' => 100,
            'category_id' => $category->id,
            'user_id' => $user1->id
        ]);

        $response = $this->actingAs($user2)->get(route('products.edit', $product));
        $response->assertStatus(403);
    }

    // حالة 3: المالك يمكنه تعديل منتجه الخاص
    public function test_owner_can_edit_their_own_product()
    {
        $user = User::factory()->create();
        $category = Category::create(['name' => 'Home']);

        $product = Product::create([
            'name' => 'My Product',
            'price' => 50,
            'category_id' => $category->id,
            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user)->get(route('products.edit', $product));
        $response->assertStatus(200);
    }
}