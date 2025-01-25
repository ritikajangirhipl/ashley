<?php

namespace App\Http\Requests\VerificationProvider;

use App\Models\VerificationProvider;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'     => [
                'required',
                'string',
                'max:191',
            ],
            'description' => [
                'required',
                'string',
            ],
            'country' => [
                'required',
                'string',
            ],
            'provider-type' => [
                'required',
                'string',
            ],
            'contact-address' => [
                'required',
                'string',
            ],
            'email-address' => [
                'required',
                'string',
            ],
            'contact-person' => [
                'required',
                'string',
            ],
            'status' => [
                'required'
            ],

        ];

    }
}