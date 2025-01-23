<?php

namespace App\Http\Requests\HolderSubmission;

use App\Models\HolderSubmission;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('holder_submission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'submission_date'    => [
                'required',
                'date_format:d-m-Y',
            ],
            'student_id' => [
                'required',
                'integer',
                'exists:students,id',
            ],
            'issuer_id' => [
                'required',
                'integer',
                'exists:curriculums,id',
            ],
            'issuer_degree_id' => [
                'required',
                'integer',
                'exists:degrees,id',
            ],
            'school_name'     => [
                'required',
                'string',
                'max:191',
            ],
            'start_year'    => [
                'required',
                'integer',
            ],
            'start_year'    => [
                'required',
                'integer',
            ],
            'receiver_id' => [
                'required',
                'integer',
                'exists:degrees,id',
            ],
            'receiver_degree_id' => [
                'required',
                'integer',
                'exists:degrees,id',
            ],
            'receiver_reference' => [
                'required',
                'string',
                'max:191',
            ],
            'o_level_certificate' => [
                'nullable',
                'mimes:pdf',
                'max:5000',
            ],
            'degree_certificate' => [
                'nullable',
                'mimes:pdf',
                'max:5000',
            ],
            'academic_transcripts' => [
                'nullable',
                'mimes:pdf',
                'max:5000',
            ],
            'receiver_letter' => [
                'nullable',
                'mimes:pdf',
                'max:5000',
            ],
            'ministry_of_education_letter' => [
                'nullable',
                'mimes:pdf',
                'max:5000',
            ],
            'birth_certificate' => [
                'nullable',
                'mimes:pdf',
                'max:5000',
            ],
            'fees_to_pay' => [
                'required',
                'numeric',
            ],
            'status' => [
                'required',
            ],
        ];
    }

    public function attributes()
    {
        return [
            'issuer_id'          => 'Issuer',
            'issuer_degree_id'   => 'Issuer Degree',
            'receiver_id'        => 'Receiver',
            'receiver_degree_id' => 'Receiver Degree',
        ];
    }

    public function messages()
    {
        return [
            'submission_date.date_format' => 'DOB does not match the format (Exp. : d-m-Y).',
        ];
    }
}
