<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

   public function rules(): array
{
    return [
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0.01',
        'category_id' => 'required|exists:categories,id',
        'suppliers' => 'required|array',
        
        // التعديل هنا: مطلوب فقط إذا تم اختيار الـ checkbox، وغير ذلك مسموح أن يكون فارغاً (nullable)
        'suppliers.*.cost_price' => 'required_if:suppliers.*.selected,1|nullable|numeric|min:0',
        'suppliers.*.lead_time_days' => 'required_if:suppliers.*.selected,1|nullable|integer|min:0',
    ];
}
}
