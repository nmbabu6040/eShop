<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    protected $guarded = ['id'];


    protected function galleryUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => ($this->src && Storage::exists($this->src))
                ? Storage::url($this->src)
                : asset('admin/assets/images/upload.png'),
        );
    }
}
