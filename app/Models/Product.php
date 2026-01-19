<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $guarded = ['id'];

    /* ================= Relations ================= */

    public function details()
    {
        return $this->hasOne(ProductDetails::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function gelleries()
    {
        return $this->belongsToMany(Media::class, 'product_gelleries', 'product_id', 'media_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id');
    }

    /* ================= Accessors ================= */

    public function thumbnail(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->media && Storage::exists($this->media->src)) {
                    return Storage::url($this->media->src);
                }
                return asset('default.jpg');
            }
        );
    }

    /* ================= Boot ================= */

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $baseSlug = Str::slug($product->name);
            $slug = $baseSlug;
            $count = 1;

            while (self::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $count++;
            }

            $product->slug = $slug;
        });
    }
}
