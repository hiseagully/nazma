<?php

namespace App\Http\Controllers;

use App\Models\ProductCollection;
use Illuminate\Http\Request;

class ProductCollectionController extends Controller
{
    public function index()
    {
        $products = ProductCollection::with(['catalog', 'region'])->get();
        return view('admin.product.productcollection', [
            'products' => $products,
            'activeMenu' => 'product', 
            'activeSubMenu' => 'productcollection',
        ]);
    }

    public function create()
    {
        return view('admin.product.productcollection_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'productcatalogid' => 'required|exists:productcatalog,productcatalogid',
            'productregionsid' => 'required|exists:productregionsmap,productregionsid',
            'productname' => 'required|string|max:255',
            'productdescription' => 'nullable|string',
            'productpricerupiah' => 'nullable|numeric',
            'productpricedollar' => 'nullable|numeric',
            'productweight' => 'nullable|numeric',
            'productstock' => 'nullable|integer',
        ]);

        ProductCollection::create($request->all());
        return redirect()->route('productcollection.index')->with('success', 'Product added!');
    }

    public function edit($id)
    {
        $product = ProductCollection::findOrFail($id);
        return view('admin.product.productcollection_edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = ProductCollection::findOrFail($id);

        $request->validate([
            'productcatalogid' => 'required|exists:productcatalog,productcatalogid',
            'productregionsid' => 'required|exists:productregionsmap,productregionsid',
            'productname' => 'required|string|max:255',
            'productdescription' => 'nullable|string',
            'productpricerupiah' => 'nullable|numeric',
            'productpricedollar' => 'nullable|numeric',
            'productweight' => 'nullable|numeric',
            'productstock' => 'nullable|integer',
        ]);

        $product->update($request->all());
        return redirect()->route('productcollection.index')->with('success', 'Product updated!');
    }

    public function destroy($id)
    {
        $product = ProductCollection::findOrFail($id);
        $product->delete();
        return redirect()->route('productcollection.index')->with('success', 'Product deleted!');
    }
}