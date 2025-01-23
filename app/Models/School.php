<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{


    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];
}