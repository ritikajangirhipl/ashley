<?php

namespace App\Http\Requests\ProviderType;

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
            'name' => 'required|unique:provider_types|max:255', 
            'description' => 'required',
            'status' => 'required|in:1,0',
        ];
    }
}
