<?php

namespace App\Http\Requests\Country;

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
            'name' => 'required|string|max:255|unique:countries,name',
            'flag' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'currency_name' => 'required|string|max:255',
            'currency_symbol' => 'required|string|max:10',
            'status' => 'required|in:1,0',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Please enter country name.',
            'name.string' => 'The country name must be valid string.',
            'name.max' => 'The country name cannot exceed 255 characters.',
            'name.unique' => 'This country name is already in use. Please enter a different name.',

            'flag.image' => 'The flag must be image file.',
            'flag.mimes' => 'The flag must be file of type: jpg, jpeg, png, gif, svg.',
            'flag.max' => 'The flag image size not exceed 2MB.',

            'description.string' => 'The description must be valid text.',

            'currency_name.required' => 'Please enter currency name.',
            'currency_name.string' => 'The currency name must be valid string.',
            'currency_name.max' => 'The currency name cannot exceed 255 characters.',

            'currency_symbol.required' => 'Please enter currency symbol.',
            'currency_symbol.max' => 'The currency symbol cannot exceed 10 characters.',

            'status.required' => 'Please select status.',
            'status.in' => 'Invalid status selected.Please choose Active or Inactive.',
        ];
    }
}
