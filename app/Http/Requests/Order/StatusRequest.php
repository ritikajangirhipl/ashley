<?php

namespace App\Http\Requests\order;

use Illuminate\Foundation\Http\FormRequest;

// app/Http/Requests/Order/StatusRequest.php
namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
{
    public function rules()
    {
        return [
            'payment_status' => 'required|exists:payments,id', 
            'processing_status' => 'required|exists:processings,id',
        ];
    }
    public function messages()
    {
        return [
            'payment_status.required' => 'The payment status is required.',
            'payment_status.exists' => 'The selected payment status is invalid.',
            'processing_status.required' => 'The processing status is required.',
            'processing_status.exists' => 'The selected processing status is invalid.',
        ];
    }
}
