<?php

namespace App\Http\Requests\SubCategory;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:sub_categories,name|max:255',
            'description' => 'required|max:500',
            'status' => 'required|in:1,0',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The sub-category name is required.',
            'name.unique' => 'The sub-category name has already been taken.',
            'status.in' => 'The status must be either active or inactive.',
        ];
    }
}
