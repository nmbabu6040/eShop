<?php

namespace App\Repositories;

use App\Models\SubCategory;
use Arafat\LaravelRepository\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubCategoryRepository extends Repository
{
    /**
     * base method
     *
     * @method model()
     */
    public static function model()
    {
        return SubCategory::class;
    }

    public static function storeByRequest(Request $request, $media): SubCategory
    {
        return self::create([
            'name' =>  $request->name,
            'slug' => $request->slug,
            'category_id' => $request->category,
            'media_id' => $media?->id ?? null,
        ]);
    }

    public static function updateByRequest(Request $request, $subCategory, $media): SubCategory
    {
        $subCategory->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'category_id' => $request->category,
            'media_id' => $media?->id ?? null,
        ]);

        return $subCategory;
    }
}
