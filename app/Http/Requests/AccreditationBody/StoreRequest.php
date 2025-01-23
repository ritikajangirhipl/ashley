<?php

namespace App\Http\Requests\AccreditationBody;

use App\Models\AccreditationBody;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('accreditation_body_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return true;
    }


    public function rules()
    {
        return [
            'name'     => [
                'required',
                'string',
                'max:191',
                'unique:accreditation_bodies,name',
            ],
            'country_id'     => [
                'required',
                'exists:countries,id',
            ]
        ];

    }
}
