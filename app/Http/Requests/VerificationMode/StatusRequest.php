<?php

namespace App\Http\Requests\VerificationMode;

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
            'id' => 'required|numeric|exists:verification_modes,id',
            'status' => 'required|in:1,0',
        ];
    }
}