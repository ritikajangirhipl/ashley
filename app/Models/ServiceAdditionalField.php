<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceAdditionalField extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'service_id',
        'field_name',
        'field_type',
        'combo_values',
        'field_required',
    ];

    protected $dates = ['deleted_at'];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }


    
}
