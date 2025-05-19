<?php

namespace App\Http\Controllers;

use App\Models\TrainingRegion;
use Illuminate\Http\Request;

class TrainingRegionController extends Controller
{
    // Tampilkan semua data trainingregions
    public function index()
    {
        $regions = TrainingRegion::all();
        return view('trainingregions.index', compact('regions'));
    }

    // Tampilkan form tambah data
    public function create()
    {
        return view('trainingregions.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'trainingregionname' => 'required|max:50',
        ]);

        TrainingRegion::create([
            'trainingregionname' => $request->trainingregionname,
        ]);

        return redirect()->route('trainingregions.index')->with('success', 'Data berhasil ditambahkan!');
    }

    // Hapus data
    public function destroy($id)
    {
        TrainingRegion::findOrFail($id)->delete();
        return redirect()->route('trainingregions.index')->with('success', 'Data berhasil dihapus!');
    }
}