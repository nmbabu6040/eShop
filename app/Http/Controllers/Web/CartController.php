<?php

namespace App\Http\Controllers\Web;

use App\Enums\Enums\CouponTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartDetails()
    {
        $user = auth('web')->user();
        $cartItems = $user->cartItems()->latest()->get();
        // $subTotalPrice = $cartItems->map(function ($item) {
        //     return $item->product->discount_price > 0 ? $item->product->discount_price : $item->product->price * $item->quantity;
        // })->sum();

        $subTotalPrice = $cartItems->map(function ($item) {
            $price = $item->product->discount_price > 0
                ? $item->product->discount_price
                : $item->product->price;

            return $price * $item->quantity;
        })->sum();

        return view('web.cartDetails', compact('user', 'cartItems', 'subTotalPrice'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'color' => 'required|exists:colors,id',
            'size' => 'required|exists:sizes,id',
            'quantity' => 'required|numeric|min:1',
        ]);

        $user = auth('web')->user();

        Cart::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
            'color_id' => $request->color,
            'size_id' => $request->size,
            'quantity' => $request->quantity,
        ]);

        return back()->withSuccess('Product added to cart successfully');
    }

    public function updateCart(Request $request)
    {

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
        ]);

        $user = auth('web')->user();

        $cartItem = Cart::where('user_id', $user->id)->where('product_id', $request->product_id)->first();

        $cartItem->update([
            'quantity' => $request->quantity
        ]);

        return response()->json([
            'message' => 'Cart updated successfully',
        ]);
    }

    public function deleteCart(Cart $cart)
    {
        $cart->delete();
        return back()->withSuccess('Product removed from cart successfully');
    }

    public function cartCouponApply(Request $request)
    {
        $request->validate([
            'subTotalPrice' => 'required',
            'couponCode' => 'required|exists:coupons,coupon_code',
        ]);

        $discountPrice = 0;
        $couponCode = $request->couponCode;

        $coupon = Coupon::where('coupon_code', $couponCode)->first();

        $isValid = $coupon->start_date <= now() && $coupon->expiry_date >= now();
        if (!$isValid) {
            return response()->json([
                'message' => 'Coupon Code is not valid'
            ], 400);
        }

        $hasLimit = $coupon->limit > 0;
        if (!$hasLimit) {
            return response()->json([
                'message' => 'Coupon Limit is over'
            ], 400);
        }

        $minAmount = $coupon->min_amount;
        if ($minAmount > $request->subTotalPrice) {
            return response()->json([
                'message' => 'Coupon is not valid for this amount'
            ], 400);
        }

        $couponDiscount = 0;
        if ($coupon->coupon_type == CouponTypeEnum::PERCENTAGE->value) {
            $couponDiscount = $request->subTotalPrice * $coupon->discount / 100;
        } else {
            $couponDiscount = $coupon->discount;
        }

        $discountPrice = $request->subTotalPrice - $couponDiscount;

        return response()->json([
            'message' => 'Coupon Applied Successfully',
            'id' => $coupon->id,
            'discountPrice' => $discountPrice,
        ], 200);
    }
}
