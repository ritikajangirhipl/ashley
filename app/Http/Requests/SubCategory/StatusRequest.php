<?php

namespace App\Http\Requests\SubCategory;

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
            'id' => 'required|numeric|exists:sub_categories,id',
            'status' => 'required|in:1,0',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'The sub category ID is required.',
            'id.numeric' => 'The sub category ID must be a valid number.',
            'id.exists' => 'The selected sub category does not exist.',

            'status.required' => 'Please select a status.',
            'status.in' => 'Invalid status selected. Please choose Active or Inactive.',
        ];
    }

}