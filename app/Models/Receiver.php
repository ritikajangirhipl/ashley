<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'name',
        'initial',
        'country_id',
        'website_url',
        'email',
        'password',
        'contact_name',
        'contact_number',
        'contact_email',
        'status',
        'created_at',
        'updated_at',
    ];

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function degrees(){
        return $this->morphMany('App\Models\Degree', 'degrable');
    }

    public function curriculums(){
        return $this->morphMany('App\Models\Curriculum', 'curriculumable');
    }

    public function billingDefinitions(){
        return $this->morphMany('App\Models\BillingDefinition', 'billable');
    }
    
}