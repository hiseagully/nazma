<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainingTransaction;

class TrainingTicketController extends Controller
{
    public function index()
{
    $transactions = TrainingTransaction::with(['user', 'training'])->get();

    foreach ($transactions as $trx) {
        // Status default: Payment Success
        $trx->status_display = session("ticket_status_{$trx->id}", 'Payment Success');
    }

    return view('admin.training.trainingticketdata', compact('transactions'));
}

public function updateStatus(Request $request)
{
    $id = $request->transaction_id;
    $status = $request->status;

    $transaction = \App\Models\TrainingTransaction::findOrFail($id);
    $transaction->status = $status;
    $transaction->save();

    return redirect()->route('admin.trainingticket.index')->with('success', 'Status updated successfully!');
}
};