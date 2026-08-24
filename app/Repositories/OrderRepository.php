<?php

namespace App\Repositories;

use App\Enums\OrderStatusEnums;
use App\Models\Coupon;
use App\Models\Order;
use Arafat\LaravelRepository\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderRepository extends Repository
{
    /**
     * Base model
     *
     * @method model()
     */
    public static function model()
    {
        return Order::class;
    }

    /**
     * Store order from checkout request.
     */
    public static function storeByRequest(Request $request): Order
    {
        return DB::transaction(function () use ($request) {

            $user = auth('web')->user();

            $cartItems = $user->cartItems;

            $orderCode = '#' . random_int(1000000000, 9999999999);

            $couponId = $request->couponId;

            $coupon = $couponId
                ? Coupon::find($couponId)
                : null;

            /*
            |--------------------------------------------------------------------------
            | Calculate Cart Total
            |--------------------------------------------------------------------------
            */

            $totalPrice = $cartItems->sum(function ($item) {

                $price = $item->product->discount_price > 0
                    ? $item->product->discount_price
                    : $item->product->price;

                return $price * $item->quantity;
            });

            /*
            |--------------------------------------------------------------------------
            | Apply Coupon Discount
            |--------------------------------------------------------------------------
            */

            if ($coupon) {

                if ($coupon->coupon_type === 'percentage') {

                    $totalPrice -=
                        ($totalPrice * $coupon->discount) / 100;
                } elseif ($coupon->coupon_type === 'fixed') {

                    $totalPrice -= $coupon->discount;
                }

                // Prevent negative order total.
                $totalPrice = max(0, $totalPrice);
            }

            /*
            |--------------------------------------------------------------------------
            | Create Order
            |--------------------------------------------------------------------------
            */

            $order = self::create([
                'user_id' => $user->id,
                'order_code' => $orderCode,
                'charge' => $request->charge,
                'total_price' => $totalPrice,
                'coupon_id' => $couponId ?: null,
                'has_coupon' => (bool) $couponId,
                'status' => OrderStatusEnums::PENDING->value,
                'payment_method' => $request->payment,
                'hasPayment' => false,
                'message' => $request->massage,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Store Order Products
            |--------------------------------------------------------------------------
            */

            OrderProductRepository::storeByRequest(
                $request,
                $order
            );

            /*
            |--------------------------------------------------------------------------
            | Store Billing Address
            |--------------------------------------------------------------------------
            */

            BillingAddressRepository::storeByRequest(
                $request,
                $order
            );

            /*
            |--------------------------------------------------------------------------
            | Store Shipping Address
            |--------------------------------------------------------------------------
            */

            if ($request->boolean('shipping')) {

                ShippingAddressRepository::storeByRequest(
                    $request,
                    $order
                );
            }

            return $order;
        });
    }
}
