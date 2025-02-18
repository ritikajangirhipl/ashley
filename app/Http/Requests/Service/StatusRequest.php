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
            'id.required' => 'The services ID is required.',
            'id.exists' => 'The services type ID does not exist in our records.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The status must be either active or inactive.',
        ];
    }
}