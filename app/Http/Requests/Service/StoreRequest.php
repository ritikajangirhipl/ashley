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
            'name' => 'required|string|max:255|',
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
            'status' => 'required|in:0,1', 
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter the service name.',
            'name.string' => 'The service name must be a valid string.',
            'name.max' => 'The service name cannot exceed 255 characters.',

            'description.max' => 'The description cannot exceed 500 characters.',

            'country_id.required' => 'Please select a country.',
            'category_id.required' => 'Please select a category.',
            'sub_category_id.required' => 'Please select a sub-category.',
            'subject.required' => 'Please enter the subject.',
            'verification_mode_id.required' => 'Please select a verification mode.',
            'verification_summary.required' => 'Please enter the verification summary.',
            'verification_provider_id.required' => 'Please select a verification provider.',
            'verification_duration.required' => 'Please enter the verification duration.',
            'evidence_type_id.required' => 'Please select an evidence type.',
            'evidence_summary.required' => 'Please enter the evidence summary.',
            'service_partner_id.required' => 'Please select a service partner.',
            'service_currency.required' => 'Please enter the service currency.',
            'local_service_price.required' => 'Please enter the local service price.',
            'usd_service_price.required' => 'Please enter the USD service price.',
            'subject_name.required' => 'Please enter the subject name.',
            'copy_of_document_to_verify.required' => 'Please enter the document to verify.',
            'reason_for_request.required' => 'Please enter the reason for the request.',
            'subject_consent_requirement.required' => 'Please enter the subject consent requirement.',
            'name_of_reference_provider.required' => 'Please enter the name of the reference provider.',
            'address_information.required' => 'Please enter the address information.',
            'location.required' => 'Please enter the location.',
            'gender.required' => 'Please select gender.',
            'marital_status.required' => 'Please select marital status.',
            'registration_number.required' => 'Please enter the registration number.',

            'status.required' => 'Please select a status.',
            'status.in' => 'Invalid status selected. Please choose Active or Inactive.',
        ];
    }

}


