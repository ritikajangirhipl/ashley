<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'slug',
        'name',
        'image',
        'description',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function(Category $model) {
            $slug = Str::slug($model->name);
            $originalSlug = $slug;
            $count = 1;
            while (Category::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
            $model->slug = $slug;
        });
    }

    protected $dates = ['deleted_at'];
    
    public function subCategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id', 'id');
    }
    public function services()
    {
        return $this->hasMany(Service::class, 'category_id', 'id');
    }
}

