<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductTransaction;

class ProductTransactionController extends Controller
{
    // Simpan transaksi baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'nullable|exists:users,user_id',
            'email' => 'required|email',
            'name' => 'required|string',
            'phone' => 'required|string',
            'country' => 'required|string',
            'province_id' => 'nullable|string',
            'city_id' => 'nullable|string',
            'district_id' => 'nullable|string',
            'country_name' => 'nullable|string',
            'city_name' => 'nullable|string',
            'postal_code' => 'nullable|string',
            'address' => 'required|string',
            'shipping_courier' => 'nullable|string',
            'shipping_cost' => 'nullable|numeric',
            'payment_method' => 'nullable|string',
            'payment_gateway' => 'nullable|string',
            'payment_status' => 'nullable|string',
            'total_price' => 'required|numeric',
            'products' => 'required|array',
        ]);

        $data['products'] = json_encode($data['products']);

        $transaction = ProductTransaction::create($data);

        // (Opsional) Hapus cart/cartitems di sini jika checkout dari cart

        return response()->json([
            'success' => true,
            'transaction' => $transaction
        ]);
    }

    // Tampilkan detail transaksi
    public function show($id)
    {
        $transaction = ProductTransaction::findOrFail($id);
        return view('user.product.transaction_detail', compact('transaction'));
    }
}