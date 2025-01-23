<?php

namespace App\Http\Requests\Receiver;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('receivers_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
            'initial'     => [
                'required',
                'string',
                'max:191',
            ],
            'email'    => [
                'required',
                'email',
            ],
            'country_id' => [
                'required',
                'integer',
                'exists:countries,id',
            ],
            'website_url' => [
                'required',
                'url',
            ],
            'password' => [
                'required',
            ],
            'contact_name' => [
                'required',
                'string',
                'max:191',
            ],
            'contact_number' => [
                'required',
                'numeric',
                'digits_between:10,15',
            ],
            'contact_email' => [
                'required',
                'email',
            ],
            'status' => [
                'required',
            ],


        ];

    }
}
