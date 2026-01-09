<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Media;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Tag;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest('id')->get();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::latest('id')->get();
        $subCategories = SubCategory::latest('id')->get();
        $brands = Brand::latest('id')->get();
        $tags = Tag::latest('id')->get();
        return view('admin.product.create', compact('categories', 'subCategories', 'brands', 'tags'));
    }

    public function store(ProductRequest $request)
    {
        ProductRepository::storeByRequest($request);

        return to_route('product.index')->withSuccess('Product created successfully');
    }

    public function show(Product $product)
    {

        $productGalleries = $product->galleries->map(function ($media) {
            return [
                'media_id' => $media->id,
                'src' => $media->gallery_url,
            ];
        });

        return view('admin.product.show', compact('product', 'productGalleries'));
    }

    public function edit(Product $product)
    {
        $productTagIds = $product->tags->pluck('id')->toArray();
        $categories = Category::latest('id')->get();
        $subCategories = SubCategory::latest('id')->get();
        $brands = Brand::latest('id')->get();
        $tags = Tag::latest('id')->get();
        return view('admin.product.edit', compact('product', 'categories', 'subCategories', 'brands', 'tags', 'productTagIds'));
    }

    public function deleteImage(Media $media)
    {
        if (Storage::exists($media->src)) {
            Storage::delete($media->src);
        }
        $media->delete();

        return response()->json([
            'status' => true,
            'message' => 'Image deleted successfully'
        ], 200);
    }

    public function update(ProductRequest $request, Product $product)
    {

        ProductRepository::updateByRequest($request, $product);

        return to_route('product.index')->withSuccess('Product updated successfully!');
    }
}
