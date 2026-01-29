<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // تأكد من وجود هذا السطر
use Illuminate\Support\Facades\Auth;
class SupplierController extends Controller
{
    use AuthorizesRequests; // لإتاحة استخدام $this->authorize()

    public function index()
    {
$suppliers = Supplier::with('user')->get();
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        // أضفنا unique:suppliers هنا لمنع التكرار وإظهار رسالة خطأ لطيفة بدل الانهيار
        'name' => 'required|min:3|unique:suppliers,name', 
        'email' => 'required|email|unique:suppliers,email',
        'phone' => 'nullable|string',
    ]);
    /** @var \App\Models\User $user */
    
    $validated['user_id'] = Auth::id();

    Supplier::create($validated);

    return redirect()->route('suppliers.index')
        ->with('success', 'Supplier created successfully!');
}

    public function edit(Supplier $supplier) // استخدم الـ Model Binding هنا أسهل
    {
        // حماية: لا يمكن الدخول لصفحة التعديل إلا للمالك
        $this->authorize('update', $supplier); 
        
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        // حماية: التأكد من الصلاحية قبل التحديث
        $this->authorize('update', $supplier);

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:suppliers,email,' . $supplier->id,
        ]);

        $supplier->update($request->all());

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier updated successfully!');
    }

    public function destroy(Supplier $supplier)
    {
        // حماية: الحذف للمالك فقط
        $this->authorize('delete', $supplier);

        $supplier->delete();

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier deleted successfully!');
    }
}