<?php

namespace App\Http\Requests\EvaluationTemplateMapping;

use App\Models\EvaluationTemplateMapping;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('evaluation_template_mapping_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'evaluation_template_id' => [
                'required',
                'integer',
                'exists:evaluation_templates,id',
            ],
            'issuer_curriculum_details_id' => [
                'required',
                'integer',
                'exists:curriculum_details,id',
                'unique:evaluation_template_mappings,issuer_curriculum_details_id,'.$this->evaluationTemplateMapping->id.',id,receiver_curriculum_details_id,'.$this->receiver_curriculum_details_id
            ],
            'receiver_curriculum_details_id' => [
                'required',
                'integer',
                'exists:curriculum_details,id',
                'unique:evaluation_template_mappings,receiver_curriculum_details_id,'.$this->evaluationTemplateMapping->id.',id,issuer_curriculum_details_id,'.$this->issuer_curriculum_details_id
            ],
            'status' => [
                'required',
            ],
        ];

    }

    public function attributes()
    {
        return [
            'evaluation_template_id' => 'Evaluation Template',
            'issuer_curriculum_details_id' => 'Issuer Curriculum Details',
            'receiver_curriculum_details_id' => 'Receiver Curriculum Details',
        ];
    }
}
