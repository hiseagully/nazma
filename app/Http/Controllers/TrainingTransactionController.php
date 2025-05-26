<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TrainingTransaction;

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
}
