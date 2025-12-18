<?php

namespace App\Repositories;

use App\Models\Category;
use Arafat\LaravelRepository\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryRepository extends Repository
{
    /**
     * base method
     *
     * @method model()
     */
    public static function model()
    {
        return Category::class;
    }

    public static function storeByRequest(Request $request): Category
    {
        $thumbnail = null;
        if ($request->hasFile('image')) {
            $thumbnail = (new MediaRepository())->storeByRequest($request->file('image'), 'category');
        }

        return self::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'media_id' => $thumbnail?->id ?? null,
        ]);
    }

    public static function updateByRequest($request, Category $category): Category
    {
        $media = $category->media;
        if ($request->hasFile('image')) {
            if ($category->media && Storage::exists($category?->media?->src)) {
                $media = MediaRepository::updateByRequest($request->file('image'), 'category', 'image', $category->media);
            } else {
                $media =  MediaRepository::storeByRequest($request->file('image'), 'category', 'image');
            }
        }

        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'media_id' => $media?->id ?? null,
        ]);

        return $category;
    }
}
