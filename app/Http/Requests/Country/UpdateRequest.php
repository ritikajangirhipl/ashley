<?php

namespace App\Http\Requests\Country;

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
            'flag' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'description' => 'nullable|string',
            'currency_name' => 'required|string|max:255',
            'currency_symbol' => 'required|string|max:10',
            'status' => 'required|in:1,0',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Country name is required.',
            'name.unique' => 'This country name has already been taken.',
            'flag.image' => 'The flag must be an image.',
            'currency_name.required' => 'Currency name is required.',
            'currency_symbol.required' => 'Currency symbol is required.',
            'status.required' => 'Status is required.',
        ];
    }
}
