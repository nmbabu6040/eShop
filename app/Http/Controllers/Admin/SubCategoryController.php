<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Repositories\CategoryRepository;
use App\Repositories\MediaRepository;
use App\Repositories\SubCategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest('id')->get();
        $subCategories = SubCategory::latest('id')->get();
        return view('admin.subCategory.index', compact('categories', 'subCategories'));
    }

    public function store(SubCategoryRequest $request)
    {

        $media = null;
        if ($request->hasFile('image')) {
            $media = MediaRepository::storeByRequest($request->file('image'), 'subCategory', 'image');
        }
        $category = SubCategoryRepository::storeByRequest($request, $media);

        return to_route('subCategory.index')->withSuccess('Sub category created successfully');
    }

    public function edit(SubCategory $subCategory)
    {
        $categories = Category::latest('id')->get();
        return view('admin.subCategory.edit', compact('subCategory', 'categories'));
    }

    public function update(SubCategoryRequest $request, SubCategory $subCategory)
    {
        $media = $subCategory->media;
        if ($request->hasFile('image')) {
            if ($media && Storage::exists($media->src)) {
                $media = MediaRepository::updateByRequest($request->file('image'), 'subCategory', 'image', $media);
            } else {
                $media = MediaRepository::storeByRequest($request->file('image'), 'subCategory', 'image');
            }
        }

        $subCategory = SubCategoryRepository::updateByRequest($request, $subCategory, $media);

        return to_route('subCategory.index')->withSuccess('Sub-category updated successfully');
    }
}
