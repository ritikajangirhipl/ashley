<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VerificationMode extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'verification_modes';

    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    protected $dates = ['deleted_at'];
    
    public function services()
    {
        return $this->hasMany(Service::class, 'verification_mode_id', 'id');
    }
}