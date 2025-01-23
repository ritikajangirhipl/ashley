<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    protected $table = "curriculums";

    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'curriculumable_id',
        'type',
        'issuer_id',
        'receiver_id',
        'degree_id',
        'name',
        'status',
        'created_at',
        'updated_at',
    ];

    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }

    public function curriculumable()
    {
        return $this->morphTo();
    }

    public function curriculumDetail()
    {
        return $this->hasMany(CurriculumDetail::class, 'curriculum_id', 'id');
    }
}