<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Student extends Model
{

    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'dob',
        'password',
        'status',
        'created_at',
        'updated_at',
    ];

    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }

    public function getDobAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

}