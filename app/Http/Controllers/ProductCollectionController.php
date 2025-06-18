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

        // Tambahkan user_id ke data yang akan disimpan
        $data = $request->all();
        $data['user_id'] = auth()->user()->user_id; // atau auth()->id() jika sudah di-custom

        ProductCollection::create($data);
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

    // Untuk Buy Now (single product, tetap bawa admin)
    public function show($id, Request $request)
    {
        $product = ProductCollection::with('user')->findOrFail($id);
        $admin = $product->user;
        $user = auth()->user();
        $qty = (int) $request->input('qty', 1); // ambil qty dari request, default 1
        return view('user.product.productdata', compact('product', 'admin', 'user', 'qty'));
    }

    public function destroy($id)
    {
        $product = ProductCollection::findOrFail($id);
        $product->delete();
        return redirect()->route('productcollection.index')->with('success', 'Product deleted!');
    }

    // Untuk Cart Checkout (multi product, tanpa data admin)
    public function productdata(Request $request)
    {
        $productIds = $request->input('productids', []);
        if (!is_array($productIds)) {
            $productIds = [$productIds];
        }
        $products = ProductCollection::with('user')->whereIn('productid', $productIds)->get();
        $user = auth()->user();
        // Ambil qty dari cart items (relasi pivot atau model CartItems)
        $cart = $user->cart;
        $qtyMap = [];
        if ($cart && $cart->items) {
            foreach ($cart->items as $item) {
                if (in_array($item->productid, $productIds)) {
                    $qtyMap[$item->productid] = $item->quantity;
                }
            }
        }
        // Ambil admin dari produk pertama yang punya user
        $admin = null;
        foreach ($products as $product) {
            if ($product->user) {
                $admin = $product->user;
                break;
            }
        }
        return view('user.product.productdata', compact('products', 'user', 'qtyMap', 'admin'));
    }
}