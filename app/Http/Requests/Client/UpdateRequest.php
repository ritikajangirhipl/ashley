<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }


    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'client_type' => 'required|in:individual,organization',
            'email' => 'required|email|unique:clients,email,' . $this->client->id,
            'phone_number' => 'required|numeric',
            'country_id' => 'required|exists:countries,id',
            'contact_address' => 'nullable|string',
            'website_address' => 'nullable|url',
            'status' => 'required|in:1,0',
        ];
    }

      public function messages()
    {
        return [
            'name.required' => 'Please enter client name.',
            'name.string' => 'Client name must be valid string.',
            'name.max' => 'Client name cannot exceed 255 characters.',
            'client_type.required' => 'Please select client type.',
            'client_type.in' => 'Client type must be either Individual or Organization.',
            'email.required' => 'Please enter email address.',
            'email.email' => 'Enter valid email address.',
            'email.unique' => 'This email is already registered.',
            'email.regex' => 'Invalid email format Please enter a valid email.',
            'phone_number.required' => 'Please enter phone number.',
            'phone_number.numeric' => 'Phone number should contain only numbers.',
            'country_id.required' => 'Please select country.',
            'country_id.exists' => 'The selected country is invalid.',
            'contact_address.required' => 'Please enter contact address.',
            'contact_address.string' => 'Contact address must be valid string.',
            'website_address.url' => 'Enter valid website URL.',
            'status.required' => 'Please select status.',
            'status.in' => 'Invalid status value.Please choose Active or Inactive.',
        ];
    }

}
