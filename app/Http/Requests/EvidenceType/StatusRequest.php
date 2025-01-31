<?php

namespace App\Http\Requests\EvidenceType;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'id' => 'required|numeric|exists:evidence_types,id',
            'status' => 'required|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'The evidence type ID is required.',
            'id.exists' => 'The selected evidence type ID does not exist in our records.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The status must be either active or inactive.',
        ];
    }
}