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
        $table->string('name');
        $table->decimal('price', 8, 2);

        // ربط المنتج بالفئة
        $table->foreignId('category_id')
            ->constrained()
            ->cascadeOnDelete();

        // السطر الجديد: ربط المنتج بالمستخدم (صاحب المنتج)
        $table->foreignId('user_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('product_supplier');
    }
};
