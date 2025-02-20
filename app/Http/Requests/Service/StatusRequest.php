<?php

namespace App\Http\Requests\ProviderType;

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
            'id' => 'required|numeric|exists:services,id',
            'status' => 'required|in:1,0',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'The service ID is required.',
            'id.numeric' => 'The service ID must be a valid number.',
            'id.exists' => 'The selected service does not exist.',

            'status.required' => 'Please select a status.',
            'status.in' => 'Invalid status selected. Please choose Active or Inactive.',
        ];
    }

}