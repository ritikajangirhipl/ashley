<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurriculumDetail extends Model
{
	protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'curriculum_id',
        'level_master_id',
        'course_code',
        'course_name',
        'course_credits',
        'school_ref',
        'status',
        'created_at',
        'updated_at',
    ];

    protected static function boot () 
    {
        parent::boot();
        static::creating(function(CurriculumDetail $model) {
            $courseCode = $model->course_code; // course_code
            $courseName = $model->course_name; // course_name

            if(request()->type == 'issuer'){
                $prefix = ucwords(request()->type);
                $model->school_ref = $courseCode.'-'.$courseName;
            }else{
                $prefix = ucwords(request()->type);
                $model->school_ref = $courseCode.'-'.$courseName;
            }
        });
    }

    public function levelMaster()
    {
        return $this->belongsTo(LevelMaster::class, 'level_master_id', 'id');
    }

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class, 'curriculum_id', 'id');
    }

    public function issuerExtractTranscriptMapping()
    {
        return $this->hasOne(ExtractTranscriptMapping::class, 'issuer_curriculum_details_id', 'id');
    }
    
    public function issuerEvaluationTemplateMapping()
    {
        return $this->hasOne(EvaluationTemplateMapping::class, 'issuer_curriculum_details_id', 'id');
    }

    public function receiverEvaluationTemplateMapping()
    {
        return $this->hasOne(EvaluationTemplateMapping::class, 'receiver_curriculum_details_id', 'id');
    }

}