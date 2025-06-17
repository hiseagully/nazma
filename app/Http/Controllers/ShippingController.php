<?php
// app/Http/Controllers/ShippingController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShippingController extends Controller
{
    public function checkShipping(Request $request)
    {
        $response = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY'),
        ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => $request->origin,           // city_id pengirim (admin)
            'destination' => $request->destination, // city_id penerima (user)
            'weight' => $request->weight,           // berat dalam gram
            'courier' => $request->courier,         // jne/tiki/pos
        ]);

        return $response->json();
    }
}