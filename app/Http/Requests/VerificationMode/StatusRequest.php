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
            'status' => 'required|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'The verification mode ID is required.',
            'id.exists' => 'The selected verification mode ID does not exist in our records.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The status must be either active or inactive.',
        ];
    }
}