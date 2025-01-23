<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrepareReport extends Model
{
    protected static function boot () 
    {
        parent::boot();
        static::creating(function($model) {
            if($model->is_both_merge == true && !empty($model->is_both_merge)){
                $model->is_stage6_completed = true;
            }
        });
    }


    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'holder_submission_id',
        'is_evaluation_report_generated',
        'evaluation_report_name',
        'is_extraction_report_generated',
        'extraction_report_name',
        'is_both_merge',
        'merge_report_name',
        'is_stage6_completed',
        'created_at',
        'updated_at',
    ];

    public function holderSubmission(){
        return $this->belongsTo(HolderSubmission::class, 'holder_submission_id', 'id');
    }
}
