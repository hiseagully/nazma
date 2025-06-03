<?php

namespace App\Http\Controllers;

use App\Models\TrainingTransaction;
use App\Models\TrainingProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Midtrans\Snap;
use Midtrans\Config;

class TrainingTransactionController extends Controller
{
    /* =========================================================
       KONFIGURASI MIDTRANS – panggil sekali di constructor
       ========================================================= */
    public function __construct()
    {
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = config('midtrans.is_sanitized');
        Config::$is3ds        = config('midtrans.is_3ds');
    }

    /* =========================================================
       LIST ADMIN / USER
       ========================================================= */

    // Admin lihat trainee yg sudah sukses
    public function traineeIndex()
    {
        $transactions = TrainingTransaction::where('trainingtransactionstatus', 'Success')->get();
        return view('admin.training.traineedata', compact('transactions'));
    }

    // Admin lihat SEMUA transaksi
    public function adminIndex()
    {
        $transactions = TrainingTransaction::with(['user', 'training.region'])
            ->orderByDesc('trainingtransactiondate')
            ->get();

        return view('admin.training.trainingtransactiondata', compact('transactions'));
    }

    // User (login) lihat transaksi dirinya
    public function userIndex()
    {
        $transactions = $this->withSnapToken(
            TrainingTransaction::where('user_id', auth()->id())->get()
        );

        return view('user.training.trainingtransaction', compact('transactions'));
    }

    // Endpoint umum kalau dipakai di luar konteks login tertentu
    public function index()
    {
        $transactions = $this->withSnapToken(
            TrainingTransaction::with(['user', 'training.region'])
                ->orderByDesc('trainingtransactiondate')
                ->get()
        );

        return view('user.training.trainingtransaction', compact('transactions'));
    }

    /* =========================================================
       STORE – membuat transaksi + (jika midtrans) token Snap
       ========================================================= */
    public function store(Request $request, $trainingid)
    {
        $training = TrainingProgram::findOrFail($trainingid);

        // Ambil email user yang login
        $userEmail = auth()->user()->user_email;

        // Simpan transaksi, pakai email dari user login
        $transaction = TrainingTransaction::create([
            'trainingid'                   => $trainingid,
            'transactiontraineename'       => $request->transactiontraineename,
            'transactiontraineeemail'      => auth()->user()->user_email,
            'transactiontraineeage'        => $request->transactiontraineeage,
            'transactiontraineegender'     => $request->transactiontraineegender,
            'transactiontraineeaddress'    => $request->transactiontraineeaddress,
            'payment_method'               => $request->payment_method,
            'trainingtransactionmethod'    => $request->payment_method,
            'trainingtransactionstatus'    => 'Pending',
            'trainingtransactiondate'      => now(),
            'trainingtransactiontotal'     => $training->trainingpricerupiah,
            'user_id'                      => auth()->user()->user_id,
        ]);

        if ($request->payment_method === 'midtrans') {
            $orderId = 'TRX-' . $transaction->trainingtransactionid . '-' . Str::uuid();

            $snapToken = $this->generateSnapToken($transaction, $training, $orderId);

            $transaction->update([
                'midtrans_order_id' => $orderId,
                'snap_token'        => $snapToken,
            ]);

            return response()->json(['snap_token' => $snapToken]);
        }

        return redirect()->route('trainingtransaction.index');
    }

    /* =========================================================
       CALLBACK / REDIRECT SUKSES MIDTRANS
       ========================================================= */
    public function paymentSuccess()
    {
        return redirect()->route('trainingtransaction.index')->with('success', 'Payment success!');
    }

    /* =========================================================
       HELPER PRIVATE
       ========================================================= */

    /** Tambahkan Snap-token ke setiap transaksi yang masih Pending dan belum punya token */
    private function withSnapToken($transactions)
    {
        foreach ($transactions as $tx) {
            if (
                strtolower($tx->trainingtransactionstatus) === 'pending' &&
                empty($tx->snap_token)
            ) {
                $training = $tx->training;    // relasi TrainingProgram
                $orderId  = 'TRX-' . $tx->trainingtransactionid . '-' . Str::uuid();
                $tx->snap_token = $this->generateSnapToken($tx, $training, $orderId);
                $tx->midtrans_order_id = $orderId;
                $tx->save();
            }
        }
        return $transactions;
    }

    /** Generate Snap-token */
    private function generateSnapToken(TrainingTransaction $tx, TrainingProgram $training, string $orderId): string
    {
        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $training->trainingpricerupiah,
            ],
            'customer_details'   => [
                'first_name' => $tx->transactiontraineename,
                'email'      => $tx->transactiontraineeemail,
            ],
            'item_details'       => [[
                'id'       => $training->trainingid,
                'price'    => $training->trainingpricerupiah,
                'quantity' => 1,
                'name'     => $training->trainingtitle,
            ]],
        ];

        return Snap::getSnapToken($params);
    }
}
