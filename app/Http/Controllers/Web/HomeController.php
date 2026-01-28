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
        return view('web.index', compact('categories', 'recentlyAdd'));
    }

    public function about()
    {
        return view('web.about');
    }

    public function shop()
    {
        $allProducts = Product::get();
        $newProducts = $allProducts->sortByDesc('created_at')->take(3);
        $products = Product::latest()->paginate(20)->withQueryString();
        $categories = Category::latest('id')->get();
        $colors = Color::latest('id')->get();
        $sizes = Size::latest('id')->get();
        $tags = Tag::latest('id')->get();
        return view('web.shop', compact('newProducts', 'products', 'categories', 'colors', 'sizes', 'tags'));
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

    public function singleProduct()
    {
        return view('web.product-single');
    }
}
