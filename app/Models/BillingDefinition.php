<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingDefinition extends Model
{
    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'billable_id',
        'degree_id',
        'receiver_fees',
        'evaluation_fees',
        'translation_fees',
        'verification_fees',
        'other_fees',
        'total_fees',
        'status',
        'created_at',
        'updated_at',
    ];

    public function billable()
    {
        return $this->morphTo();
    }

    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }

}