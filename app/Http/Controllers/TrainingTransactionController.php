<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TrainingTransaction;
use App\Models\TrainingProgram;
use Illuminate\Http\Request;

class TrainingTransactionController extends Controller
{
    // Untuk halaman training transaction
    public function index()
    {
        $transactions = TrainingTransaction::with([
            'user',
            'training.region'
        ])->orderByDesc('trainingtransactiondate')->get();

        return view('admin.training.trainingtransaction', compact('transactions'));
    }

    // Untuk halaman trainee data, ambil transaksi dengan status Success
    public function traineeIndex()
    {
        $transactions = TrainingTransaction::where('trainingtransactionstatus', 'Success')->get();

        return view('admin.training.traineedata', compact('transactions'));
    }

    // Jika perlu adminIndex untuk data lain
    public function adminIndex()
    {
        $transactions = TrainingTransaction::with([
            'user',
            'training.region'
        ])->orderByDesc('trainingtransactiondate')->get();

        return view('admin.training.trainingtransactiondata', compact('transactions'));
    }

    public function store(Request $request, $trainingid)
    {
        $data = $request->validate([
            'transactiontraineeemail'   => 'required|email',
            'transactiontraineename'    => 'required|string|max:255',
            'transactiontraineeage'     => 'required|integer|min:1',
            'transactiontraineegender'  => 'required|in:m,f',
            'transactiontraineeaddress' => 'required|string',
            'payment_method'            => 'required|in:bank,ewallet',
        ]);

        $data['trainingid'] = $trainingid;

        TrainingTransaction::create($data);

        return redirect()->back()->with('success', 'Registration & payment submitted!');
    }
}
