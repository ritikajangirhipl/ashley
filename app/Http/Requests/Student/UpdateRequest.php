<?php

namespace App\Http\Requests\Student;

use App\Models\Student;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('student_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
            'email'    => [
                'required',
                'email',
                'unique:students,email,'.$this->student->id.'id',
            ],
            'phone_number' => [
                'required',
                'numeric',
                'digits_between:10,15',
            ],
            'dob'    => [
                'required',
                'date',
                'date_format:d-m-Y',
            ],
            'password' => [
                'required',
            ],
            'status' => [
                'required',
            ],
        ];

    }

    public function messages()
    {
        return [
            'dob.date_format' => 'DOB does not match the format (Exp. : d-m-Y).',
        ];
    }
}
