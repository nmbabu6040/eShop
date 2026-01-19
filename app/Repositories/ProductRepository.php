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
            'sku_code' => $request->productSku,
            'price' => $request->salePrice,
            'by_price' => $request->byingPrice,
            'discount' => 0,
            'media_id' => $thumbnail->id,
        ]);

        $productDetails = ProductDetails::create([
            'product_id' => $product->id,
            'category_id' => $request->category,
            'sub_category_id' => $request->subCategory,
            'brand_id' => $request->brand,
            'short_description' => $request->shortDescription,
            'description' => $request->description,
            'additional_info' => $request->additionalInfo,
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
            $product->gelleries()->sync($mediaIds);
        }

        return $product;
    }

    public function discountPercentage($byPrice, $selPrice)
    {

        $discount = (($byPrice - $selPrice) / $byPrice) * 100;
        return $discount;
    }

    public static function updateByRequest($request, Product $product): Product
    {
        /* ---------- Thumbnail ---------- */
        $media = $product->media;

        if ($request->hasFile('thumbnail')) {
            if ($media) {
                $media = MediaRepository::updateByRequest(
                    $request->file('thumbnail'),
                    'product',
                    'image',
                    $media
                );
            } else {
                $media = MediaRepository::storeByRequest(
                    $request->file('thumbnail'),
                    'product',
                    'image'
                );
            }
        }

        /* ---------- Product ---------- */
        $product->update([
            'name'      => $request->name,
            'price'     => $request->salePrice,
            'by_price'  => $request->byingPrice,
            'media_id'  => $media?->id,
        ]);

        /* ---------- Product Details (NO NULL ERROR EVER) ---------- */
        $product->details()->updateOrCreate(
            ['product_id' => $product->id],
            [
                'category_id'        => $request->category,
                'sub_category_id'    => $request->subCategory,
                'brand_id'           => $request->brand,
                'short_description'  => $request->shortDescription,
                'description'        => $request->description,
                'additional_info'    => $request->additionalInfo,
            ]
        );

        /* ---------- Tags ---------- */
        $product->tags()->sync($request->tags ?? []);

        /* ---------- Galleries ---------- */
        if ($request->hasFile('images')) {
            $mediaIds = [];

            foreach ($request->file('images') as $image) {
                $media = MediaRepository::storeByRequest($image, 'product', 'image');
                $mediaIds[] = $media->id;
            }

            $product->gelleries()->syncWithoutDetaching($mediaIds);
        }

        return $product;
    }


    public static function productGalleryStoreOrUpdate(Request $request, int $id): Product
    {
        $product = Product::findOrFail($id);

        if (!$request->hasFile('images')) {
            return $product;
        }

        $mediaIds = [];

        foreach ($request->file('images') as $image) {
            $media = MediaRepository::storeByRequest($image, 'product', 'image');
            $mediaIds[] = $media->id;
        }

        // পুরোনো gallery থাকবে, নতুন add হবে
        $product->gelleries()->syncWithoutDetaching($mediaIds);

        return $product;
    }
}
