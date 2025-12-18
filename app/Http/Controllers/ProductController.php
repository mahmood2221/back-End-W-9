<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    // READ: عرض كل المنتجات
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // CREATE: عرض فورم الإضافة
    public function create()
    {
        return view('products.create');
    }

    // STORE: حفظ المنتج باستخدام StoreProductRequest
    public function store(StoreProductRequest $request)
    {
        Product::create($request->validated());

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    // EDIT: عرض فورم التعديل
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // UPDATE: تعديل المنتج باستخدام UpdateProductRequest
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    // DELETE: حذف المنتج
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
