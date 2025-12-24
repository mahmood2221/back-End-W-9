<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    // READ: عرض كل المنتجات مع الفئة (Eager Loading)
    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    // CREATE: عرض فورم الاضافة مع تمرير الفئات
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // STORE: حفظ المنتج باستخدام StoreProductRequest
    public function store(StoreProductRequest $request)
    {
        Product::create($request->validated());

        return redirect()->route('products.index')
                         ->with('success', 'Product added successfully!');
    }

    // EDIT: عرض فورم التعديل مع الفئات
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    // UPDATE: تعديل المنتج باستخدام UpdateProductRequest
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return redirect()->route('products.index')
                         ->with('success', 'Product updated successfully!');
    }

    // DELETE: حذف المنتج
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
                         ->with('success', 'Product deleted successfully!');
    }
}
