<?php

namespace App\Http\Requests\EvaluationTemplates;

use App\Models\EvaluationTemplate;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('evaluation_templates_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
            'issuer_id' => [
                'required',
                'integer',
                'exists:issuers,id',
            ],
            'issuer_degree_id' => [
                'required',
                'integer',
                'exists:degrees,id',
            ],
            'issuer_curriculum_id' => [
                'required',
                'integer',
                'exists:curriculums,id',
            ],
            'receiver_id' => [
                'required',
                'integer',
                'exists:receivers,id',
            ],
            'receiver_degree_id' => [
                'required',
                'integer',
                'exists:degrees,id',
            ],
            'receiver_curriculum_id' => [
                'required',
                'integer',
                'exists:curriculums,id',
            ],
            'status' => [
                'required',
            ],
        ];

    }

    public function attributes()
    {
        return [
            'issuer_id'              => 'Issuer',
            'issuer_degree_id'       => 'Issuer Degree',
            'issuer_curriculum_id'   => 'Issuer Curriculum',
            'receiver_id'            => 'Receiver Curriculum',
            'receiver_degree_id'     => 'Receiver Degree',
            'receiver_curriculum_id' => 'Receiver Curriculum',
        ];
    }
}
