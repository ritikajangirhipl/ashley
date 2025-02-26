<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'uuid',
        'client_id',
        'service_id',
        'subject_name',
        'copy_of_document_to_verify',
        'reason_for_request',
        'subject_consent_requirement',
        'name_of_reference_provider',
        'address_information',
        'location_id',
        'gender',
        'marital_status',
        'registration_number',
        'preferred_currency',
        'order_amount',
        'status',
    ];
    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
           $model->uuid = Str::uuid()->toString();
        });
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'location_id', 'id');
    }
}
