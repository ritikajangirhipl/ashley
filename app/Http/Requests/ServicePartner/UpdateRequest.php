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
            'name' => 'required|max:255',
            'description' => 'nullable|string',
            'country_id' => 'required|exists:countries,id',
            'contact_address' => 'nullable|string',
            'email' => [
                'required',
                'email',
                'unique:service_partners,email,' . $this->service_partner->id, 
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', 
            ],
            'website_address' => 'required|url',
            'contact_person' => 'nullable|string|max:255',
            'status' => 'required|in:1,0',
        ];
    }
}