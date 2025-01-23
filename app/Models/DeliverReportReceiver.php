<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliverReportReceiver extends Model
{   
    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'deliver_report_id',
        'recipent_name',
        'recipent_email',
        'is_delivered',
        'created_at',
        'updated_at',
    ];

    public function deliverReport(){
        return $this->belongsTo(DeliverReport::class, 'deliver_report_id', 'id');
    }

}
