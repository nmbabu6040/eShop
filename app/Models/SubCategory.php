<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SubCategory extends Model
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($subCategory) {
            if (empty($subCategory->slug)) {
                $baseslug = Str::slug($subCategory->name);
                $slug = $baseslug;
                $count = 1;
                while (SubCategory::where('slug', $slug)->exists()) {
                    $slug = $baseslug . '-' . $count++;
                }
                $subCategory->slug = $slug;
            } else {
                $subCategory->slug = Str::slug($subCategory->name);
            }
        });
    }
}
