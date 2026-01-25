<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. جلب الإحصائيات (العدد الإجمالي)
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalSuppliers = Supplier::count();

        // 2. جلب آخر 5 منتجات مع المالك والفئة (Eager Loading لمنع ثقل السيرفر)
        $latestProducts = Product::with(['user', 'category'])
            ->latest() // ترتيب من الأحدث للأقدم
            ->take(5)  // جلب 5 فقط
            ->get();

        // 3. إرسال البيانات للواجهة
        return view('dashboard', compact('totalProducts', 'totalCategories', 'totalSuppliers', 'latestProducts'));
    }
}