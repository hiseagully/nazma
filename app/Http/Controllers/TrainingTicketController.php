<?php

namespace App\Http\Controllers;

use App\Models\TrainingTransaction;

class TrainingTicketController extends Controller
{
    public function adminIndex()
    {
        $tickets = TrainingTransaction::with(['user', 'training'])->orderByDesc('trainingtransactiondate')->get();
        return view('admin.training.trainingticketdata', compact('tickets'));
    }
}
