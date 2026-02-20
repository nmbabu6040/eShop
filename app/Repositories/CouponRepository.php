<?php

namespace App\Repositories;

use App\Models\Coupon;
use Arafat\LaravelRepository\Repository;
use Illuminate\Http\Request;

class CouponRepository extends Repository
{
    /**
     * base method
     *
     * @method model()
     */
    public static function model()
    {
        return Coupon::class;
    }

    public static function storeByRequest(Request $request): Coupon
    {
        $coupon =  self::create([
            'coupon_code' => $request->couponCode,
            'coupon_type' => $request->type,
            'min_amount' => $request->minimum_amount,
            'discount' => $request->discount,
            'limit' => $request->limit,
            'start_date' => $request->startDate,
            'expiry_date' => $request->expiryDate,
            'status' => true,
        ]);

        return $coupon;
    }

    public static function updateByRequest(Request $request, Coupon $coupon): Coupon
    {
        $coupon->update([
            'coupon_type' => $request->type,
            'min_amount' => $request->minimum_amount,
            'discount' => $request->discount,
            'limit' => $request->limit,
            'start_date' => $request->startDate,
            'expiry_date' => $request->expiryDate,
            'status' => true,
        ]);

        return $coupon;
    }
}
