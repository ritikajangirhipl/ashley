<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'service_id',
        'subject_name',
        'document',
        'reason',
        'subject_consent',
        'reference_provider_name',
        'address_information',
        'location',
        'gender',
        'marital_status',
        'registration_number',
        'others',
        'preferred_currency',
        'order_amount',
        'payment_status',
        'processing_status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function location()
    {
        return $this->belongsTo(Country::class, 'location');
    }

    public function paymentStatus()
    {
        return $this->belongsTo(Payment::class, 'payment_status');
    }

    public function processingStatus()
    {
        return $this->belongsTo(Processing::class, 'processing_status');
    }
}

