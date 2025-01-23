<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerformEvaluation extends Model
{
    protected static function boot () 
    {
        parent::boot();
    }


    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'holder_submission_id',
        'nigeria',
        'degree',
        'comparability',
        'undergraduate_admission',
        'admission_notes_1',
        'admission_notes_2',
        'summary_notes_1',
        'summary_notes_2',
        'summary_notes_3',
        'is_stage5_completed',
        'created_at',
        'updated_at',
    ];

    public function holderSubmission(){
        return $this->belongsTo(HolderSubmission::class, 'holder_submission_id', 'id');
    }
}
