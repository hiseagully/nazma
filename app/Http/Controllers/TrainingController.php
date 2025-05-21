<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');
        // Contoh: ambil data training dari database (ganti sesuai model kamu)
        // $trainings = Training::where('title', 'like', "%$query%")->get();

        // Untuk contoh tanpa database:
        $trainings = []; // Ganti dengan query ke database jika sudah ada

        return view('user.training.training', compact('trainings', 'query'));
    }
}
