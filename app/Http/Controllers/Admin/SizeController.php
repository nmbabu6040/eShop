<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::latest('id')->get();
        return view('admin.size.index', compact('sizes'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
        ]);

        Size::create([

            'name' => $request->name,
        ]);

        return to_route('size.index')->withSuccess('Size created successfully');
    }

    public function update(Request $request, Size $size)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $size->update([
            'name' => $request->name,
        ]);

        return to_route('size.index')->withSuccess('Size updated successfully');
    }

    public function destroy(Size $size)
    {

        $size->delete();
        return to_route('size.index')->withSuccess('Size deleted successfully');
    }
}
