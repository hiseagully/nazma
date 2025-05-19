<?php

namespace App\Http\Controllers;

use App\Models\TrainingTransaction;
use App\Models\User;
use App\Models\TrainingProgram;
use Illuminate\Http\Request;

class TrainingTransactionController extends Controller
{
    // Tampilkan semua transaksi
    public function index()
    {
        $transactions = TrainingTransaction::with(['user', 'trainingProgram'])->get();
        return view('trainingtransaction.index', compact('transactions'));
    }

    // Tampilkan form tambah transaksi
    public function create()
    {
        $users = User::all();
        $programs = TrainingProgram::all();
        return view('trainingtransaction.create', compact('users', 'programs'));
    }

    // Simpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'trainingtransactionmethod' => 'required|max:100',
            'trainingtransactionstatus' => 'required|max:100',
            'trainingtransactiondate' => 'required|date',
            'trainingtransactiontotal' => 'required|numeric',
            'transactiontraineegender' => 'required|in:f,m',
            'transactiontraineename' => 'required',
            'transactiontraineeage' => 'required|integer',
            'transactiontraineeaddress' => 'required',
            'user_id' => 'required|exists:users,user_id',
            'trainingid' => 'required|exists:trainingprogram,trainingid',
        ]);

        TrainingTransaction::create($request->all());

        return redirect()->route('trainingtransaction.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    // Hapus transaksi
    public function destroy($id)
    {
        TrainingTransaction::findOrFail($id)->delete();
        return redirect()->route('trainingtransaction.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}