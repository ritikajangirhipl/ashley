<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationProvider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'country_id',
        'provider_type_id',
        'contact_address',
        'email',
        'website',
        'contact_person',
        'status',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function providerType()
    {
        return $this->belongsTo(ProviderType::class, 'provider_type_id', 'id');
    }
}


