<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issuer extends Model
{
	protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'country_id',
        'name',
        'initial',
        'type',
        'recognition_status',
        'accreditation_status',
        'accreditation_body_id',
        'website_url',
        'email',
        'address',
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

    public function accreditationBody(){
        return $this->belongsTo(AccreditationBody::class);
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