<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ValidateReport extends Model
{

    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'holder_submission_id',
        'is_report_validate',
        'is_stage7_completed',
        'created_at',
        'updated_at',
    ];

    public function holderSubmission(){
        return $this->belongsTo(HolderSubmission::class, 'holder_submission_id', 'id');
    }
}
