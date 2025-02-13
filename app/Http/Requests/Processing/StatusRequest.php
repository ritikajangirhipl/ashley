<?php

namespace App\Http\Requests\Processing;

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
            'id' => 'required|numeric|exists:Processings,id',
            'status' => 'required|in:1,0',
        ];
    }
}