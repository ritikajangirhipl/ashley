<?php

namespace App\Http\Requests\ServicePartner;

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

            'name' => 'required|max:255',
            'description' => 'nullable|string',
            'country_id' => 'required|exists:countries,id',
            'contact_address' => 'nullable|string',
            'email' => [
                'required',
                'email',
                'unique:service_partners,email',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            ],
            'website_address' => 'required|url',
            'contact_person' => 'nullable|string|max:255',
            'status' => 'required|in:1,0',
        
            
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Please enter the service partner name.',
            'name.max' => 'The service partner name cannot exceed 255 characters.',

            'description.string' => 'The description must be a valid string.',

            'country_id.required' => 'Please select a country.',
            'country_id.exists' => 'The selected country does not exist.',

            'contact_address.string' => 'The contact address must be a valid string.',

            'email.required' => 'Please enter an email address.',
            'email.email' => 'Enter a valid email address.',
            'email.unique' => 'This email is already registered. Please use a different email.',
            'email.regex' => 'Invalid email format. Please enter a valid email.',

            'website_address.required' => 'Please enter the website address.',
            'website_address.url' => 'Enter a valid website URL.',

            'contact_person.string' => 'The contact person name must be a valid string.',
            'contact_person.max' => 'The contact person name cannot exceed 255 characters.',

            'status.required' => 'Please select a status.',
            'status.in' => 'Invalid status selected. Please choose Active or Inactive.',
        ];
    }
}