<?php

namespace App\Http\Requests\Category;

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Please enter the category name.',
            'name.string' => 'The category name must be a valid string.',
            'name.min' => 'The category name must be at least 3 characters long.',
            'name.max' => 'The category name cannot exceed 255 characters.',
            'name.unique' => 'This category name is already in use. Please choose another name.',

            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image size must not exceed 2MB.',

            'description.required' => 'Please enter a category description.',
            'description.string' => 'The description must be a valid string.',
            'description.max' => 'The description cannot exceed 255 characters.',

            'status.required' => 'Please select a status.',
            'status.in' => 'Invalid status selected. Please choose Active or Inactive.',
        ];
    }

}


