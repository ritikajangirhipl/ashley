<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'image',
        'description',
        'status',
    ];
    public function category()
    {
    return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function services()
    {
        return $this->hasMany(Service::class, 'sub_category_id', 'id');
    }

}

