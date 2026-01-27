<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller
{
    use AuthorizesRequests;

    // 1. عرض قائمة المنتجات مع البحث والفلترة (Task 09)
    public function index(Request $request)
    {
        $query = Product::with(['category', 'suppliers', 'user']);

        // البحث النصي
       if ($request->filled('search')) {
    $search = $request->search;
    $query->where(function ($q) use ($search) {
        $q->where('name', 'like', "%$search%"); // نبحث في الاسم فقط
    });
}

        // فلترة الفئات
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // فلترة الموردين
        if ($request->filled('supplier_id')) {
            $query->whereHas('suppliers', function ($q) use ($request) {
                $q->where('suppliers.id', $request->supplier_id);
            });
        }

        // الترتيب
        $sortField = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        $allowedFields = ['name', 'price', 'created_at'];

        if (in_array($sortField, $allowedFields)) {
            $query->orderBy($sortField, $sortDirection);
        }

        // الترقيم مع الحفاظ على قيم البحث في الرابط
        $products = $query->paginate(10)->withQueryString();

        return view('products.index', [
            'products' => $products,
            'categories' => Category::all(),
            'suppliers' => Supplier::all(),
        ]);
    }

    // 2. الدالة التي كانت ناقصة وتسببت في الخطأ (عرض صفحة الإضافة)
    public function create()
    {
        return view('products.create', [
            'categories' => Category::all(),
            'suppliers' => Supplier::all(),
        ]);
    }

    // 3. حفظ المنتج الجديد
    public function store(StoreProductRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();
        $product = $user->products()->create($request->validated());

        $data = [];
        if ($request->has('suppliers')) {
            foreach ($request->suppliers as $supplierId => $supplierData) {
                if (isset($supplierData['selected'])) {
                    $data[$supplierId] = [
                        'cost_price' => $supplierData['cost_price'],
                        'lead_time_days' => $supplierData['lead_time_days'],
                    ];
                }
            }
        }
        $product->suppliers()->sync($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    // 4. عرض صفحة التعديل
    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        $product->load('suppliers');

        return view('products.edit', [
            'product' => $product,
            'categories' => Category::all(),
            'suppliers' => Supplier::all(),
        ]);
    }

    // 5. تحديث المنتج
    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);
        $product->update($request->validated());

        $data = [];
        if ($request->has('suppliers')) {
            foreach ($request->suppliers as $supplierId => $supplierData) {
                if (isset($supplierData['selected']) && $supplierData['selected'] == '1') {
                    $data[$supplierId] = [
                        'cost_price' => $supplierData['cost_price'],
                        'lead_time_days' => $supplierData['lead_time_days'],
                    ];
                }
            }
        }
        $product->suppliers()->sync($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    // 6. حذف المنتج
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}