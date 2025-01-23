<?php

namespace App\Http\Requests\CurriculumDetail;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('curriculum_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        if($this->type == 'issuer'){
            $tableName = 'curriculums';
        }else{
            $tableName = 'curriculums';
        }
        return [
            'curriculum_id' => [
                'required',
                'integer',
                'exists:'.$tableName.',id',   
            ],
            'level_master_id' => [
                'required',
                'integer',
                'exists:level_masters,id',
            ],
            'course_code' => [
                'required',
                'string',
                'max:191',
            ],
            'course_name' => [
                'required',
                'string',
                'max:191',
            ],
            'course_credits' => [
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
            'curriculum_id' => ucwords($this->type),
        ];
    }
    
}
