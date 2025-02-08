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
            'id' => 'required|numeric|exists:provider_types,id',
            'status' => 'required|in:1,0',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'The provider type ID is required.',
            'id.exists' => 'The selected provider type ID does not exist in our records.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The status must be either active or inactive.',
        ];
    }
}