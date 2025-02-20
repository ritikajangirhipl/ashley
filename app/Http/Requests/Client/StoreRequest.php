<?php

namespace App\Http\Requests\Client;

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
            'name' => 'required|string|max:255|',
            'client_type' => 'required|in:individual,organization',
            'email' => [
                'required',
                'email',
                'unique:clients,email',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            ],
            'phone_number' => 'required|numeric',
            'country_id' => 'required|exists:countries,id',
            'contact_address' => 'required|string',
            'website_address' => 'nullable|url',
            'password' => 'required|string|min:8',
            'status' => 'required|in:1,0',
        ];
    }
}
