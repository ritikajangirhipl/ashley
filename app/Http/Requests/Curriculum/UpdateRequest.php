<?php

namespace App\Http\Requests\Curriculum;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('degrees_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        if($this->type == 'issuer'){
            $tableName = 'issuers';
        }else{
            $tableName = 'receivers';
        }
        return [
            'curriculumable_id' => [
                'required',
                'integer',
                'exists:'.$tableName.',id',   
            ],
            'name' => [
                'required',
            ],
            'degree_id' => [
                'required',
                'integer',
                'exists:degrees,id',
            ],
            'status' => [
                'required',
            ],
        ]; 
    }

    public function attributes()
    {
        return [
            'curriculumable_id'         => ucwords($this->type),
            'degree_id'                => 'Degree',
        ];
    }
    
}
