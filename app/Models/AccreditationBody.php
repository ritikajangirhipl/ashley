<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccreditationBody extends Model
{
    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'name',
        'country_id',
        'status',
        'created_at',
        'updated_at',
    ];

    public static function boot() {
        parent::boot();
        static::creating(function (Self $item) {
            $item->status = 'active';  
        });
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}