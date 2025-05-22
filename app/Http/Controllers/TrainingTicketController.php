<?php

namespace App\Http\Controllers;

use App\Models\TrainingTicket;

class TrainingTicketController extends Controller
{
    public function adminIndex()
    {
        $tickets = TrainingTicket::with(['user', 'training'])->orderByDesc('created_at')->get();
        return view('admin.training.trainingticketdata', compact('tickets'));
    }
}
