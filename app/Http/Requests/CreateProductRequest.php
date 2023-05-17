<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'game_id' => ['required', 'exists:games'],
            'product_code' => ['required'],
            'name' => ['required'],
            'price' => ['required', 'integer'],
            'cost' => ['required','integer']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
