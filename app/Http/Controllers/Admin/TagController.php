<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::latest('id')->get();
        return view('admin.tags.index', compact('tags'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
        ]);

        Tag::create([

            'name' => $request->name,
        ]);

        return to_route('tags.index')->withSuccess('Tag created successfully');
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $tag->update([
            'name' => $request->name,
        ]);

        return to_route('tags.index')->withSuccess('Tag updated successfully');
    }

    public function destroy(Tag $tag)
    {

        $tag->delete();
        return to_route('tags.index')->withSuccess('Tag deleted successfully');
    }
}
