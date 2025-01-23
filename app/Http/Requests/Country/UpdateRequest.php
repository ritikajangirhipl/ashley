<?php

namespace App\Http\Requests\Country;

use App\Models\Country;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('country_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'name'    => [
                'required',
                'string',
                //'regex:/^[\pL\s\-]+$/u',
                //'regex:/(^[A-Za-z0-9 ]+$)+/',
                'max:191',
                'unique:countries,name,'. $this->country->id,
            ],
        ];

    }
}
