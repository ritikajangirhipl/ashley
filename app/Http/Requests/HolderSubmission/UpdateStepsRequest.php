<?php

namespace App\Http\Requests\HolderSubmission;

use App\Models\HolderSubmission;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateStepsRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('holder_submission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'current_step'    => [
                'required',
                'integer',
                'max:8',
            ],
            'is_moved'    => [
                'required',
                'in:true,false',
            ],
            'bill_amount'    => [
                'required_if:current_step,gte,1',
            ],
            'payment_status'    => [
                'required_if:current_step,gte,1',
                'in:'.implode(',',array_keys(config('constant.enums.paymentStatus'))),
            ],
            'paid_amount'    => [
                'required_if:current_step,gte,1|required_unless:payment_status,not_paid',
            ],
            'payment_ref'    => [
                'required',
            ],

            
            'o_level_certificate_source'    => [
                'required_if:current_step,gte,2',
            ],
            'o_level_certificate_status'    => [
                'required_if:current_step,gte,2',
            ],
            'degree_certificate_source'    => [
                'required_if:current_step,gte,2',
            ],
            'degree_certificate_status'    => [
                'required_if:current_step,gte,2',
            ],
            'academic_transcript_source'    => [
                'required_if:current_step,gte,2',
            ],
            'academic_transcript_status'    => [
                'required_if:current_step,gte,2',
            ],
            'evaluation_template_id'    => [
                'required_if:current_step,gte,3',
                // 'exists:evaluation_templates,id',
            ],
            'mappings'    => [
                 'required_if:current_step,gte,3',
                 'array',
            ],
            'mappings.*.evaluation_template_mapping_id'    => [
                // 'required_if:current_step,gte,3',
                'nullable',
            ],            
            /*'mappings.*.earned'    => [
                'required_if:current_step,gte,3',
            ],            
            'mappings.*.grade'    => [
                'required_if:current_step,gte,3',
            ],
            'mappings.*.point'    => [
                'required_if:current_step,gte,3',
            ],*/
            'update_o_level_certificate_source'    => [
                'required_if:current_step,gte,4',
                // 'in:'.implode(',',array_keys(config('constant.holderSubmissionStages.updateVerification.status'))),
            ],
            'update_o_level_certificate_status'    => [
                'required_if:current_step,gte,4',
            ],
            'o_level_verification_status'    => [
                'required_if:current_step,gte,4',
            ],
            'update_degree_certificate_source'    => [
                'required_if:current_step,gte,4',
                // 'in:'.implode(',',array_keys(config('constant.holderSubmissionStages.updateVerification.status'))),
            ],
            'update_degree_certificate_status'    => [
                'required_if:current_step,gte,4',
            ],
            'degree_verification_status'    => [
                'required_if:current_step,gte,4',
            ],
            'update_transcript_source'    => [
                'required_if:current_step,gte,4',
                // 'in:'.implode(',',array_keys(config('constant.holderSubmissionStages.updateVerification.status'))),
            ],
            'update_transcript_status'    => [
                'required_if:current_step,gte,4',
            ],
            'transcript_verification_status'    => [
                'required_if:current_step,gte,4',
            ],
            'nigeria'    => [
                'required_if:current_step,gte,5',
                // 'in:'.implode(',',array_keys(config('constant.holderSubmissionStages.performEvaluation.status'))),
            ],
            'degree'    => [
                'required_if:current_step,gte,5',
                // 'in:'.implode(',',array_keys(config('constant.holderSubmissionStages.performEvaluation.status'))),
            ],
            'comparability'    => [
                'required_if:current_step,gte,5',
                // 'in:'.implode(',',array_keys(config('constant.holderSubmissionStages.status'))),
            ],
            'undergraduate_admission'    => [
                'required_if:current_step,gte,5',
            ],
            'admission_notes_1'    => [
                'required_if:current_step,gte,5',
            ],
            'admission_notes_2'    => [
                'required_if:current_step,gte,5',
            ],
            'summary_notes_1'    => [
                'required_if:current_step,gte,5',
            ],
            'summary_notes_2'    => [
                'required_if:current_step,gte,5',
            ],
            'summary_notes_3'    => [
                'required_if:current_step,gte,5',
            ],
            'recipent'    => [
                 'required_if:current_step,8',
                 'array',
            ],
            'recipent.*.name'    => [
                'required_if:current_step,gte,8',
            ],
            'recipent.*.email'    => [
                'required_if:current_step,gte,8',
            ],
        ];
    }

    public function attributes()
    {
        return [
            'evaluation_template_id'            => 'Evaluation Template',
            'evaluation_template_mapping_id.*'  => 'Template Mapping',
            'mappings.*.earned'                 => 'Earned',
            'mappings.*.grade'                  => 'Grade',
            'mappings.*.point'                  => 'Points',
            'current_step'                      => 'you submit stage',
            'recipent.*.name'                   => 'Recipent Name',
            'recipent.*.email'                  => 'Recipent Email',
        ];
    }

    public function messages()
    {
        return [
            'o_level_certificate.required_if'               => 'O Level Certificate is required.',
            'degree_certificate.required_if'                => 'Degree Certificate is required.',
            'academic_transcripts.required_if'              => 'Academic Transcripts is required.',
            'evaluation_template_mapping_id.*.required_if'  => 'Required hidden field',
            'earned.*.required_if'                          => 'Please enter earned value.',
            'grade.*.required_if'                           => 'Please enter grade value.',
            'point.*.required_if'                           => 'Please enter point value.',
            'mappings.required_if'                        => 'Please fill mapping details!',
        ];
    }
}
