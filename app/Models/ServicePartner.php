<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePartner extends Model
{
    use HasFactory;

    protected $table = 'service_partner'; 

    protected $fillable = [
        'name',
        'description',
        'country_id',
        'contact_address',
        'email_address',
        'website_address',
        'contact_person',
        'status',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
