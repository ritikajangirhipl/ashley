<?php

namespace App\Http\Requests\VerificationMode;

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
            'id' => 'required|numeric|exists:verification_modes,id',
            'status' => 'required|in:1,0',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'The verification mode ID is required.',
            'id.numeric' => 'The verification mode ID must be a valid number.',
            'id.exists' => 'The selected verification mode does not exist.',

            'status.required' => 'Please select a status.',
            'status.in' => 'Invalid status selected. Please choose Active or Inactive.',
        ];
    }
}