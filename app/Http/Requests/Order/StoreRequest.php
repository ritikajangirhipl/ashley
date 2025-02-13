<?php
namespace App\Http\Requests\Order;

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
            'client_id' => 'required|exists:clients,id',
            'service_id' => 'required|exists:services,id', 
            'subject_name' => 'required|string|max:255',
            'document' => 'nullable|file|mimes:pdf|max:10240', 
            'reason' => 'required|in:admission,employment,other', 
            'subject_consent' => 'nullable|file|mimes:pdf|max:10240',
            'reference_provider_name' => 'nullable|string|max:255',
            'address_information' => 'nullable|string',
            'location' => 'required|exists:countries,id',
            'gender' => 'required|in:male,female,other', 
            'marital_status' => 'required|in:married,single,other', 
            'registration_number' => 'nullable|string|max:255',
            'others' => 'nullable|string',
            'preferred_currency' => 'required|in:USD,service_currency', 
            'order_amount' => 'nullable|numeric', 
            'payment_status' => 'required|exists:payments,id', 
            'processing_status' => 'required|exists:processings,id',
        ];
    }

    public function messages()
    {
        return [
            'client_id.required' => 'The client is required.',
            'service_id.required' => 'The service is required.',
            'subject_name.required' => 'The subject name is required.',
            'document.mimes' => 'The document must be a PDF file.',
            'reason.required' => 'The reason for request is required.',
            'reason.in' => 'The reason must be one of the following: admission, employment, other.',
            'gender.required' => 'The gender is required.',
            'gender.in' => 'The gender must be male, female, or other.',
            'location.required' => 'The location is required.',
            'location.exists' => 'The selected location is invalid.',
            'payment_status.required' => 'The payment status is required.',
            'payment_status.exists' => 'The selected payment status is invalid.',
            'processing_status.required' => 'The processing status is required.',
            'processing_status.exists' => 'The selected processing status is invalid.',
        ];
    }
}
