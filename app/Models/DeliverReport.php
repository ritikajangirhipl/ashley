<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliverReport extends Model
{
    
    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'holder_submission_id',
        'is_report_delivered',
        'is_stage8_completed',
        'created_at',
        'updated_at',
    ];

    public function holderSubmission(){
        return $this->belongsTo(HolderSubmission::class, 'holder_submission_id', 'id');
    }

    public function deliverReportReceivers(){
        return $this->hasMany(DeliverReportReceiver::class);
    }
    
}
