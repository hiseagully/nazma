<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\TrainingTransaction;

class MidtransController extends Controller
{
    public function pay(Request $request)
    {
        // Konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Data transaksi
        $orderId = 'ORDER-' . time();
        $grossAmount = $request->input('amount'); // harga dari training

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $grossAmount,
            ],
            'customer_details' => [
                'first_name' => $request->input('name'),
                'email' => $request->input('email'),
            ],
        ];

        // Buat Snap Token
        $snapToken = Snap::getSnapToken($params);

        return view('midtrans.checkout', compact('snapToken', 'orderId', 'grossAmount'));
    }

    public function callback(Request $request)
    {
        // Validasi IPN Callback atau gunakan Midtrans Notification
        // Simpan status transaksi ke database jika perlu
        return response()->json(['message' => 'Callback diterima.']);
    }
}

