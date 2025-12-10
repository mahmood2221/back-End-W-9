<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // READ: عرض كل المنتجات
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // CREATE: فورم إضافة منتج
    public function create()
    {
        return view('products.create');
    }

    // STORE: حفظ المنتج في قاعدة البيانات
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric'
        ]);

        Product::create($request->only('name', 'price'));

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    // EDIT: عرض فورم التعديل
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // UPDATE: تحديث بيانات المنتج
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric'
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->only('name', 'price'));

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    // DELETE: حذف المنتج
    public function destroy($id)
    {
        Product::destroy($id);

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
