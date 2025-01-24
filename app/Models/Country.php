<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $primaryKey = 'CountryID'; 

    protected $fillable = [
        'name',
        'flag',
        'description',
        'currency_name',
        'currency_symbol',
        'status',
    ];
}