<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationTemplateMapping extends Model
{
    protected $table = "evaluation_template_mappings";

    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'evaluation_template_id',
        'issuer_curriculum_details_id',
        'receiver_curriculum_details_id',
        'status',
        'created_at',
        'updated_at',
    ];

    public function evaluationTemplates()
    {
        return $this->belongsTo(EvaluationTemplate::class, 'evaluation_template_id', 'id');
    }

    public function issuerCurriculumDetail()
    {
        return $this->belongsTo(CurriculumDetail::class, 'issuer_curriculum_details_id', 'id');
    }

    public function receiverCurriculumDetail()
    {
        return $this->belongsTo(CurriculumDetail::class, 'receiver_curriculum_details_id', 'id');
    }

    public function extractTranscriptMapping()
    {
        return $this->hasOne(ExtractTranscriptMapping::class, 'evaluation_template_mapping_id', 'id');
    }
}
