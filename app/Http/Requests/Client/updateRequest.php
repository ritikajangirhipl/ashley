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
            'email_address' => 'required|email|unique:clients,email_address,' . $this->client->id,
            'phone_number' => 'required|numeric',
            'country_id' => 'required|exists:countries,id',
            'contact_address' => 'nullable|string',
            'website_address' => 'nullable|url',
            'status' => 'required|in:1,0',
        ];
    }

}
