<?php

namespace App\Http\Requests\ServicePartner;

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
            'name' => 'required|unique:service_partner,name,' . $this->service_partner->id . '|max:255',
            'description' => 'nullable|string',
            'country_id' => 'required|exists:countries,id',
            'contact_address' => 'nullable|string',
            'email_address' => 'required|email|unique:service_partner,email_address,' . $this->service_partner->id, // Updated to 'email_address'
            'website' => 'required|url',
            'contact_person' => 'nullable|string|max:255',
            'status' => 'required|in:1,0',
        ];
    }
}