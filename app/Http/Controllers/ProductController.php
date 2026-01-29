<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller
{
    use AuthorizesRequests;
public function index(Request $request)
{
    // 1. نبدأ بإنشاء الاستعلام مع العلاقات لتقليل ضغط قاعدة البيانات (Eager Loading)
    // أضفنا 'suppliers' هنا لأننا سنحتاجها في الفلترة والعرض
    $query = Product::with(['category', 'user', 'suppliers']);

    // 2. منطق البحث (Search): بالاسم أو الوصف
   if ($request->filled('search')) {
    $query->where('name', 'like', '%' . $request->search . '%');
}

    // 3. الفلترة حسب القسم (Category Filter)
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    // 4. الفلترة حسب المورد (Supplier Filter) - علاقة Many-to-Many
    if ($request->filled('supplier_id')) {
        $query->whereHas('suppliers', function($q) use ($request) {
            $q->where('suppliers.id', $request->supplier_id);
        });
    }

    // 5. الترتيب (Sorting) مع حماية ضد المدخلات غير الصالحة (Whitelist)
    $allowedSortFields = ['name', 'price', 'created_at'];
    $sort = in_array($request->sort, $allowedSortFields) ? $request->sort : 'created_at';
    $direction = ($request->direction === 'asc') ? 'asc' : 'desc';

    $query->orderBy($sort, $direction);

    // 6. الترقيم مع الحفاظ على روابط البحث (Pagination + Query Persistence)
    $products = $query->paginate(10)->withQueryString();

    // جلب البيانات اللازمة للقوائم المنسدلة في الفلتر
    $categories = \App\Models\Category::all();
    $suppliers = \App\Models\Supplier::all();

    return view('products.index', compact('products', 'categories', 'suppliers'));
}

    // صفحة الإضافة
    public function create()
{
    return view('products.create', [
        'categories' => \App\Models\Category::all(),
        'suppliers'  => \App\Models\Supplier::all(), // هذا السطر هو الذي سيجلب الموردين الأربعة
    ]);
}

    // حفظ المنتج مع الربط التلقائي بالمستخدم
  public function store(Request $request) 
{
    // 1. إنشاء المنتج وربطه بالمستخدم
    $product = $request->user()->products()->create($request->all());

    // 2. معالجة بيانات الموردين الإضافية (Pivot Data)
    if ($request->has('suppliers')) {
        $attachData = [];
        foreach ($request->suppliers as $supplierId => $details) {
            // نحفظ فقط الموردين الذين تم تحديدهم بالـ Checkbox
            if (isset($details['selected'])) {
                $attachData[$supplierId] = [
                    'cost_price' => $details['cost_price'],
                    'lead_time_days' => $details['lead_time_days'],
                ];
            }
        }
        // ربط البيانات بالجدول الوسيط
        $product->suppliers()->sync($attachData);
    }

    return redirect()->route('products.index')->with('success', 'Product saved with supplier details!');
}

    // صفحة التعديل مع حماية الـ Policy
   public function edit(Product $product)
{
    $this->authorize('update', $product);

    return view('products.edit', [
        'product'    => $product,
        'categories' => Category::all(),
        'suppliers'  => \App\Models\Supplier::all(), // أضف هذا السطر هنا أيضاً
    ]);
}

    // تحديث المنتج
   public function update(UpdateProductRequest $request, Product $product)
{
    // 1. التأكد من الصلاحية (Policy)
    $this->authorize('update', $product);
    
    // 2. تحديث بيانات المنتج الأساسية (الاسم، السعر، القسم)
    $product->update($request->validated());

    // 3. تحديث الموردين (علاقة Many-to-Many مع بيانات Pivot)
    if ($request->has('suppliers')) {
        $syncData = [];
        foreach ($request->suppliers as $supplierId => $details) {
            // نحفظ المورد فقط إذا تم اختياره (Checkboxed)
            if (isset($details['selected'])) {
                $syncData[$supplierId] = [
                    'cost_price' => $details['cost_price'] ?? 0,
                    'lead_time_days' => $details['lead_time_days'] ?? 0,
                ];
            }
        }
        // استخدام sync سيقوم بحذف القديم وإضافة الجديد أو تحديث الموجود
        $product->suppliers()->sync($syncData);
    } else {
        // إذا تم إلغاء اختيار جميع الموردين، نقوم بتفريغهم
        $product->suppliers()->detach();
    }

    return redirect()->route('products.index')->with('success', 'Product and suppliers updated successfully!');
}

    // حذف المنتج
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}