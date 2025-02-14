<?php
namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'gender' => 'required|string', 
            'marital_status' => 'required|string', 
            'registration_number' => 'nullable|string|max:255',
            'others' => 'nullable|string',
            'preferred_currency' => 'required|in:USD,service_currency', 
            'order_amount' => 'nullable|numeric',
            'payment_status' => 'required|exists:payments,id', 
            'processing_status' => 'required|exists:processings,id', 
        ];
    }
}
