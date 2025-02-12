<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceAdditionalField extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'field_name',
        'field_type',
        'combo_values',
        'field_required',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }


    
}
