<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerifyPayment extends Model
{
    protected static function boot () 
    {        
        parent::boot();
        static::creating(function(VerifyPayment $model) {
            $model->is_stage1_completed = false;
            if($model->payment_status == 'fully_paid'){
                $model->is_stage1_completed = true;
            }
        });
        static::updating(function(VerifyPayment $model) {
            $model->is_stage1_completed = false;
            if($model->payment_status == 'fully_paid'){
                $model->is_stage1_completed = true;
            }
        });
    }


    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'holder_submission_id',
        'bill_amount',
        'paid_amount',
        'payment_status',
        'payment_ref',
        'is_stage1_completed',
        'created_at',
        'updated_at',
    ];

    public function holderSubmission(){
        return $this->belongsTo(HolderSubmission::class);
    }
}
