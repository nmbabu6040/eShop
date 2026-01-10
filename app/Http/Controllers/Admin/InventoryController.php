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
        $inventories = ProductInventory::where('product_id', $product->id)->latest('id')->get();
        return view('admin.product.inventory', compact('product', 'colors', 'sizes', 'inventories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'color' => 'required',
            'size' => 'required',
            'quantity' => 'required',
        ]);

        $oldInventory = ProductInventory::where('product_id', $request->product_id)->where('color_id', $request->color)->where('size_id', $request->size)->first();

        if ($oldInventory) {
            $oldInventory->update([
                'quantity' => $oldInventory->quantity + $request->quantity
            ]);
            return back()->withSuccess('Inventory updated successfully');
        }

        ProductInventory::create([
            'product_id' => $request->product_id,
            'color_id' => $request->color,
            'size_id' => $request->size,
            'quantity' => $request->quantity
        ]);

        return back()->withSuccess('Inventory added successfully');
    }

    public function update(Request $request, ProductInventory $inventory)
    {
        $request->validate([
            'product_id' => 'required',
            'editColor' => 'required',
            'editSize' => 'required',
            'editQuantity' => 'required',
        ]);

        $inventory->update([
            'size_id' => $request->editSize,
            'color_id' => $request->editColor,
            'quantity' => $request->editQuantity,
        ]);

        return back()->withSuccess('Inventory updated successfully');
    }
}
