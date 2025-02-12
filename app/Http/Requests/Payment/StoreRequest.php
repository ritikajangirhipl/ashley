<?php

namespace App\Http\Requests\Payment;

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
            'order_id' => 'required|exists:orders,id', 
            'reference_number' => 'required|string|unique:payments,reference_number|max:255', 
            'evidence' => 'nullable|mimes:pdf|max:10240', 
            'status' => 'required|in:successful,failed', 
            'amount' => 'required|numeric|min:0.01',  
            'currency' => 'required|string|max:10',  
        ];
    }
}
