<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Size;
use App\Models\Product;
use App\Models\ProductInventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Product $product)
    {
        $colors = Color::latest('id')->get();
        $sizes = Size::latest('id')->get();
        $inventories = ProductInventory::with(['color', 'size'])->where('product_id', $product->id)->latest()->get();
        return view('admin.product.inventory', compact('product', 'colors', 'sizes', 'inventories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'color' => 'required',
            'size' => 'required',
            'quantity' => 'required',
        ]);

        ProductInventory::create([
            'product_id' => $request->product_id,
            'color_id' => $request->color,
            'size_id' => $request->size,
            'quantity' => $request->quantity
        ]);

        return back()->withSuccess('Inventory added successfully');
    }
}
