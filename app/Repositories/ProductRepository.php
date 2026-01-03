<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\Tag;
use Arafat\LaravelRepository\Repository;
use Illuminate\Http\Request;

class ProductRepository extends Repository
{
    /**
     * base method
     *
     * @method model()
     */
    public static function model()
    {
        return Product::class;
    }

    public static function storeByRequest(Request $request): Product
    {
        $thambnail = null;
        if ($request->hasFile('thumbnail')) {
            $thambnail = (new MediaRepository())->storeByRequest($request->file('thumbnail'), 'product');
        }


        $product = self::create([

            'name' => $request->name,
            'sku_code' => $request->product_sku,
            'by_price' => $request->by_price,
            'price' => $request->sale_price,
            'discount' => 0,
            'media_id' => $thambnail->id,
        ]);

        $productDetails = ProductDetails::create([
            'product_id' => $product->id,
            'category_id' => $request->category,
            'sub_category_id' => $request->sub_category,
            'brand_id' => $request->brand,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'additional_info' => $request->additional_info,
        ]);

        $tags = $request->tags;
        $product->tags()->sync($tags);

        $images = $request->file('images');
        $mediaIds = [];
        if ($images) {
            foreach ($images as $image) {
                $media =  MediaRepository::storeByRequest($image, 'product', 'image');
                $mediaIds[] = $media->id;
            }
        }

        if ($mediaIds > 0) {
            $product->galleries()->sync($mediaIds);
        }

        return $product;
    }

    public function discountPercentage($by_price, $price)
    {
        $discount = (($by_price - $price) / $by_price) * 100;
        return $discount;
    }

    public static function updateByRequest($request, $product): Product
    {
        $media = $product->media;
        if ($media && $request->hasFile('thumbnail')) {
            $media = MediaRepository::updateByRequest($request->file('thumbnail'), 'product', 'image', $media);
        } elseif (!$media && $request->hasFile('thumbnail')) {
            $media = MediaRepository::storeByRequest($request->file('thumbnail'), 'product', 'image');
        }
        $product = $product->update([
            'name' => $request->name,
            'sku_code' => $request->product_sku,
            'by_price' => $request->by_price,
            'price' => $request->sale_price,
            'media_id' => $media->id,
        ]);

        $product->details->update([
            'category_id' => $request->category,
            'sub_category_id' => $request->sub_category,
            'brand_id' => $request->brand,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'additional_info' => $request->additional_info,
        ]);


        $tags = $request->tags;
        $product->tags()->detach();
        $product->tags()->sync($tags);

        $images = $request->file('images');
        $mediaIds = [];

        if ($images) {
            foreach ($images as $image) {
                $media =  MediaRepository::storeByRequest($image, 'product', 'image');
                $mediaIds[] = $media->id;
            }
        }

        if ($mediaIds > 0) {
            $product->galleries()->sync($mediaIds);
        }

        return $product;
    }
}
