<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * عرض قائمة الموردين
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * حذف المورد (حل مشكلة الصفحة البيضاء عند الحذف)
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        // إعادة التوجيه مع رسالة نجاح (Flash Message)
        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier deleted successfully!');
    }

    /**
     * عرض صفحة التعديل (حل مشكلة الصفحة البيضاء عند الضغط على Edit)
     */
    public function edit(string $id)
    {
        $supplier = Supplier::findOrFail($id);

        // تأكد من إنشاء ملف resources/views/suppliers/edit.blade.php
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * تحديث بيانات المورد في قاعدة البيانات
     */
    public function update(Request $request, string $id)
    {
        // 1. التحقق من البيانات (Validation) كما هو مطلوب في التاسك
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:suppliers,email,' . $id,
        ]);

        // 2. تحديث البيانات
        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->all());

        // 3. العودة برسالة نجاح
        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier updated successfully!');
    }

    // يمكنك ترك create و store و show فارغة إذا كنت لا تستخدمهم حالياً
}
