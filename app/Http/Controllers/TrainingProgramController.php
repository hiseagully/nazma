<?php

namespace App\Http\Controllers;

use App\Models\TrainingProgram;
use App\Models\TrainingRegion;
use Illuminate\Http\Request;

class TrainingProgramController extends Controller
{
    // Tampilkan semua data trainingprogram
    public function index()
    {
        $programs = TrainingProgram::with('region')->get();
        return view('trainingprogram.index', compact('programs'));
    }

    // Tampilkan form tambah data
    public function create()
    {
        $regions = TrainingRegion::all();
        return view('trainingprogram.create', compact('regions'));
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'trainingregionid' => 'required|exists:trainingregions,trainingid',
            'trainingtitle' => 'required|max:50',
            'trainingdescription' => 'required',
            'trainingpricerupiah' => 'required|numeric',
            'trainingpricedollar' => 'required|numeric',
            'trainingimage' => 'required|string',
            'trainingschedule' => 'required|date',
            'traininglocation' => 'required|max:255',
            'trainingslot' => 'required|integer',
        ]);

        TrainingProgram::create($request->all());

        return redirect()->route('trainingprogram.index')->with('success', 'Data berhasil ditambahkan!');
    }

    // Hapus data
    public function destroy($id)
    {
        TrainingProgram::findOrFail($id)->delete();
        return redirect()->route('trainingprogram.index')->with('success', 'Data berhasil dihapus!');
    }
}