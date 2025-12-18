<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


/**
 * إنشاء جدول المنتجات (products)
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // معرف المنتج (Primary Key)
            $table->string('name')->unique(); // اسم المنتج
            $table->decimal('price', 8, 2); // سعر المنتج بدقة عشريّة
            $table->timestamps(); // created_at و updated_at تلقائي
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products'); // حذف الجدول عند التراجع عن الهجرة
    }
};