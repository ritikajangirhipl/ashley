<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:services,name',
            'description' => 'nullable|string|max:500',
            "country_id" => 'required',
            "category_id" => 'required',
            "sub_category_id" => 'required',
            "subject" => 'required',
            "verification_mode_id" => 'required',
            "verification_summary" => 'required',
            "verification_provider_id" => 'required',
            "verification_duration" => 'required',
            "evidence_type_id" => 'required',
            "evidence_summary" => 'required',
            "service_partner_id" => 'required',
            "service_currency" => 'required',
            "local_service_price" => 'required',
            "usd_service_price" => 'required',
            "subject_name" => 'required',
            "copy_of_document_to_verify" => 'required',
            "reason_for_request" => 'required',
            "subject_consent_requirement" => 'required',
            "name_of_reference_provider" => 'required',
            "address_information" => 'required',
            "location" => 'required',
            "gender" => 'required',
            "marital_status" => 'required',
            "registration_number" => 'required',
            "marital_status" => 'required',
            'status' => 'required|in:0,1', 
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.unique' => 'This service name has already been taken.',
            'status.in' => 'The status must be either active or inactive.',
        ];
    }
}


