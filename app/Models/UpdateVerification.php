<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpdateVerification extends Model
{

    protected static function boot () 
    {        
        $statusState = config('constant.holderSubmissionStages.requestVerification.status');
        parent::boot();
        static::creating(function(UpdateVerification $model) {
            if($model->o_level_verification_status == 'yes' && $model->degree_verification_status == 'yes' && $model->transcript_verification_status == 'yes'){
                $model->is_verified = true;
                $model->is_stage4_completed = true;
            }else{
                $model->is_verified = false;
                $model->is_stage4_completed = false;
            }
        });
        static::updating(function(UpdateVerification $model) {
            if($model->o_level_verification_status == 'yes' && $model->degree_verification_status == 'yes' && $model->transcript_verification_status == 'yes'){
                $model->is_verified = true;
                $model->is_stage4_completed = true;
            }else{
                $model->is_verified = false;
                $model->is_stage4_completed = false;
            }
        });
    }

    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'holder_submission_id',
        'update_o_level_certificate_source',
        'update_o_level_certificate_status',
        'o_level_verification_status',
        'update_degree_certificate_source',
        'update_degree_certificate_status',
        'degree_verification_status',
        'update_transcript_source',
        'update_transcript_status',
        'transcript_verification_status',
        'is_stage4_completed',
        'is_verified',
        'created_at',
        'updated_at',
    ];

    public function holderSubmission(){
        return $this->belongsTo(HolderSubmission::class, 'holder_submission_id', 'id');
    }
}
