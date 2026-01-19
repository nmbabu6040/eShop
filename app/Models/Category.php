<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $guarded = ['id'];

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function thumbnail(): Attribute
    {
        $src = asset('default.jpg');
        if ($this->media && Storage::exists($this->media->src)) {
            $src = Storage::url($this->media->src);
        }

        return Attribute::make(
            get: fn() => $src,
        );
    }

    public function subCategories()
    {
        // Ekhne SubCategory model-er sathe somporko hobe
        return $this->hasMany(SubCategory::class, 'category_id');
        // 'category_id' holo sub_categories table-er oi column jeti category table-er id dhore rakhe
    }




    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $baseslug = Str::slug($category->name);
                $slug = $baseslug;
                $count = 1;
                while (Category::where('slug', $slug)->exists()) {
                    $slug = $baseslug . '-' . $count++;
                }
                $category->slug = $slug;
            } else {
                $category->slug = Str::slug($category->name);
            }
        });
    }
}
