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

   public function store(StoreProductRequest $request)
{
    // الخطوة 4 من المتطلبات: إسناد المالك تلقائياً عبر المستخدم المسجل حالياً
    // نستخدم علاقة auth()->user()->products() لضمان وضع الـ user_id الصحيح

   /** @var \App\Models\User $user */
   $user = $request->user(); 

    // الآن سيختفي الخطأ عن كلمة products()
    $product = $user->products()->create($request->validated());
    // تجهيز بيانات pivot (نفس كودك السابق)
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

    // ربط الموردين
    $product->suppliers()->sync($data);

    return redirect()->route('products.index')
        ->with('success', 'Product created and linked to your account!');
}

    // EDIT: عرض فورم التعديل
    public function edit(Product $product)
    {
        $this->authorize('update', $product);

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
    $this->authorize('update', $product);

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
        $this->authorize('delete', $product);
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully!');
    }
}
