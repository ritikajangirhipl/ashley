<?php

namespace App\Http\Requests\VerificationProvider;

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
            'id' => 'required|numeric|exists:verification_providers,id',
            'status' => 'required|in:1,0',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'The verification provider ID is required.',
            'id.exists' => 'The selected verification provider ID does not exist in our records.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The status must be either active or inactive.',
        ];
    }
}