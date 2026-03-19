<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $user = auth('web')->user();
        $couponId = $request->couponId;
        $coupon = null;
        if ($couponId) {
            $coupon = Coupon::find($couponId);
        }
        $cartItems = $user?->cartItems;
        $subTotal = $cartItems->map(function ($item) {
            return $item->product->discount_price > 0 ? $item->product->discount_price * $item->quantity : $item->product->price * $item->quantity;
        })->sum();
        return view('web.checkout', compact('user', 'cartItems', 'subTotal', 'coupon'));
    }
}
