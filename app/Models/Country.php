<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'flag',
        'description',
        'currency_name',
        'currency_symbol',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function(Country $model) {
            $slug = Str::slug($model->name);
            $originalSlug = $slug;
            $count = 1;
            while (Country::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
            $model->slug = $slug;
        });
       
    }

    public function verificationProviders()
    {
        return $this->hasMany(VerificationProvider::class, 'country_id', 'id');
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'country_id', 'id');
    }   

    public function servicePartners()
    {
        return $this->hasMany(ServicePartner::class, 'country_id', 'id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'country_id', 'id');
    }
}