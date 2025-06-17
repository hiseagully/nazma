<?php

namespace App\Http\Controllers;

use App\Models\ProductCollection;
use App\Models\User;
use App\Models\TrainingRegion;
use App\Models\TrainingProgram;
use App\Models\ProductCatalog; // Tambahkan ini

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalProducts = ProductCollection::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $totalRegions = TrainingRegion::count();
        $totalTrainings = TrainingProgram::count(); // Tambahkan ini

        // Produk per kategori
        $productsByCategory = ProductCollection::selectRaw('productcatalogid, count(*) as total')
            ->groupBy('productcatalogid')->pluck('total', 'productcatalogid');


        // Ambil daftar kategori produk
        $productCategories = ProductCatalog::all();

        // Region per pulau
        $regionsByIsland = TrainingRegion::selectRaw('trainingregionname, count(*) as total')
            ->groupBy('trainingregionname')->pluck('total', 'trainingregionname');

        $customersStatus = [
            'Total' => User::where('role', 'customer')->count(),
        ];

        return view('admin.dashboardadmin', [
            'totalProducts' => $totalProducts,
            'totalCustomers' => $totalCustomers,
            'totalRegions' => $totalRegions,
            'totalTrainings' => $totalTrainings, // Kirim ke view
            'productsByCategory' => $productsByCategory,
            'productCategories' => $productCategories, // <-- kirim ke view
            'customersStatus' => $customersStatus,
            'regionsByIsland' => $regionsByIsland,
            'activeMenu' => 'dashboard',
        ]);
    }
}
