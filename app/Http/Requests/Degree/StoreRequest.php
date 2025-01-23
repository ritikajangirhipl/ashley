<?php

namespace App\Http\Requests\Degree;

use App\Models\Degree;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('degrees_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        if($this->degreeType == 'issuer'){
            $tableName = 'issuers';
        }else{
            $tableName = 'receivers';
        }
        return [
            'degrable_id' => [
                'required',
                'integer',
                'exists:'.$tableName.',id', 
            ],
             'qualification' => [
                'required',
            ],
            'country_id' => [
                'required',
                'integer',
                'exists:countries,id',
            ],
            'accreditation_status' => [
                'required',
            ],
            'accreditation_body_id' => [
                'required',
                'integer',
                'exists:accreditation_bodies,id',
            ],
            'program_length_required' => [
                'required',
                'string'
            ],
            'course_type' => [
                'required',
            ],
            'admission_requirement_1' => [
                'required',
                'string',
            ],
            'admission_requirement_2' => [
                'required',
                'string',
            ],
            'status' => [
                'required',
            ],
        ];        
    }

    public function attributes()
    {
        return [
            'degrable_id'               => 'Degree',
            'country_id'                => 'Country',
            'accreditation_body_id'     => 'Accreditation Body',
        ];
    }
}
