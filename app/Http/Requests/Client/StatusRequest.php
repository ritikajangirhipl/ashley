<?php

namespace App\Http\Requests\client;

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
            'id' => 'required|numeric|exists:clients,id',
            'status' => 'required|in:1,0',
        ];
    }
}