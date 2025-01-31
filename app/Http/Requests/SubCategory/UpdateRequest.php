<?php

namespace App\Http\Requests\SubCategory;

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
            
            'name' => 'required|unique:sub_categories,name,' . $this->sub_category->id. ',id|max:255',
            'description' => 'nullable|max:500',
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
