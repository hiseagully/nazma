<?php

namespace App\Http\Controllers;

use App\Models\TrainingTransaction;
use App\Models\TrainingProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;

class TrainingTransactionController extends Controller
{
    public function __construct()
    {
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = config('midtrans.is_sanitized');
        Config::$is3ds        = config('midtrans.is_3ds');
    }

    /* =========================================================
       INDEX
    ========================================================= */

    // Admin lihat trainee yang berhasil daftar
    public function traineeIndex()
    {
        $transactions = TrainingTransaction::where('trainingtransactionstatus', 'Success')->get();
        return view('admin.training.traineedata', compact('transactions'));
    }

    // Admin lihat semua transaksi
    public function adminIndex()
    {
        $transactions = TrainingTransaction::with(['user', 'training.region'])
            ->orderByDesc('trainingtransactiondate')
            ->get();

        return view('admin.training.trainingtransactiondata', compact('transactions'));
    }

    // User lihat transaksinya sendiri
    public function userIndex()
    {
        $transactions = TrainingTransaction::where('user_id', Auth::user()->user_id)
            ->orderByDesc('trainingtransactiondate')
            ->get();

        return view('user.training.trainingtransaction', compact('transactions'));
    }

    /* =========================================================
       STORE TRANSAKSI
    ========================================================= */

    public function store(Request $request, $trainingid)
    {
        // Validasi data dari form
        $validated = $request->validate([
            'transactiontraineeemail' => 'required|email',
            'transactiontraineename' => 'required|string',
            'transactiontraineeage' => 'required|integer',
            'transactiontraineegender' => 'required|in:m,f',
            'transactiontraineeaddress' => 'required|string',
            // etc
        ]);

        // Ambil data training dari DB
        $training = TrainingProgram::findOrFail($trainingid);

        $orderId = 'ORDER-' . time();
        $grossAmount = $training->trainingpricerupiah; // harga training dari DB

        // Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (float)$grossAmount,
            ],
            'customer_details' => [
                'first_name' => $validated['transactiontraineename'],
                'email' => $validated['transactiontraineeemail'],
            ],
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
        } catch (\Exception $e) {
            return back()->withErrors('Midtrans error: ' . $e->getMessage());
        }

        // Simpan transaksi di DB (opsional)
        $transaction = TrainingTransaction::create([
            'trainingtransactionmethod' => 'midtrans',
            'trainingtransactionstatus' => 'pending',
            'trainingtransactiondate' => now(),
            'trainingtransactiontotal' => $grossAmount,
            'transactiontraineegender' => $validated['transactiontraineegender'],
            'transactiontraineename' => $validated['transactiontraineename'],
            'transactiontraineeage' => $validated['transactiontraineeage'],
            'transactiontraineeaddress' => $validated['transactiontraineeaddress'],
            'user_id' => auth()->id(),
            'trainingid' => $trainingid,
            // Tambahkan order_id jika kamu punya kolom untuk itu
        ]);

        // Kirim token dan data ke view pembayaran
        return view('user.training.trainingpayment', compact('snapToken', 'orderId', 'grossAmount'));
    }

    /* =========================================================
       HALAMAN BAYAR
    ========================================================= */

    public function pay($id)
    {
        $transaction = TrainingTransaction::findOrFail($id);

        // Buat parameter payment ke Midtrans (sesuaikan dengan kebutuhan)
        $params = [
            'transaction_details' => [
                'order_id' => $transaction->id, // kalau kamu nggak mau pakai order_id bisa pakai id atau custom
                'gross_amount' => $transaction->total_amount,
            ],
            'customer_details' => [
                'first_name' => $transaction->user->name,
                'email' => $transaction->user->email,
                // tambahkan data lain jika perlu
            ],
        ];

        // Generate Snap token
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // Kirim snap token ke view
        return view('trainingpayment', compact('transaction', 'snapToken'));
    }

    /* =========================================================
       GET SNAP TOKEN
    ========================================================= */

    public function getSnapToken($id)
    {
        $transaction = TrainingTransaction::find($id);

        $params = [
            'transaction_details' => [
            'order_id' => 'TRX-' . $transaction->trainingtransactionid,
            'gross_amount' => (float) $transaction->trainingtransactiontotal,
        ],
        'customer_details' => [
            'first_name' => $transaction->transactiontraineename,
            'email' => $transaction->user->user_email, 
        ],
            'enabled_payments' => ['credit_card', 'gopay', 'bank_transfer'],
            'vtweb' => [],
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /* =========================================================
       CALLBACK / PAYMENT SUCCESS REDIRECT
    ========================================================= */

    public function paymentSuccess()
    {
        return redirect()->route('trainingtransaction.index')->with('success', 'Payment success!');
    }

    /* =========================================================
       MIDTRANS WEBHOOK
    ========================================================= */

    public function handleNotification(Request $request)
    {
        $notif = new Notification();

        $tx = TrainingTransaction::where('trainingtransactionid', $notif->order_id)->first();

        if (!$tx) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        switch ($notif->transaction_status) {
            case 'settlement':
            case 'capture':
                $tx->trainingtransactionstatus = 'Success';
                break;
            case 'expire':
            case 'cancel':
                $tx->trainingtransactionstatus = 'Cancel';
                break;
            case 'pending':
            default:
                $tx->trainingtransactionstatus = 'Pending';
        }

        $tx->save();
        return response()->json(['message' => 'OK']);
    }
}