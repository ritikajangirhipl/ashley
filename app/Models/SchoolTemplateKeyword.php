<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolTemplateKeyword extends Model
{


    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'level_master_id',
        'code',
        'course_name',
        'credit',
        'created_at',
        'updated_at',
    ];
}