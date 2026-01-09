<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $required = $this->method() == 'PUT' ? 'nullable' : 'required';
        return [
            'name' => 'required',
            'short_description' => 'required',
            'category' => 'required',
            'sub_category' => 'required',
            // 'product_sku' => 'required|unique:products,sku_code',
            'buying_price' => 'required',
            'selling_price' => 'required',
            // 'thumbnail' => "$required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048",
        ];
    }
}
