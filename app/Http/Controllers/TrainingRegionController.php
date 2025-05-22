<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainingRegion;

class TrainingRegionController extends Controller
{
    // Tampilkan semua data trainingregions
    public function index()
    {
        $regions = TrainingRegion::all();
        return view('admin.training.trainingregion', compact('regions'));
    }

    // Tampilkan form tambah data
    public function create()
    {
        return view('trainingregions.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:50']);

        TrainingRegion::create(['trainingregionname' => $request->name]);

        return redirect()->route('admin.trainingregion.index');
    }

    // Hapus data
    public function destroy($id)
    {
        TrainingRegion::destroy($id);
        return redirect()->route('admin.trainingregion.index');
    }
    
    // Update data
    public function update(Request $request, $id)
    {
        $region = TrainingRegion::findOrFail($id);
        $region->update($request->all());
        return redirect()->route('admin.trainingregion.index')->with('success', 'Region updated successfully!');
    }

    // Tampilkan form edit data
    public function edit($id)
    {
        $region = TrainingRegion::findOrFail($id);
        return view('admin.trainingregion.edit', compact('region'));
    }
}