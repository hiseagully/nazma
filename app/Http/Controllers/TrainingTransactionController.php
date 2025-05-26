<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TrainingTransaction;

class TrainingTransactionController extends Controller
{
    public function index()
    {
        // Ambil data transaksi beserta relasi user, training, dan region
        $transactions = TrainingTransaction::with([
            'user',
            'training.region'
        ])->orderByDesc('trainingtransactiondate')->get();

        return view('admin.training.trainingtransaction', compact('transactions'));

        // Ambil hanya transaksi dengan status Success
        $transactions = TrainingTransaction::where('trainingtransactionstatus', 'Success')->get();

        return view('admin.trainee.index', compact('transactions'));
    }
    public function adminIndex()
    {
        // Ambil data transaksi beserta relasi user, training, dan region
        $transactions = \App\Models\TrainingTransaction::with([
            'user',
            'training.region'
        ])->orderByDesc('trainingtransactiondate')->get();

        return view('admin.training.trainingtransactiondata', compact('transactions'));
    }
}