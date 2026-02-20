<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\WishList;
use App\Models\Product;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    public function index()
    {
        $user = auth('web')?->user();
        $wishList = WishList::where('user_id', $user?->id)->get();
        return view('web.wishlist', compact('wishList', 'user'));
    }

    public function store($slug)
    {

        $productId = Product::where('slug', $slug)->first()?->id;

        $userId = auth('web')->user()?->id;

        $exists = WishList::where('user_id', $userId)->where('product_id', $productId)->exists();

        if ($exists) {
            return back()->withError('Product already added to wishlist');
        }

        WishList::create([
            'user_id' => $userId,
            'product_id' => $productId,
        ]);

        return back()->withSuccess('Product added to wishlist successfully');
    }

    public function destroy($slug)
    {
        $productId = Product::where('slug', $slug)->first()?->id;
        $userId = auth('web')->user()?->id;
        $wishList = WishList::where('user_id', $userId)->where('product_id', $productId)->first();
        if (!$wishList) {
            return back()->withError('Product not found in wishlist');
        }
        if ($wishList) {
            $wishList->delete();
        }
        return back()->withSuccess('Product removed from wishlist successfully');
    }
}
