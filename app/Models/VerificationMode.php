<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationMode extends Model
{
    use HasFactory;
    protected $table = 'verification_modes';

    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    public function services()
    {
        return $this->hasMany(Service::class, 'verification_mode_id', 'id');
    }
}