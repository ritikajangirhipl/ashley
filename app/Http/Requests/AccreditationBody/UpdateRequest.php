<?php

namespace App\Http\Requests\AccreditationBody;

use App\Models\AccreditationBody;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('accreditation_body_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'name'    => [
                'required',
                'string',
                'max:191',
                'unique:accreditation_bodies,name,'. $this->accreditationBody->id,
            ],
            'country_id'     => [
                'required',
                'exists:countries,id',
            ]
        ];

    }
}
