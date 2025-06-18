<?php

namespace App\Http\Controllers;

use App\Models\TrainingProgram;
use App\Models\ProductCollection;

class LandingPageController extends Controller
{
    public function index()
    {
        $trainings = \App\Models\TrainingProgram::orderBy('trainingschedule', 'desc')->take(8)->get()->map(function($t) {
            return [
                'img' => $t->trainingimage
                    ? asset('storage/training_images/' . $t->trainingimage)
                    : asset('images/no-image.png'),
                'alt' => $t->trainingtitle,
                'title' => $t->trainingtitle,
                'date' => \Carbon\Carbon::parse($t->trainingschedule)->translatedFormat('d F Y'),
                'location' => $t->traininglocation,
                'url' => url('/training/' . $t->trainingid),
            ];
        })->values()->toArray();

        $products = \App\Models\ProductCollection::orderBy('created_at', 'desc')->take(8)->get()->map(function($p) {
            return [
                'img' => $p->productimage
                    ? asset('storage/productcatalog/' . $p->productimage)
                    : asset('images/no-image.png'),
                'alt' => $p->productname,
                'title' => $p->productname,
                'price' => 'Rp ' . (is_numeric($p->productpricerupiah) ? number_format($p->productpricerupiah, 0, ',', '.') : '-'),
                'category' => $p->productcatalogid,
                'disabled' => $p->productstock <= 0,
                'url' => url('/product/' . $p->productid),
            ];
        })->values()->toArray();

        return view('landingpage', compact('trainings', 'products'));
    }
}
