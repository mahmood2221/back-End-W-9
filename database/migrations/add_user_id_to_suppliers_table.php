<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::table('suppliers', function (Blueprint $table) {
        // إضافة العمود وربطه بجدول المستخدمين
        // وضعنا nullable() مؤقتاً إذا كان عندك موردين قدامى في القاعدة
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('suppliers', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
    });
}
};
