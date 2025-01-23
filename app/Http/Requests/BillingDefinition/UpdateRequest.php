<?php

namespace App\Http\Requests\BillingDefinition;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('billing_definitions_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        if($this->billingType == 'issuer'){
            $tableName = 'issuers';
        }else{
            $tableName = 'receivers';
        }
        $rules = [
            'billable_id' => [
                'required',
                'integer',
                'exists:'.$tableName.',id',
                'unique:billing_definitions,billable_id,' .$this->billingDefinition->id.',id,degree_id,'.request()->degree_id,
            ],  
            'degree_id' => [
                'required',
                'integer',
                'exists:degrees,id',
                'unique:billing_definitions,degree_id,' .$this->billingDefinition->id.',id,billable_id,'.request()->billable_id,
            ],    
            'other_fees' => [
                'required',
            ],
            'total_fees' => [
                'required',
            ],
            'status' => [
                'required',
            ],
        ];   
        if($this->billingType == 'issuer'){
            $rules['evaluation_fees']   = 'required';
            $rules['translation_fees']  = 'required';
            $rules['verification_fees'] = 'required';
        }else{
            $rules['receiver_fees']     = 'required';
        }
        return $rules;     
    }

    public function attributes()
    {
        return [
            'billable_id'               => trans('cruds.'.$this->billingType.'.title_singular'),
            'degree_id'                 => trans('cruds.degrees.title_singular'),
        ];
    }

    public function messages()
    {
        return [
            'billable_id.unique'        => "Issuer and Degree must be unique",
            'degree_id.unique'          => "Issuer and Degree must be unique",
        ];
    }
    
}
