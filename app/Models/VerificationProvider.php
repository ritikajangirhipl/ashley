<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationProvider extends Model
{
    use HasFactory;

    protected $primaryKey = 'VerificationProviderID'; 

    protected $fillable = [
        'name',
        'description',
        'country',
        'provider-type',
        'contact-address',
        'email-address',
        'website-address',
        'contact-person',
        'status',
    ];
}