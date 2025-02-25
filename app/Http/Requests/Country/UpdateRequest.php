<?php

namespace App\Http\Requests\Country;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required',
                        // unique:countries,name,'. $this->country->id.,
                        Rule::unique('countries', 'name')->ignore($this->country)->whereNull('deleted_at'),
                        'max:255'
                    ],
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
            'name.required' => 'Please enter country name.',
            'name.unique' => 'This country name is already in use. Please enter different name.',
            'name.max' => 'The country name cannot exceed 255 characters.',

            'flag.image' => 'The flag must be image file.',
            'flag.mimes' => 'The flag must be file of type: jpg, jpeg, png, gif.',
            'flag.max' => 'The flag image size must not exceed 2MB.',

            'description.string' => 'The description must be valid text.',

            'currency_name.required' => 'Please enter currency name.',
            'currency_name.max' => 'The currency name cannot exceed 255 characters.',

            'currency_symbol.required' => 'Please enter currency symbol.',
            'currency_symbol.string' => 'The currency symbol must be valid string.',
            'currency_symbol.max' => 'The currency symbol cannot exceed 10 characters.',

            'status.required' => 'Please select status.',
            'status.in' => 'Invalid status selected.Please choose Active or Inactive.',
        ];
    }

}
