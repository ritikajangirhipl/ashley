<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients'; 
    protected $fillable = [
        'name',
        'client_type',
        'email_address',
        'phone_number',
        'country_id',
        'contact_address',
        'website_address',
        'password',
        'status'
    ];



    public function country()
    {
        return $this->belongsTo(Contry::class, 'country_id', 'id');
    }
}