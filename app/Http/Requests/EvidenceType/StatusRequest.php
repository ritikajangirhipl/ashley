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
            'status' => 'required|in:1,0',
        ];
    }
}