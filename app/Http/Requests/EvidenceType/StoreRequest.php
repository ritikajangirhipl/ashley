<?php
namespace App\Http\Requests\EvidenceType;

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
            'name' => 'required|unique:evidence_types|max:255',  
            'description' => 'nullable|max:255',
            'status' => 'required|in:1,0',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required.',
            'name.unique' => 'This evidence type name already exists.',
            'status.required' => 'Please select a status.',
            'status.in' => 'The status must be either active or inactive.',
        ];
    }
}

