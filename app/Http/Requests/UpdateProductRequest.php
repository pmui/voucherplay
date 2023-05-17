<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'name' => 'required',
            'price' => 'required|integer',
            'cost' => 'required|integer',
            'value' => 'required|integer',
        ];

        if (!$this->has('active')) {
            $rules['active'] = 'sometimes|boolean';
            $this->merge(['active' => false]);
        }

        return $rules;
    }

    public function authorize(): bool
    {
        return true;
    }
}
