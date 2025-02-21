<?php
namespace App\Http\Requests\EvidenceType;

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
            'name' => 'required|unique:evidence_types,name,' . $this->evidence_type->id . ',id|max:255',
            'description' => 'nullable|max:255',
            'status' => 'required|in:1,0',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Please enter the evidence type name.',
            'name.unique' => 'This evidence type name is already in use. Please choose another name.',
            'name.max' => 'The evidence type name cannot exceed 255 characters.',

            'description.max' => 'The description cannot exceed 255 characters.',

            'status.required' => 'Please select a status.',
            'status.in' => 'Invalid status selected. Please choose Active or Inactive.',
        ];
    }

}

