<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TrainingProgram;
use App\Models\TrainingRegion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrainingProgramController extends Controller
{
    // Tampilkan semua data trainingprogram
    public function index()
    {
        $trainings = TrainingProgram::orderBy('trainingid', 'desc')->get();
        $regions = TrainingRegion::all();
        return view('admin.training.trainingdata', compact('trainings', 'regions'));
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
            'trainingtitle' => 'required',
            'trainingdescription' => 'required',
            'trainingpricerupiah' => 'required|numeric',
            'trainingpricedollar' => 'required|numeric',
            'trainingschedule' => 'required',
            'traininglocation' => 'required',
            'trainingslot' => 'required|numeric',
            'trainingregionid' => 'required|exists:trainingregions,trainingid',
            'gambar' => 'required|image|max:2048|mimes:jpg,jpeg,png',
        ]);

        if ($request->hasFile('gambar')) {
            $filename = time() . '.' . $request->gambar->extension();
            $path = $request->gambar->storeAs('training_images', $filename, 'public'); // Tambahkan 'public' sebagai disk
            $data['trainingimage'] = $filename;
        }

        TrainingProgram::create($data);

        return redirect()->route('trainingprogram.index')->with('success', 'Data berhasil ditambahkan!');
    }

    // Hapus data
    public function destroy($id)
    {
        $training = TrainingProgram::findOrFail($id);

        // Hapus file gambar juga
        if ($training->trainingimage) {
            Storage::delete('public/training_images/' . $training->trainingimage);
        }

        $training->delete();

        return redirect()->route('trainingprogram.index')->with('success', 'Data berhasil dihapus!');
    }

    // Update data
    public function update(Request $request, $id)
    {
        $training = TrainingProgram::findOrFail($id);

        $data = $request->validate([
            'trainingtitle' => 'required|max:50',
            'trainingdescription' => 'required',
            'trainingpricerupiah' => 'required|numeric',
            'trainingpricedollar' => 'required|numeric',
            'trainingschedule' => 'required|date',
            'traininglocation' => 'required|max:255',
            'trainingslot' => 'required|integer',
            'trainingregionid' => 'required|exists:trainingregions,trainingid',
            'gambar' => 'nullable|image|max:2048|mimes:jpg,jpeg,png',
        ]);

        // Jika ada gambar baru, simpan dan hapus yang lama
        if ($request->hasFile('gambar')) {
            $filename = time() . '.' . $request->gambar->extension();
            $request->gambar->storeAs('training_images', $filename, 'public');
            $data['trainingimage'] = $filename;

            // Hapus gambar lama
            Storage::disk('public')->delete('training_images/' . $training->trainingimage);
        } else {
            // Simpan gambar lama jika tidak ada gambar baru
            $data['trainingimage'] = $training->trainingimage;
        }

        $training->update($data);

        return redirect()->route('trainingprogram.index')->with('success', 'Data berhasil diupdate!');
    }

    // Tampilkan untuk user
    public function list()
    {
        $trainings = TrainingProgram::orderBy('trainingid', 'desc')->get();
        return view('user.training.training', compact('trainings'));
    }

    public function show($id)
    {
        $training = TrainingProgram::findOrFail($id);
        return view('user.training.trainingdetail', compact('training'));
    }

    public function form($id)
    {
        $training = TrainingProgram::findOrFail($id);
        return view('user.training.trainingdata', compact('training'));
    }

}
