<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'slug',
        'name',
        'image',
        'description',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function(SubCategory $model) {
            $slug = Str::slug($model->name);
            $originalSlug = $slug;
            $count = 1;
            while (SubCategory::where('slug', $slug)->whereNull('deleted_at')->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
            $model->slug = $slug;
        });
       
    }

    protected $dates = ['deleted_at'];
    
    public function category()
    {
    return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function services()
    {
        return $this->hasMany(Service::class, 'sub_category_id', 'id');
    }

}

