<?php

namespace App\Repositories;

use App\Models\BillingAddress;
use App\Models\Order;
use Arafat\LaravelRepository\Repository;
use Illuminate\Http\Request;

class BillingAddressRepository extends Repository
{
    /**
     * base method
     *
     * @method model()
     */
    public static function model()
    {
        return BillingAddress::class;
    }

    public static function storeByRequest(Request $request, Order $order): void
    {
        self::create([
            'user_id' => auth('web')->user()->id,
            'order_id' => $order->id,
            'order_code' => $order->order_code,
            'name' => $request->shippingName,
            'email' => $request->shippingEmail,
            'phone' => $request->shippingPhone,
            'country' => $request->shippingCountry,
            'city' => $request->shippingCity,
            'address' => $request->shippingAddress,
            'post' => $request->shippingPost,
            'company' => $request->shippingCompany
        ]);
    }
}
