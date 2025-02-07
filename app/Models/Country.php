<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'flag',
        'description',
        'currency_name',
        'currency_symbol',
        'status',
    ];

    public function verificationProviders()
    {
        return $this->hasMany(VerificationProvider::class, 'country_id', 'id');
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'country_id', 'id');
    }

    public function servicePartners()
    {
        return $this->hasMany(ServicePartner::class, 'country_id', 'id');
    }
}