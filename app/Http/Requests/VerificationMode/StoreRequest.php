<?php

namespace App\Http\Requests\VerificationMode;

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
            'name' => 'required|unique:verification_modes,name|max:255',
            'description' => 'required',
            'status' => 'required|in:1,0',
        ];
    }
}
