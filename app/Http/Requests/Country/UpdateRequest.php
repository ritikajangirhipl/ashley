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
            'name' => 'required|unique:countries,name,'. $this->country->id.'|max:255 ',
            'flag' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'description' => 'nullable|string',
            'currency_name' => 'required|string|max:255',
            'currency_symbol' => 'required|string|max:10',
            'status' => 'required|in:1,0',
        ];
    }

}
