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

            'name' => 'required|unique:sub_categories,name,' . $this->sub_category->id. '|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'nullable|in:0,1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter the subcategory name.',
            'name.unique' => 'This subcategory name is already in use. Please choose another name.',
            'name.max' => 'The subcategory name cannot exceed 255 characters.',

            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
            'image.max' => 'The image size must not exceed 2MB.',

            'description.required' => 'Please enter a description for the subcategory.',
            'description.max' => 'The description cannot exceed 500 characters.',

            'status.required' => 'Please select a status.',
            'status.in' => 'Invalid status selected. Please choose Active or Inactive.',
        ];
    }
}
