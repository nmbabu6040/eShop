<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::latest('id')->get();
        return view('admin.color.index', compact('colors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'color_code' => 'required',
        ]);

        $color = Color::create([
            'name' => $request->name,
            'color_code' => $request->color_code,
        ]);

        return to_route('color.index')->withsuccess('Color Created Successfully');
    }

    public function update(Request $request, Color $color)
    {

        $request->validate([
            'name' => 'required',
            'color_code' => 'required',
        ]);

        $color->update([
            'name' => $request->name,
            'color_code' => $request->color_code,
        ]);

        return to_route('color.index')->withSuccess('Color Updated Successfully');
    }

    public function destroy(Color $color)
    {
        $color->delete();

        return to_route('color.index')->withSuccess('Color Deleted Successfully');
    }
}
