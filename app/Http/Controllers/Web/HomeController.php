<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use App\Models\Tag;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::latest('id')->get();
        $products = Product::get();
        $recentlyAdd = $products->sortByDesc('id')->take(3);
        $user = auth('web')?->user();
        return view('web.index', compact('categories', 'recentlyAdd', 'user'));
    }

    public function about()
    {
        return view('web.about');
    }

    public function shop()
    {

        $newProducts = Product::latest()->take(8)->get();
        $products = Product::latest()->paginate(20)->withQueryString();
        $totalProducts = Product::count();
        $categories = Category::latest('id')->get();
        $colors = Color::latest('id')->get();
        $sizes = Size::latest('id')->take(10)->get();
        $tags = Tag::latest('id')->get();
        return view('web.shop', compact('newProducts', 'products', 'categories', 'colors', 'sizes', 'tags', 'totalProducts'));
    }

    public function faq()
    {
        return view('web.faq');
    }

    public function contact()
    {
        return view('web.contact');
    }

    public function recentlyView()
    {
        return view('web.recently-view');
    }

    public function compare()
    {
        return view('web.compare');
    }

    public function product()
    {
        return view('web.product');
    }

    public function singleProduct($slug)
    {
        $user = auth('web')?->user();
        $product = Product::where('slug', $slug)->first();
        $colorIds = $product->inventories->pluck('color_id')->toArray();
        $productColors = Color::whereIn('id', $colorIds)->get();
        $sizeIds = $product->inventories->pluck('size_id')->toArray();
        $productSizes = Size::whereIn('id', $sizeIds)->get();
        return view('web.product-single', compact('product', 'productColors', 'productSizes', 'user'));
    }
}
