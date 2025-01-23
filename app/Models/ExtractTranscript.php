<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtractTranscript extends Model
{

    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'holder_submission_id',
        'evaluation_template_id',
        'evaluation_template_mapping_id',
        'earned',
        'grade',
        'point',
        'is_report_generated',
        'report_name',
        'is_stage3_completed',
        
        'created_at',
        'updated_at',
    ];

    public function evaluationTemplate()
    {
        return $this->belongsTo(EvaluationTemplate::class, 'evaluation_template_id', 'id');
    }

    public function holderSubmission(){
        return $this->belongsTo(HolderSubmission::class, 'holder_submission_id', 'id');
    }

    public function extractTranscriptMappings(){
        return $this->hasMany(ExtractTranscriptMapping::class);
    }
}
