<?php
// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class VerificationProvider extends Model
// {
//     use HasFactory;

//     protected $primaryKey = 'ProviderID';

//     protected $fillable = [
//         'name',
//         'description',
//         'CountryID',
//         'ProviderTypeID',
//         'contact_address',
//         'email_address',
//         'website_address',
//         'contact_person',
//         'status',
//     ];

//     public function country()
//     {
//         return $this->belongsTo(Country::class, 'CountryID');
//     }

//     public function providerType()
//     {
//         return $this->belongsTo(ProviderType::class, 'ProviderTypeID');
//     }
// }

