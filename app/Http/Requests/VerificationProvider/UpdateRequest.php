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
    public function messages()
    {
        return [
            'name.required' => 'The verification provider name is required.',
            'name.unique' => 'The verification provider name is unique.',
            'name.max' => 'The verification provider name not greater than 255 characters.',
            'description.string' => 'The description must be string.',
            'country_id.required' => 'The country is required.',
            'country_id.exists' => 'The selected country is invalid.',
            'provider_type_id.required' => 'The provider type is required.',
            'provider_type_id.exists' => 'The selected provider type is invalid.',
            'contact_address.string' => 'The contact address must be string.',
            'email.required' => 'The email address is required.',
            'email.email' => 'The email address must be a valid email.',
            'email.unique' => 'The email address must be unique.',
            'email.regex' => 'The email address format is invalid.',
            'website.url' => 'The website must be a valid URL.',
            'contact_person.string' => 'The contact person must be string.',
            'contact_person.max' => 'The contact person not greater than 255 characters.',
            'status.required' => 'The status is required.',
            'status.in' => 'The status is either active or inactive.',
        ];
    }
}


