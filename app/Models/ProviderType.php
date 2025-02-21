<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProviderType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    protected $dates = ['deleted_at'];
    
    public function verificationProviders()
    {
        return $this->hasMany(VerificationProvider::class, 'provider_type_id', 'id');
    }
    
}