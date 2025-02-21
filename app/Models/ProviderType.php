<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    public function verificationProviders()
    {
        return $this->hasMany(VerificationProvider::class, 'provider_type_id', 'id');
    }
    
}