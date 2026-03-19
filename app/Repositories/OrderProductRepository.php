<?php

namespace App\Repositories;

use App\Models\Order;
use Arafat\LaravelRepository\Repository;
use Illuminate\Http\Request;
use App\Models\OrderProduct;

class OrderProductRepository extends Repository
{
    /**
     * base method
     *
     * @method model()
     */
    public static function model()
    {
        return OrderProduct::class;
    }

    public static function storeByRequest(Request $request, Order $order)
    {
        $user = auth('web')->user();
        $cartItems = $user->cartItems;

        foreach ($cartItems ?? [] as $item) {

            self::create([
                'order_id' => $order->id,
                'order_code' => $order->order_code,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'size_id' => $item->size_id,
                'color_id' => $item->color_id,
            ]);
        }
    }
}
