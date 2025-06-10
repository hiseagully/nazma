<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\TrainingTransaction;

class MidtransController extends Controller
{
    public function pay(Request $request, $id)
    {
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Ambil data transaksi dari DB berdasarkan ID transaksi
        $transaction = TrainingTransaction::find($id);

        if (!$transaction) {
            return response()->json(['error' => 'Transaksi tidak ditemukan'], 404);
        }

        $orderId = 'ORDER-' . $transaction->trainingtransactionid;  // bisa juga pake id transaksi
        $grossAmount = $transaction->trainingtransactiontotal; // pakai total harga dari DB

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (float)$grossAmount,
            ],
            'customer_details' => [
                'first_name' => $request->input('name', 'Trainee'),
                'email' => $request->input('email', 'email@example.com'),
            ],
        ];

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

