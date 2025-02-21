<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class VerificationProvider extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = "id";
    
    protected $table = "verification_providers";

    protected $fillable = [
        'slug',
        'name',
        'description',
        'country_id',
        'provider_type_id',
        'contact_address',
        'email',
        'website',
        'contact_person',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function(VerificationProvider $model) {
            $slug = Str::slug($model->name);
            $originalSlug = $slug;
            $count = 1;
            while (VerificationProvider::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
            $model->slug = $slug;
        });
       
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function providerType()
    {
        return $this->belongsTo(ProviderType::class, 'provider_type_id', 'id');
    }
    public function services()
    {
        return $this->hasMany(Service::class, 'verification_provider_id', 'id');
    }

}


