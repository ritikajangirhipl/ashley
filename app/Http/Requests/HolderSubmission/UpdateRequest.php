<?php

namespace App\Http\Requests\HolderSubmission;

use App\Models\HolderSubmission;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('holder_submission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
            //'o_level_certificate_is_remove' => 'nullable|in:0,1',
            'o_level_certificate' => [
                'required_if:o_level_certificate_is_remove,1',
                'mimes:pdf',
                'max:5000',
            ],
            //'degree_certificate_is_remove' => 'nullable|in:0,1',
            'degree_certificate' => [
                'required_if:degree_certificate_is_remove,1',
                'mimes:pdf',
                'max:5000',
            ],
            //'academic_transcripts_is_remove' => 'nullable|in:0,1',
            'academic_transcripts' => [
                'required_if:academic_transcripts_is_remove,1',
                'mimes:pdf',
                'max:5000',
            ],
            //'receiver_letter_is_remove' => 'nullable|in:0,1',
            'receiver_letter' => [
                'required_if:receiver_letter_is_remove,1',
                'mimes:pdf',
                'max:5000',
            ],
            //'ministry_of_education_letter_is_remove' => 'nullable|in:0,1',
            'ministry_of_education_letter' => [
                'required_if:ministry_of_education_letter_is_remove,1',
                'mimes:pdf',
                'max:5000',
            ],
            //'birth_certificate_is_remove' => 'nullable|in:0,1',
            'birth_certificate' => [
                'required_if:birth_certificate_is_remove,1',
                'mimes:pdf',
                'max:5000',
            ],
            'fees_to_pay' => [
                //'required',
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
            'o_level_certificate.required_if' => 'O Level Certificate is required.',
            'degree_certificate.required_if' => 'Degree Certificate is required.',
            'academic_transcripts.required_if' => 'Academic Transcripts is required.',
            'receiver_letter.required_if' => 'Receiver Letter is required.',
            'ministry_of_education_letter.required_if' => 'Ministry of Education Letter is required.',
            'birth_certificate.required_if' => 'Birth Certificate is required.',
            'submission_date.date_format' => 'Submission Date does not match the format (Exp. : d-m-Y).',
        ];
    }
}
