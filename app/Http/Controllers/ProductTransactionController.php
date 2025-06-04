<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductTransaction;
use Midtrans\Config;
use Midtrans\Snap;

class ProductTransactionController extends Controller
{
    // Simpan transaksi baru
    public function store(Request $request)
    {
        // Inisialisasi Midtrans config untuk product
        \Midtrans\Config::$serverKey = config('midtrans.product.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.product.is_production');
        \Midtrans\Config::$isSanitized = config('midtrans.product.is_sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.product.is_3ds');

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

        // Simpan transaksi
        $data['products'] = json_encode($data['products']);
        $transaction = ProductTransaction::create($data);

        // Siapkan item_details untuk Midtrans
        $item_details = [];
        foreach ($request->products as $item) {
            $item_details[] = [
                'id' => $item['id'],
                'price' => $item['price'],
                'quantity' => $item['qty'],
                'name' => $item['name'],
            ];
        }
        // Tambahkan ongkir sebagai item jika ada
        if (!empty($data['shipping_cost']) && !empty($data['shipping_courier'])) {
            $item_details[] = [
                'id' => 'ongkir',
                'price' => (int) $data['shipping_cost'],
                'quantity' => 1,
                'name' => 'Ongkir ' . $data['shipping_courier'],
            ];
        }

        // Buat Snap Token
        $params = [
            'transaction_details' => [
                'order_id' => 'TRX-PROD-' . $transaction->id,
                'gross_amount' => (int) $data['total_price'],
            ],
            'customer_details' => [
                'first_name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
            ],
            'item_details' => $item_details,
        ];
        $snapToken = Snap::getSnapToken($params);

        return response()->json([
            'success' => true,
            'transaction' => $transaction,
            'snap_token' => $snapToken
        ]);
    }

    // Tampilkan detail transaksi
    public function show($id)
    {
        $transaction = ProductTransaction::findOrFail($id);
        return view('user.product.transaction_detail', compact('transaction'));
    }
}