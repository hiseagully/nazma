<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TrainingProgram;
use App\Models\TrainingRegion;
use Illuminate\Http\Request;

class TrainingProgramController extends Controller
{
    // Tampilkan semua data trainingprogram
    public function index()
    {
        $trainings = TrainingProgram::orderBy('trainingid', 'desc')->get();
        return view('admin.training.trainingdata', compact('trainings'));
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
        $data = $request->validate([
            'trainingtitle' => 'required|max:50',
            'trainingdescription' => 'required',
            'trainingpricerupiah' => 'required|numeric',
            'trainingpricedollar' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'trainingschedule' => 'required|date',
            'traininglocation' => 'required|max:255',
            'trainingslot' => 'required|integer',
            'trainingregionid' => 'required|exists:trainingregions,trainingid',
        ]);
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $path = $file->store('training_images', 'public');
            $data['trainingimage'] = '/storage/' . $path;
        }
        TrainingProgram::create($data);
        return redirect()->route('trainingprogram.index')->with('success', 'Data berhasil ditambahkan!');
    }

    // Hapus data
    public function destroy($id)
    {
        TrainingProgram::findOrFail($id)->delete();
        return redirect()->route('trainingprogram.index')->with('success', 'Data berhasil dihapus!');
    }
    
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'trainingtitle' => 'required|max:50',
            'trainingdescription' => 'required',
            'trainingpricerupiah' => 'required|numeric',
            'trainingpricedollar' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'trainingschedule' => 'required|date',
            'traininglocation' => 'required|max:255',
            'trainingslot' => 'required|integer',
        ]);

        $training = TrainingProgram::findOrFail($id);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $path = $file->store('training_images', 'public');
            $data['trainingimage'] = '/storage/' . $path;
        }

        $training->update($data);

        return redirect()->route('trainingprogram.index')->with('success', 'Data berhasil diupdate!');
    }
}