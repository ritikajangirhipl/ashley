<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uploads extends Model
{
    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'name',
        'uploadsable',
        'path',
        'document_name',
        'document_file_type',
        'type',
        'created_at',
        'updated_at',
    ];

    /**
     * Get all of the models that own uploads.
     */
    public function uploadsable()
    {
        return $this->morphTo();
    }
}
