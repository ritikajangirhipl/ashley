<?php

namespace App\Http\Requests\Processing;

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
            'order_id' => 'required|exists:orders,id', 
            'status' => 'required|in:Not Started,Processing,Complete,Cancelled',  
            'verification_outcome' => 'nullable|in:Passed,Failed', 
            'outcome_evidence' => 'nullable|file|mimes:pdf',
        ];
    }
}
