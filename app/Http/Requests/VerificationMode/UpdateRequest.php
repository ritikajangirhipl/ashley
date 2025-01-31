<?php

namespace App\Http\Requests\VerificationMode;

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
            'name' => 'required|unique:verification_modes,name,' . $this->verification_mode->id . '|max:255',
            'description' => 'nullable',
            'status' => 'required|in:1,0',
        ];
    }
}
