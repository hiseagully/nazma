<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OngkirController extends Controller
{
    // Ambil daftar provinsi dari RajaOngkir
    public function getProvinces()
    {
        $response = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY')
        ])->get('https://api.rajaongkir.com/starter/province');
        return $response->json();
    }

    // Ambil daftar kota berdasarkan provinsi
    public function getCities(Request $request)
    {
        $province_id = $request->province_id;
        $response = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY')
        ])->get('https://api.rajaongkir.com/starter/city', [
            'province' => $province_id
        ]);
        return $response->json();
    }

    // Hitung ongkir
    public function getOngkir(Request $request)
    {
        $response = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY')
        ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => $request->origin,
            'destination' => $request->destination,
            'weight' => $request->weight,
            'courier' => $request->courier
        ]);
        return $response->json();
    }
}
