<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\TrainingProgramController;
use App\Http\Controllers\TrainingRegionController;
use App\Http\Controllers\TrainingTransactionController;
use App\Http\Controllers\TrainingTicketController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\TraineeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductRegionsMapController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ProductCatalogController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ProductCollectionController;

// Halaman umum
Route::get('/', function () { return view('welcome'); });
Route::get('/landingpage', function () { return view('landingpage'); });

// Auth routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/signup', [SignupController::class, 'create'])->name('signup');
Route::post('/signup', [SignupController::class, 'store'])->name('signup.store');

// Resource Controllers
Route::resource('users', UserController::class);
Route::resource('trainingprogram', TrainingProgramController::class);
Route::resource('trainingtransaction', TrainingTransactionController::class);
Route::resource('trainingregion', TrainingRegionController::class);
Route::resource('trainingticket', TrainingTicketController::class);

// Product (user)
Route::get('/product', function () { return view('user.product.product'); });
Route::get('/productdetail', function () { return view('user.product.productdetail'); });
Route::get('/productcart', function () { return view('user.product.productcart'); });
Route::get('/productdata', function () { return view('user.product.productdata'); });
Route::get('/producttransaction', function () { return view('user.product.producttransaction'); });
Route::get('/productorder', function () { return view('user.product.productorder'); });

// Admin
Route::get('/signupadmin', function () { return view('admin.signupadmin'); });
Route::get('/loginadmin', function () { return view('admin.loginadmin'); });
Route::get('/profile', function () { return view('user.profile'); });

// Training (user)
Route::get('/training', function () { return view('user.training.training'); });
Route::get('/trainingdetail', function () { return view('user.training.trainingdetail'); });
Route::get('/trainingdata', function () { return view('user.training.trainingdata'); });
Route::get('/trainingtransaction', function () { return view('user.training.trainingtransaction'); });
Route::get('/trainingticket', function () { return view('user.training.trainingticket'); });
Route::get('/trainingticketdetail', function () { return view('user.training.trainingticketdetail'); });
Route::get('/training/search', [TrainingController::class, 'search'])->name('training.search');

// Admin dashboard Training and Product Data
Route::get('/dashboardadmin', function () { return view('admin.dashboardadmin'); });
Route::get('/admin/userdata', function () { return view('admin.userdata'); })->name('admin.userdata');
Route::get('/trainingadmin', [TrainingProgramController::class, 'index']);
Route::get('/traineeadmin', [TraineeController::class, 'index'])->name('admin.trainee.index');
Route::get('/trainingtransactionadmin', [TrainingTransactionController::class, 'adminIndex'])->name('admin.trainingtransaction.index');
Route::get('/trainingticketadmin', [TrainingTicketController::class, 'index'])->name('admin.trainingticket.index');

// Product Admin
Route::prefix('admin/product')->group(function () {
    Route::resource('productregionsmapadmin', ProductRegionsMapController::class, [
        'names' => [
            'index' => 'productregionsmapadmin.index',
            'create' => 'productregionsmapadmin.create',
            'store' => 'productregionsmapadmin.store',
            'show' => 'productregionsmapadmin.show',
            'edit' => 'productregionsmapadmin.edit',
            'update' => 'productregionsmapadmin.update',
            'destroy' => 'productregionsmapadmin.destroy',
        ],
        'parameters' => [
            'productregionsmapadmin' => 'productregionsmapadmin'
        ]
    ]);
    Route::resource('productcatalog', ProductCatalogController::class, [
        'names' => [
            'index' => 'productcatalog.index',
            'create' => 'productcatalog.create',
            'store' => 'productcatalog.store',
            'show' => 'productcatalog.show',
            'edit' => 'productcatalog.edit',
            'update' => 'productcatalog.update',
            'destroy' => 'productcatalog.destroy',
        ],
        'parameters' => [
            'productcatalog' => 'productcatalog'
        ]
    ]);
    //Route::get('/productcollection', [ProductCollectionController::class, 'index'])->name('productcollection.index');
    //Route::get('/producttransaction', function() {
    //    return view('admin.product.producttransaction');
    //})->name('producttransaction.index');
    //Route::get('/customerdata', function() {
    //    return view('admin.product.customerdata');
    //})->name('customerdata.index');
    //Route::get('/productorder', function() {
    //   return view('admin.product.productorder');
    //})->name('productorder.index');
});

// Google Auth
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('/auth/google/signup', [GoogleController::class, 'redirectToGoogle'])->name('google.signup');

// Training Admin
Route::prefix('training')->name('admin.training.')->group(function() {
    Route::get('/', [TrainingProgramController::class, 'index'])->name('index');
    Route::post('/', [TrainingProgramController::class, 'store'])->name('store');
    Route::delete('/{id}', [TrainingProgramController::class, 'destroy'])->name('destroy');
    Route::put('/{id}', [TrainingProgramController::class, 'update'])->name('update');
});
Route::prefix('trainingregion')->name('admin.trainingregion.')->group(function() {
Route::get('/', [TrainingRegionController::class, 'index'])->name('index');
Route::post('/', [TrainingRegionController::class, 'store'])->name('store');
Route::delete('/{id}', [TrainingRegionController::class, 'destroy'])->name('destroy');
Route::put('/{id}', [TrainingRegionController::class, 'update'])->name('update');
// Tambahkan edit/update jika perlu
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/trainingticket', [TrainingTicketController::class, 'index'])->name('trainingticket.index');

    // Ini adalah route untuk update status (via form POST)
    Route::post('/trainingticket/updatestatus', [TrainingTicketController::class, 'updateStatus'])->name('trainingticket.updatestatus');
});
// Profile update
Route::middleware(['auth'])->group(function () {
    Route::put('/profile', function (Illuminate\Http\Request $request) {
        $user = Auth::user();
        $request->validate([
            'user_name' => 'required|string|max:255',
            'user_phone' => 'required|string|max:20',
            'user_password' => 'nullable|string|min:8',
        ]);
        $user->user_name = $request->user_name;
        $user->user_phone = $request->user_phone;
        if ($request->filled('user_password')) {
            $user->user_password = Hash::make($request->user_password);
        }
        $user->save();
        return redirect()->back()->with('success', 'Profile updated!');
    })->name('profile.update');
});