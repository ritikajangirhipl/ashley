<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationTemplate extends Model
{
    protected $table = "evaluation_templates";

    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'name',
        'issuer_id',
        'issuer_degree_id',
        'issuer_curriculum_id',
        'receiver_id',
        'receiver_degree_id',
        'receiver_curriculum_id',
        'status',
        'created_at',
        'updated_at',
    ];

    public function evaluationTemplateMappings()
    {
        return $this->hasMany(EvaluationTemplateMapping::class);
    }

    public function issuers()
    {
        return $this->belongsTo(Issuer::class, 'issuer_id', 'id');
    }

    public function receivers()
    {
        return $this->belongsTo(Receiver::class, 'receiver_id', 'id');
    }

    public function issuerDegree()
    {
        return $this->belongsTo(Degree::class, 'issuer_degree_id', 'id');
    }

    public function receiverDegree()
    {
        return $this->belongsTo(Degree::class, 'receiver_degree_id', 'id');
    }

    public function issuerCurriculum()
    {
        return $this->belongsTo(Curriculum::class,'issuer_curriculum_id','id')->where('curriculumable_type', 'App\Models\Issuer');
    }

    public function receiverCurriculum()
    {
        return $this->belongsTo(Curriculum::class)->where('curriculumable_type', 'App\Models\Receiver');
    }

}