<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Repositories\BrandRepository;
use App\Repositories\MediaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest('id')->get();
        return view('admin.brand.index', compact(('brands')));
    }

    public function store(BrandRequest $request)
    {
        $media = null;
        if ($request->hasFile('image')) {
            $media = MediaRepository::storeByRequest($request->file('image'), 'brand', 'image');
        }
        $brand = BrandRepository::storeByRequest($request, $media);

        return to_route('brand.index')->withSuccess('Brand Created Successfully');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', compact('brand'));
    }

    public function update(BrandRequest $request, Brand $brand)
    {
        $media = $brand->media;
        if ($request->hasFile('image')) {
            if ($media && Storage::exists($media->src)) {
                $media = MediaRepository::updateByRequest($request->file('image'), 'brand', 'image', $media);
            } else {
                $media = MediaRepository::storeByRequest($request->file('image'), 'brand', 'image');
            }
        }

        $brand = BrandRepository::updateByRequest($request, $brand, $media);

        return to_route('brand.index')->withSuccess('Brand Updated Successfully');
    }

    public function destroy(Brand $brand)
    {
        MediaRepository::deleteByRequest($brand->media);

        $brand->delete();

        return to_route('brand.index')->withSuccess('Brand Deleted successfully');
    }
}
