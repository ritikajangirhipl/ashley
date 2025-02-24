<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'services';  

    protected $fillable = [
        'country_id',
        'category_id',
        'sub_category_id',
        'name',
        'description',
        'subject',
        'verification_mode_id',
        'verification_summary',
        'verification_provider_id',
        'verification_duration',
        'duration_type',
        'evidence_type_id',
        'evidence_summary',
        'service_partner_id',
        'service_currency',
        'local_service_price',
        'usd_service_price',
        'subject_name',
        'copy_of_document_to_verify',
        'reason_for_request',
        'subject_consent_requirement',
        'name_of_reference_provider',
        'address_information',
        'location',
        'gender',
        'marital_status',
        'registration_number',
        'status',
    ];

    protected $dates = ['deleted_at'];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }

    public function verificationMode()
    {
        return $this->belongsTo(VerificationMode::class, 'verification_mode_id', 'id');
    }

    public function evidenceType()
    {
        return $this->belongsTo(EvidenceType::class, 'evidence_type_id', 'id');
    }

    public function verificationProvider()
    {
        return $this->belongsTo(VerificationProvider::class, 'verification_provider_id', 'id');
    }
    
    public function servicePartner()
    {
        return $this->belongsTo(ServicePartner::class, 'service_partner_id', 'id');
    }

    public function additionalFields()
    {
        return $this->hasMany(ServiceAdditionalField::class);
    }

    
}
