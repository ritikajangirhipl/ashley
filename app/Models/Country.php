<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
   protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'status',
        'created_at',
        'updated_at',
    ];

    public static function boot() {
        parent::boot();

        //while creating/inserting item into db  
        static::creating(function (Country $item) {
            $item->status ='active';  
        });
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format(config('app.date_time_format'));
    }

    public function accreditationBodies()
    {
        return $this->hasMany(AccreditationBody::class);
    }

}
