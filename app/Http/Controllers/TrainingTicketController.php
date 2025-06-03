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

    session(["ticket_status_{$id}" => $status]);

    return redirect()->back()->with('success', 'Status updated successfully (session only).');
}
}