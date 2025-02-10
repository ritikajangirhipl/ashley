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
}

