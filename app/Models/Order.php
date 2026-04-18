<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function productItems()
    {
        return $this->hasMany(Product::class, 'product_id');
    }

    public function shipping()
    {
        return $this->hasOne(ShippingAddress::class);
    }

    public function billing()
    {
        return $this->hasOne(BillingAddress::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
