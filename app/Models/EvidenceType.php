<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvidenceType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'status',
    ];
    protected $dates = ['deleted_at'];

    public function services()
    {
        return $this->hasMany(Service::class, 'evidence_type_id', 'id');
    }

}
