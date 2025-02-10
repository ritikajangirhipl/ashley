<?php

namespace App\Http\Requests\ServicePartner;

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
            'id' => 'required|numeric|exists:service_partners,id',
            'status' => 'required|in:1,0',
        ];
    }
}