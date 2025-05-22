<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\TrainingProgramController;
use App\Http\Controllers\TrainingRegionController;
use App\Http\Controllers\TrainingTransactionController;
use App\Http\Controllers\TrainingTicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\ProductRegionsMapController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ProductCatalogController;

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
Route::get('/userdata', function () { return view('admin.userdata'); });
Route::get('/trainingadmin', [TrainingProgramController::class, 'index']);
Route::get('/traineeadmin', function () { return view('admin.training.traineedata'); });
Route::get('/trainingtransactionadmin', [TrainingTransactionController::class, 'adminIndex'])->name('admin.trainingtransaction.index');
Route::get('/trainingticketadmin', [TrainingTicketController::class, 'adminIndex'])->name('admin.trainingticket.index');
Route::get('/productregionsmapadmin', function () { return view('admin.product.productregionsmapdata'); });
Route::get('/productadmin', function () { return view('admin.product.productdata'); });
Route::get('/customeradmin', function () { return view('admin.product.customerdata'); });
Route::get('/producttransactionadmin', function () { return view('admin.product.producttransaction'); });
Route::get('/training/search', [TrainingController::class, 'search'])->name('training.search');


// Google Auth
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('/auth/google/signup', [GoogleController::class, 'redirectToGoogle'])->name('google.signup');

// Admin Training Region
Route::prefix('trainingregion')->name('admin.trainingregion.')->group(function() {
Route::get('/', [TrainingRegionController::class, 'index'])->name('index');
Route::post('/', [TrainingRegionController::class, 'store'])->name('store');
Route::delete('/{id}', [TrainingRegionController::class, 'destroy'])->name('destroy');
Route::put('/{id}', [TrainingRegionController::class, 'update'])->name('update');
// Tambahkan edit/update jika perlu
});

//Admin Product Regions Map
Route::resource('productregionsmapadmin', ProductRegionsMapController::class)->names([
    'index' => 'productregionsmapadmin.index',
    'store' => 'productregionsmapadmin.store',
    'update' => 'productregionsmapadmin.update',
    'destroy' => 'productregionsmapadmin.destroy',
    'edit' => 'productregionsmapadmin.edit',
    'create' => 'productregionsmapadmin.create',
    'show' => 'productregionsmapadmin.show',
]);

// Admin Product Catalog
Route::resource('productcatalog', App\Http\Controllers\ProductCatalogController::class)->names([
    'index' => 'productcatalog.index',
    'store' => 'productcatalog.store',
    'update' => 'productcatalog.update',
    'destroy' => 'productcatalog.destroy',
    'edit' => 'productcatalog.edit',
    'create' => 'productcatalog.create',
    'show' => 'productcatalog.show',
])->parameters(['productcatalog' => 'productcatalog']);

// Admin Product Collection
Route::resource('productcollection', App\Http\Controllers\ProductCollectionController::class)->names([
    'index' => 'productcollection.index',
    'store' => 'productcollection.store',
    'update' => 'productcollection.update',
    'destroy' => 'productcollection.destroy',
    'edit' => 'productcollection.edit',
    'create' => 'productcollection.create',
    'show' => 'productcollection.show',
]);