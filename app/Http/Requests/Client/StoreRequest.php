<?php

namespace App\Http\Requests\client;

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

            'name' => 'required|unique:client,name|max:255',
            'client_type' => 'nullable|string',
            'country_id' => 'required|exists:countries,id',
            'phone_number' => 'nullable',
            'contact_address' => 'nullable|string',
            'email_address' => 'required|email|unique:client,email_address',
            'website_address' => 'required|url',
            'password' => 'nullable|string|max:255',
            'status' => 'required|in:1,0',
        
            
        ];
    }
}
