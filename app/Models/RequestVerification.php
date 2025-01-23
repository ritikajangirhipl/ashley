<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestVerification extends Model
{

    protected static function boot () 
    {        
        $statusState = config('constant.holderSubmissionStages.requestVerification.status');
        parent::boot();
        static::creating(function(RequestVerification $model) {
            if($model->o_level_certificate_status == 'requested' && $model->degree_certificate_status == 'requested' && $model->academic_transcript_status == 'requested'){
                $model->is_requested = true;
                $model->is_stage2_completed = true;
            }else{
                $model->is_requested = false;
                $model->is_stage2_completed = false;
            }
        });
        static::updating(function(RequestVerification $model) {
            if($model->o_level_certificate_status == 'requested' && $model->degree_certificate_status == 'requested' && $model->academic_transcript_status == 'requested'){
                $model->is_requested = true;
                $model->is_stage2_completed = true;
            }else{
                $model->is_requested = false;
                $model->is_stage2_completed = false;
            }
        });
    }



    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'holder_submission_id',
        'o_level_certificate_source',
        'o_level_certificate_status',
        'degree_certificate_source',
        'degree_certificate_status',
        'academic_transcript_source',
        'academic_transcript_status',
        'is_requested',
        'is_stage2_completed',
        'created_at',
        'updated_at',
    ];

    public function holderSubmission(){
        return $this->belongsTo(HolderSubmission::class);
    }
}
