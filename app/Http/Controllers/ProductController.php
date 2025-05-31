<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCollection;
use App\Models\ProductImages;

class ProductController extends Controller
{
    public function index()
    {
        // Ambil semua produk beserta thumbnail (jika ada)
        $products = ProductCollection::with(['images' => function($q) {
            $q->where('is_thumbnail', true);
        }])->get();
        return view('user.product.product', compact('products'));
    }
}
