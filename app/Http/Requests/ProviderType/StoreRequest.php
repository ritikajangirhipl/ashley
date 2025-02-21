<?php

namespace App\Http\Requests\ProviderType;

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
            'name' => 'required|unique:provider_types|max:255', 
            'description' => 'required',
            'status' => 'required|in:1,0',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Please enter provider type name.',
            'name.unique' => 'This provider type name is already in use. Please choose another name.',
            'name.max' => 'The provider type name cannot exceed 255 characters.',

            'description.max' => 'The description cannot exceed 255 characters.',

            'status.required' => 'Please select status.',
            'status.in' => 'Invalid status selected. Please choose Active or Inactive.',
        ];
    }
}
