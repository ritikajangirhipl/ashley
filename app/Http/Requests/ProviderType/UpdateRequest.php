<?php

namespace App\Http\Requests\ProviderType;

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
            'name' => 'required|max:255|unique:provider_types,name,' . $this->provider_type->id. '|max:255', 
            'description' => 'required',
            'status' => 'required|in:1,0',
        ];
    }
}
