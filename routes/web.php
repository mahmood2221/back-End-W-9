<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// جرب هذا الكود مؤقتاً للتأكد من الربط
Route::get('/dashboard', function () {
    return view('dashboard', [
        // 1. الإحصائيات (Counts)
        'totalProducts'   => Product::count(),
        'totalCategories' => Category::count(),
        'totalSuppliers'  => Supplier::count(),

        // 2. آخر 5 منتجات مع الـ Eager Loading لكل العلاقات المطلوبة
        'latestProducts'  => Product::with(['user', 'category', 'suppliers'])
                                    ->latest()
                                    ->take(5) // جلب آخر 5 فقط
                                    ->get(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('suppliers', SupplierController::class);
});

require __DIR__.'/auth.php';