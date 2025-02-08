<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:255|unique:categories,name,' . $this->category->id,
            'description' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.unique' => 'This category name has already been taken.',
            'status.in' => 'The status must be either active or inactive.',
        ];
    }
}


