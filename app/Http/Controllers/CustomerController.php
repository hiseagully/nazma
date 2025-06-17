<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductTransaction;

class CustomerController extends Controller
{
    public function index()
    {
        // Ambil data unik customer dari tabel transaksi produk
        $customers = ProductTransaction::select('name', 'email', 'phone')
            ->groupBy('name', 'email', 'phone')
            ->get();

        return view('admin.product.customerdata', [
            'customers' => $customers,
            'activeMenu' => 'product',
            'activeSubMenu' => 'customer',
        ]);
    }
}
