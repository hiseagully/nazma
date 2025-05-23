<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TrainingTransaction;
use Illuminate\Support\Facades\Auth;


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
    }
    
    public function userTicket()
    {
        $transactions = \App\Models\TrainingTransaction::with('training')
            ->where('user_id', optional(Auth::user())->id)
            ->orderByDesc('trainingtransactiondate')
            ->get();

        return view('user.training.trainingticket', compact('transactions'));
    }
    
    public function adminIndex()
    {
        $tickets = \App\Models\TrainingTransaction::with(['user', 'training'])
            ->orderByDesc('trainingtransactiondate')
            ->get();

        return view('admin.training.trainingticketdata', compact('tickets'));
    }
}