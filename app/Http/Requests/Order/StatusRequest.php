<?php

namespace App\Http\Requests\order;

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
            'id' => 'required|numeric|exists:orders,id',
            'status' => 'required|in:1,0',
        ];
    }
}