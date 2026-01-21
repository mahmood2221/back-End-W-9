<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    // READ: عرض المنتجات مع الفئة والموردين (Eager Loading)
    public function index()
    {
        $products = Product::with(['category', 'suppliers'])
            ->withCount('suppliers')
            ->get();

        return view('products.index', compact('products'));
    }

    // CREATE: عرض فورم الإضافة
    public function create()
    {
        return view('products.create', [
            'categories' => Category::all(),
            'suppliers'  => Supplier::all(),
            
        ]);
    }

    // STORE: حفظ المنتج + الموردين (pivot)
    public function store(StoreProductRequest $request)
    {
        // إنشاء المنتج
        $product = Product::create($request->validated());

        // تجهيز بيانات pivot
        $data = [];

        foreach ($request->suppliers as $supplierId => $supplierData) {
            if (isset($supplierData['selected'])) {
                $data[$supplierId] = [
                    'cost_price' => $supplierData['cost_price'],
                    'lead_time_days' => $supplierData['lead_time_days'],
                ];
            }
        }

        // ربط الموردين
        $product->suppliers()->sync($data);

        return redirect()->route('products.index')
            ->with('success', 'Product added successfully!');
    }

    // EDIT: عرض فورم التعديل
    public function edit(Product $product)
    {
        $product->load('suppliers');

        return view('products.edit', [
            'product'    => $product,
            'categories' => Category::all(),
            'suppliers'  => Supplier::all(),
        ]);
    }

    // UPDATE: تعديل المنتج + تحديث الموردين
 public function update(UpdateProductRequest $request, Product $product)
{
    $product->update($request->validated());

    $data = [];
    // نتحقق من وجود المصفوفة، وإذا لم توجد نرسل مصفوفة فارغة لـ sync لمسح الموردين القدامى
    if ($request->has('suppliers')) {
        foreach ($request->suppliers as $supplierId => $supplierData) {
            // تأكد أن الاسم في الـ Blade هو suppliers[ID][selected] وقيمته 1
            if (isset($supplierData['selected']) && $supplierData['selected'] == '1') {
                $data[$supplierId] = [
                    'cost_price' => $supplierData['cost_price'],
                    'lead_time_days' => $supplierData['lead_time_days'],
                ];
            }
        }
    }

    // sync ستقوم بإضافة الجديد، تحديث الموجود، وحذف غير الموجود في المصفوفة
    $product->suppliers()->sync($data);

    return redirect()->route('products.index')->with('success', 'Product updated successfully!');
}

    // DELETE: حذف المنتج (pivot يحذف تلقائيًا)
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully!');
    }
}
