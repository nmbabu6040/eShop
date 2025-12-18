<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $guarded = ['id'];

    public function details()
    {
        return $this->hasOne(ProductDetails::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'product_details', 'category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function galleries()
    {
        return $this->belongsToMany(Media::class, 'product_gelleries', 'product_id', 'media_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id');
    }

    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $baseslug = Str::slug($product->name);
                $slug = $baseslug;
                $count = 1;
                while (Product::where('slug', $slug)->exists()) {
                    $slug = $baseslug . '-' . $count++;
                }
                $product->slug = $slug;
            } else {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    public function discountPrice($byPrice, $sellPrice)
    {
        $discount = ($sellPrice * 100) / $byPrice;
        return $this->price - ($this->price * $this->discount / 100);
    }
}
