<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainingTransaction;

class TraineeController extends Controller
{
    public function index()
    {
        $transactions = TrainingTransaction::all();
		return view('admin.training.traineedata', compact('transactions'));
    }
}

