<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LevelMaster extends Model
{


    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
    ];
}