<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        // If your route uses implicit binding: route('products.update', $product)
        $productId = $this->route('product')?->id ?? null;

        return [
            'name'  => ['required','string','max:255', Rule::unique('products','name')->ignore($productId)],
            'price' => 'required|numeric|min:0',
        ];
    }
}



