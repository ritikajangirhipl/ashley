<?php

namespace App\Http\Requests\ProviderType;

use App\Models\ProviderType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

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