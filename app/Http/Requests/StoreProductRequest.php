<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // السماح بتنفيذ الطلب
    }

   public function rules(): array
{
    return [
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0.01',
        'category_id' => 'required|exists:categories,id',
        'suppliers' => 'required|array', // التأكد من إرسال المصفوفة

        // التعديل السحري هنا:
        // مطلوب فقط إذا كان الـ checkbox (selected) قيمته 1، وغير ذلك هو nullable
        'suppliers.*.cost_price' => 'required_if:suppliers.*.selected,1|nullable|numeric|min:0',
        'suppliers.*.lead_time_days' => 'required_if:suppliers.*.selected,1|nullable|integer|min:0',
    ];
}
}