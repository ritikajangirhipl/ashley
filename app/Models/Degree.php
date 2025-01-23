<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [ 
        'degrable_id',       
        'country_id',
        'qualification',
        'accreditation_status',
        'accreditation_body_id',
        'program_length_required',
        'course_type',
        'specialization',
        'admission_requirement_1',
        'admission_requirement_2',
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

    public function curriculums()
    {
        return $this->hasMany(Curriculum::class);
    }

    public function degrable()
    {
        return $this->morphTo();
    }

    public function isIssuerDegree()
    {
        return $this->where('id',$this->id)->where('degrable_type','App\Models\Issuer')->exists();
    }

}