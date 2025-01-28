<?php

namespace App\Http\Requests\VerificationMode;

use App\Models\VerificationMode;
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
            'name'     => [
                'unique:provider_types,name',
                'required',
                'string',
                'max:191',
            ],
            'description' => [
                'required',
                'string',
            ],
            'status' => [
                'required'
            ],

        ];

    }
}