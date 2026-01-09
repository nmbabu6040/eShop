<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductDetails;
use Arafat\LaravelRepository\Repository;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $thumbnail = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnail = MediaRepository::storeByRequest($request->file('thumbnail'), 'product', 'image');
        }

        $product = self::create([
            'name' => $request->name,
            'sku_code' => $request->product_sku,
            'price' => $request->selling_price,
            'by_price' => $request->buying_price,
            'discount' => 0,
            'media_id' => $thumbnail->id,
        ]);

        $productDetails = ProductDetails::create([
            'product_id' => $product->id,
            'category_id' => $request->category,
            'sub_category_id' => $request->sub_category,
            'brand_id' => $request->brand,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'additional_info' => $request->additional_information,
        ]);

        $tags = $request->tags;
        $product->tags()->sync($tags);

        $images = $request->file('images');
        $mediaIds = [];
        if ($images) {
            foreach ($images as $image) {
                $media = MediaRepository::storeByRequest($image, 'product', 'image');
                $mediaIds[] = $media->id;
            }
        }

        if ($mediaIds > 0) {
            $product->galleries()->sync($mediaIds);
        }

        return $product;
    }

    public function discountPercentage($byPrice, $selPrice)
    {

        $discount = (($byPrice - $selPrice) / $byPrice) * 100;
        return $discount;
    }

    public static function updateByRequest($request, $product)
    {

        $media = $product->media;
        // if ($media && $request->hasFile('thumbnail')) {
        //     $media = MediaRepository::updateByRequest($request->file('thumbnail'), 'product', 'image', $media);
        // }else if(!$media && $request->hasFile('thumbnail')) {
        //     $media = MediaRepository::storeByRequest($request->file('thumbnail'), 'product', 'image');
        // }

        $product->update([
            'name' => $request->name,
            'price' => $request->selling_price,
            'by_price' => $request->buying_price,
            'media_id' => $media->id,
        ]);

        $product->details->update([
            'category_id' => $request->category,
            'sub_category_id' => $request->sub_category,
            'brand_id' => $request->brand,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'additional_info' => $request->additional_information,
        ]);

        $newTags = $request->tags;
        $product->tags()->sync($newTags);

        // $images = $request->file('images');
        // $mediaIds = [];
        // if ($images) {
        //     foreach ($images as $image) {
        //        $media = MediaRepository::storeByRequest($image, 'product', 'image');
        //        $mediaIds[] = $media->id;
        //     }
        // }

        // if (count($mediaIds) > 0) {
        //   $product->galleries()->sync($mediaIds);
        // }

        return $product;
    }

    public static function ProductGalleryStoreOrUpdate($request, $id)
    {
        $product = Product::find($id);
        $images = $request->file('images');
        $mediaIds = [];
        if ($images) {
            foreach ($images as $image) {
                $media = MediaRepository::storeByRequest($image, 'product', 'image');
                $mediaIds[] = $media->id;
            }
        }

        if (count($mediaIds) > 0) {
            $product->galleries()->sync($mediaIds);
        }

        return $product;
    }
}
