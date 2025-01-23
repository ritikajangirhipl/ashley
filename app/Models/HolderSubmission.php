<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class HolderSubmission extends Model
{
    use SoftDeletes;

    protected static function boot () 
    {
        parent::boot();
        static::creating(function(HolderSubmission $model) {
            $submissionRef          = $model->generateUniqueSubmissionRef();
            $model->submission_ref  = $submissionRef;
            $model->pre_stage       = 'stage_0';
            $model->current_stage   = 'stage_1';
            $model->next_stage      = 'stage_2';
        });        
    }


    protected $table = "holder_submissions";

    protected $dates = [
        'submission_date',
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'submission_date',
        'submission_ref',
        'student_id',
        'issuer_id',
        'issuer_degree_id',
        'school_name',
        'start_year',
        'end_year',
        'receiver_id',
        'receiver_degree_id',
        'receiver_reference',
        'fees_to_pay',
        'status',

        'is_all_document_submitted',

        'is_all_stage_completed',
        'pre_stage',
        'current_stage',
        'next_stage',
        'is_stage0_completed',
        'is_stage1_completed',
        'is_stage2_completed',
        'is_stage3_completed',
        'is_stage4_completed',
        'is_stage5_completed',
        'is_stage6_completed',
        'is_stage7_completed',
        'is_stage8_completed',

        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function setSubmissionDateAttribute($value)
    {
        $this->attributes['submission_date'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }

    public function getSubmissionDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }


    public function generateUniqueSubmissionRef()
    {
        do {
            $submissionRef = random_int(1, 999999);
        } while (HolderSubmission::where("submission_ref", "=", $submissionRef)->first());
  
        return $submissionRef;
    }

    public function checkUpdateAllDocUploadedStatus()
    {
        $files = array_keys(config('constant.holder_submission_documents'));
        $allDocumentUploaded    = false;
        if(request()->files && !empty(request()->files) && !$this->is_all_document_submitted){
            foreach ($files as $key => $file) {
                $allDocumentUploaded = $this->uploads()->where('document_file_type',$file)->exists();
                if(!$allDocumentUploaded){
                    break;
                }
            }
        }
        if($allDocumentUploaded){
            $this->update(['is_all_document_submitted' => 1]);
        }
        return $allDocumentUploaded;
    }

    public function uploads()
    {
        return $this->morphMany(Uploads::class, 'uploadsable');
    }

    public function students(){
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function issuer(){
        return $this->belongsTo(Issuer::class, 'issuer_id', 'id');
    }

    public function issuerDegree(){
        return $this->belongsTo(Degree::class, 'issuer_degree_id', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo(Receiver::class, 'receiver_id', 'id');
    }

    public function receiverDegree(){
        return $this->belongsTo(Degree::class, 'receiver_degree_id', 'id');
    }

    public function stage1(){
        return $this->hasOne(VerifyPayment::class);
    }

    public function stage2(){
        return $this->hasOne(RequestVerification::class, 'holder_submission_id', 'id');
    }

    public function stage3(){
        return $this->hasOne(ExtractTranscript::class, 'holder_submission_id', 'id');
    }

    public function stage4(){
        return $this->hasOne(UpdateVerification::class, 'holder_submission_id', 'id');
    }

    public function stage5(){
        return $this->hasOne(PerformEvaluation::class, 'holder_submission_id', 'id');
    }

    public function stage6(){
        return $this->hasOne(PrepareReport::class, 'holder_submission_id', 'id');
    }

    public function stage7(){
        return $this->hasOne(ValidateReport::class, 'holder_submission_id', 'id');
    }

    public function stage8(){
        return $this->hasOne(DeliverReport::class, 'holder_submission_id', 'id');
    }
}
