<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'client_type',
        'email_address',
        'phone_number',
        'website_address',
        'contact_address',
        'contact_person',
        'country_id',
        'password',
        'status',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
