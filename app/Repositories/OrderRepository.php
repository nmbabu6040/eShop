<?php

namespace App\Repositories;

use App\Enums\OrderStatusEnums;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\User;
use Arafat\LaravelRepository\Repository;
use Illuminate\Http\Request;

class OrderRepository extends Repository
{
    /**
     * base method
     *
     * @method model()
     */
    public static function model()
    {
        return Order::class;
    }

    public static function storeByRequest(Request $request): Order
    {
        $user = auth('web')->user();
        $cartItems = $user->cartItems;
        $orderCode = '#' . str_pad(random_int(1000000000, 9999999999), 10, '0', STR_PAD_LEFT);
        $couponId = $request->couponId;
        $coupon = $couponId ? Coupon::find($couponId) : null;
        $totalPrice = $cartItems->map(function ($item) {
            return $item->product->discount_price > 0 ? $item->product->discount_price * $item->quantity : $item->product->price * $item->quantity;
        })->sum();

        if ($coupon && $coupon->coupon_type == 'percentage') {
            $totalPrice = $totalPrice - ($totalPrice * $coupon->discount / 100);
        } else if ($coupon && $coupon->coupon_type == 'fixed') {
            $totalPrice = $totalPrice - $coupon->discount;
        }

        $order = self::create([
            'user_id' => $user->id,
            'order_code' => $orderCode,
            'charge' => $request->charge,
            'total_price' => $totalPrice,
            'coupon_id' => $couponId ?? null,
            'has_coupon' => $couponId ? true : false,
            'status' => OrderStatusEnums::PENDING->value,
            'payment_method' => $request->payment,
            'hasPayment' => false,
            'message' => $request->massage,

        ]);

        $orderProducts = OrderProductRepository::storeByRequest($request, $order);

        return $order;
    }
}
