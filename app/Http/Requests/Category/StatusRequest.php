<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'id' => 'required|numeric|exists:categories,id',
            'status' => 'required|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'The category ID is required.',
            'id.exists' => 'The selected category ID does not exist in our records.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The status must be either active or inactive.',
        ];
    }
}

