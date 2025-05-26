<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductImages;

class ProductImagesController extends Controller
{
    public function index()
    {
        $images = ProductImages::with('product')->get();
        $products = \App\Models\ProductCollection::all();
        return view('admin.product.productimages', compact('images', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'productid' => 'required|exists:productcollection,productid',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_thumbnail' => 'nullable|boolean',
        ]);
        $path = $request->file('image_path')->store('productimages', 'public');
        // Jika is_thumbnail true, reset thumbnail lain di produk ini
        if ($request->is_thumbnail) {
            ProductImages::where('productid', $request->productid)->update(['is_thumbnail' => false]);
        }
        ProductImages::create([
            'productid' => $request->productid,
            'image_path' => $path,
            'is_thumbnail' => $request->is_thumbnail ? true : false,
        ]);
        return redirect()->back()->with('success', 'Image uploaded!');
    }

    public function destroy($id)
    {
        $image = ProductImages::findOrFail($id);
        if ($image->image_path) {
            \Storage::disk('public')->delete($image->image_path);
        }
        $image->delete();
        return redirect()->back()->with('success', 'Image deleted!');
    }

    public function setThumbnail($id)
    {
        $image = ProductImages::findOrFail($id);
        ProductImages::where('productid', $image->productid)->update(['is_thumbnail' => false]);
        $image->is_thumbnail = true;
        $image->save();
        return redirect()->back()->with('success', 'Thumbnail updated!');
    }
}
