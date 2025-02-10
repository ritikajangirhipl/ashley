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

}

