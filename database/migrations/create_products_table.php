<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();      // اسم المنتج
            $table->decimal('price', 8, 2);// سعر المنتج
            $table->foreignId('category_id')  // علاقة المنتج بالفئة
                  ->constrained() // ربط المفتاح الخارجي بجدول الفئات
                  ->onDelete('cascade');// حذف المنتجات عند حذف الفئة
            $table->timestamps();// تواريخ الإنشاء والتحديث
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
