<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServicePartner extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'service_partners'; 

    protected $fillable = [
        'name',
        'description',
        'country_id',
        'contact_address',
        'email',
        'website_address',
        'contact_person',
        'status',
    ];

    protected $dates = ['deleted_at'];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
    public function services()
    {
        return $this->hasMany(Service::class, 'service_partner_id', 'id');
    }
}
