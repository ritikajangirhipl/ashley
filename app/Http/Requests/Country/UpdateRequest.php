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
            'name' => 'required|string|max:255|unique:countries,name',
            'flag' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'description' => 'nullable|string',
            'currency_name' => 'required|string|max:255',
            'currency_symbol' => 'required|string|max:10',
            'status' => 'required|in:1,0',
        ];
    }

}
