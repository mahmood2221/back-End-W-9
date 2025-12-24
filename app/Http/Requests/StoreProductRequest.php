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
            'name'        => 'required|string|max:255|unique:products,name',
            'price'       => 'required|numeric|min:0.01',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}
