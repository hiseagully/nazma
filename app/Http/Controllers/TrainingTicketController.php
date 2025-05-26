<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainingTransaction;

class TrainingTicketController extends Controller
{
    public function index()
    {
        // Ambil semua data training transaction dengan relasi yang diperlukan
        $transactions = TrainingTransaction::with(['user', 'training.region'])->get();

        return view('admin.training.trainingticketdata', compact('transactions'));
    }
    public function updateStatus(Request $request, $id)
    {
        $transaction = TrainingTransaction::findOrFail($id);
        $transaction->trainingtransactionstatus = $request->status;
        $transaction->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }
}
