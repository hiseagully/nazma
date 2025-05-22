<?php

namespace App\Http\Controllers;

use App\Models\ProductCatalog;
use Illuminate\Http\Request;

class ProductCatalogController extends Controller
{
    public function index()
    {
        $productcatalogs = ProductCatalog::all();
        return view('admin.product.productcatalog', compact('productcatalogs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'productcatalogname' => 'required|string|max:255',
            'productcatalogimage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imagePath = null;
        if ($request->hasFile('productcatalogimage')) {
            $imagePath = $request->file('productcatalogimage')->store('productcatalog', 'public');
        }
        ProductCatalog::create([
            'productcatalogname' => $request->productcatalogname,
            'productcatalogimage' => $imagePath,
        ]);
        return redirect()->back()->with('success', 'Catalog added!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'productcatalogname' => 'required|string|max:255',
            'productcatalogimage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $catalog = ProductCatalog::findOrFail($id);
        $imagePath = $catalog->productcatalogimage;
        if ($request->hasFile('productcatalogimage')) {
            $imagePath = $request->file('productcatalogimage')->store('productcatalog', 'public');
        }
        $catalog->update([
            'productcatalogname' => $request->productcatalogname,
            'productcatalogimage' => $imagePath,
        ]);
        return redirect()->back()->with('success', 'Catalog updated!');
    }

    public function destroy($id)
    {
        ProductCatalog::destroy($id);
        return redirect()->back()->with('success', 'Catalog deleted!');
    }
}
