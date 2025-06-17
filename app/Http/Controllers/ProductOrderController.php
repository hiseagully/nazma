<?php

namespace App\Http\Controllers;

use App\Models\ProductTransactionItem;

class ProductOrderController extends Controller
{
    public function index()
    {
        $orders = ProductTransactionItem::with(['transaction', 'product'])->get();
        return view('admin.product.productoder', [
            'orders' => $orders,
            'activeMenu' => 'product',
            'activeSubMenu' => 'productorder',
        ]);
    }
}
