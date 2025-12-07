<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * نموذج المنتج (Product)
 * يمثل جدول products في قاعدة البيانات
 */
class Product extends Model
{
    use HasFactory;

    /**
     * الحقول القابلة للتعبئة (Mass Assignment)
     */
    protected $fillable = [
        'name',
        'price',
    ];
}
