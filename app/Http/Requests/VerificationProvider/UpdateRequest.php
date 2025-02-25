<?php

namespace App\Http\Requests\VerificationProvider;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        
        return [
            'name' => ['required',
                // unique:countries,name,'. $this->country->id.,
                Rule::unique('provider_types', 'name')->ignore($this->verification_provider)->whereNull('deleted_at'),
                'max:255'
            ],
            'name' => 'required|string|unique:provider_types,name,' . $this->verification_provider->id . '|max:255',
            'description' => 'nullable|string',
            'country_id' => 'required|exists:countries,id',
            'provider_type_id' => 'required|exists:provider_types,id',
            'contact_address' => 'nullable|string',
            'email' => [
                'required',
                'email',
                'unique:verification_providers,email,' . $this->verification_provider->id, 
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', 
            ],
            'website' => 'nullable|url',
            'contact_person' => 'nullable|string|max:255',
            'status' => 'required|in:1,0',
        ];
    }
}


