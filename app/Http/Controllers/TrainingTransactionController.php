<?php

namespace App\Http\Controllers;

use App\Models\TrainingTransaction;
use App\Models\TrainingProgram;
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;

class TrainingTransactionController extends Controller
{
    // Menampilkan semua transaksi sukses (khusus admin trainee)
    public function traineeIndex()
    {
        $transactions = TrainingTransaction::where('trainingtransactionstatus', 'Success')->get();
        return view('admin.training.traineedata', compact('transactions'));
    }

    // Menampilkan semua transaksi (khusus admin)
    public function adminIndex()
    {
        $transactions = TrainingTransaction::with(['user', 'training.region'])
            ->orderByDesc('trainingtransactiondate')
            ->get();

        return view('admin.training.trainingtransactiondata', compact('transactions'));
    }

    // Menyimpan transaksi baru
    public function store(Request $request, $trainingid)
    {
        $training = TrainingProgram::findOrFail($trainingid);

        $trainee = TrainingTransaction::create([
            'trainingid' => $trainingid,
            'transactiontraineeemail' => $request->transactiontraineeemail,
            'transactiontraineename' => $request->transactiontraineename,
            'transactiontraineeage' => $request->transactiontraineeage,
            'transactiontraineegender' => $request->transactiontraineegender,
            'transactiontraineeaddress' => $request->transactiontraineeaddress,
            'payment_method' => $request->payment_method,
            'trainingtransactionmethod' => $request->payment_method,
            'trainingtransactionstatus' => 'pending',
            'trainingtransactiondate' => now(),
            'trainingtransactiontotal' => $training->trainingpricerupiah,
            //'user_id' => auth()->id(),
        ]);

        if ($request->payment_method === 'midtrans') {
            Config::$serverKey = config('midtrans.training.server_key');
            Config::$isProduction = config('midtrans.training.is_production');
            Config::$isSanitized = config('midtrans.training.is_sanitized');
            Config::$is3ds = config('midtrans.training.is_3ds');

            $params = [
                'transaction_details' => [
                    'order_id' => 'TRX-' . $trainee->trainingtransactionid,
                    'gross_amount' => $training->trainingpricerupiah,
                ],
                'customer_details' => [
                    'first_name' => $request->transactiontraineename,
                    'email' => $request->transactiontraineeemail,
                ],
                'item_details' => [
                    [
                        'id' => $training->trainingid,
                        'price' => $training->trainingpricerupiah,
                        'quantity' => 1,
                        'name' => $training->trainingtitle,
                    ],
                ],
            ];

            $snapToken = Snap::getSnapToken($params);
            return response()->json(['snap_token' => $snapToken]);
        }

        return redirect()->route('trainingtransaction.index');
    }

    // Redirect sukses pembayaran
    public function paymentSuccess()
    {
        return redirect()->route('trainingtransaction.index');
    }

    // Menampilkan transaksi user yang login
    public function userIndex()
    {
        //$transactions = TrainingTransaction::where('user_id', auth()->id())->get();
        return view('user.training.trainingtransaction', compact('transactions'));
    }

    // Menampilkan semua transaksi (general)
    public function index()
    {
        $transactions = TrainingTransaction::with(['user', 'training.region'])
            ->orderByDesc('trainingtransactiondate')
            ->get();

        return view('user.training.trainingtransaction', compact('transactions'));
    }
}