<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvidenceType extends Model
{
    use HasFactory;

    protected $primaryKey = 'EvidenceTypeID'; // Primary key

    protected $fillable = [
        'name',
        'description',
        'status',
    ];
}
