<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtractTranscriptMapping extends Model
{
    protected $fillable = [
        'extract_transcript_id',
        'evaluation_template_mapping_id',
        'issuer_curriculum_details_id',
        'earned',
        'grade',
        'point',        
    ];

    public function extractTranscript(){
        return $this->belongsTo(ExtractTranscript::class, 'extract_transcript_id', 'id');
    }

    public function issuerCurriculumDetail(){
        return $this->belongsTo(CurriculumDetail::class, 'issuer_curriculum_details_id', 'id');
    }

    public function evaluationTemplateMapping()
    {
        return $this->belongsTo(EvaluationTemplateMapping::class, 'evaluation_template_mapping_id', 'id');
    }
    
}
