<?php

namespace App\Http\Controllers;

use App\Models\ProductRegionsMap;
use Illuminate\Http\Request;

class ProductRegionsMapController extends Controller
{
    // Tampilkan semua data region
    public function index()
    {
        $regions = ProductRegionsMap::all();
        return view('admin.product.productregionsmap', [
            'regions' => $regions,
            'activeMenu' => 'product',
            'activeSubMenu' => 'productregionsmap',
        ]);
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'productregionscode' => 'required|integer',
            'productregionsname' => 'required|string|max:255',
        ]);

        ProductRegionsMap::create([
            'productregionscode' => $request->productregionscode,
            'productregionsname' => $request->productregionsname,
        ]);

        return redirect()->back()->with('success', 'Region berhasil ditambahkan!');
    }

    // Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'productregionscode' => 'required|integer',
            'productregionsname' => 'required|string|max:255',
        ]);

        $region = ProductRegionsMap::findOrFail($id);
        $region->update([
            'productregionscode' => $request->productregionscode,
            'productregionsname' => $request->productregionsname,
        ]);

        return redirect()->back()->with('success', 'Region berhasil diupdate!');
    }

    // Hapus data
    public function destroy($id)
    {
        ProductRegionsMap::destroy($id);
        return redirect()->back()->with('success', 'Region berhasil dihapus!');
    }
}
