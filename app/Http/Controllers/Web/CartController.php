<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
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
        $cartItems = Cart::where('user_id', $user->id)->where('product_id', $request->product_id)->first();

        $cartItems->update([
            'quantity' => $request->quantity,
        ]);

        return response()->json(['message' => 'Cart updated successfully']);
    }

    public function deleteCart(Cart $cart)
    {
        $cart->delete();
        return back()->withSuccess('Product removed from cart successfully');
    }
}
