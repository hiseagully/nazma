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
use App\Http\Controllers\ProductImagesController;
use App\Http\Controllers\ProductController;
use App\Models\ProductCollection;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ProductTransactionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductOrderController;

// Halaman umum
Route::get('/', [LandingPageController::class, 'index'])->name('landingpage');

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
Route::resource('training', TrainingProgramController::class);

// Product (user)
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/productdetail/{id}', function ($id) {
    $product = ProductCollection::with(['catalog', 'region'])->findOrFail($id);
    return view('user.product.productdetail', compact('product'));
});
Route::get('/productcart', [CartController::class, 'productcart']);
Route::get('/productdata', function () { return view('user.product.productdata'); });
Route::post('/cart/add/{productid}', [CartController::class, 'add'])->name('cart.add');
Route::get('/producttransaction', function () { return view('user.product.producttransaction'); });
Route::get('/productorder', function () { return view('user.product.productorder'); });

// Admin
Route::get('/signupadmin', function () { return view('admin.signupadmin'); });
Route::get('/loginadmin', function () { return view('admin.loginadmin'); });
Route::get('/profile', function () { return view('user.profile'); });

// Training (user)
Route::get('/training', [TrainingProgramController::class, 'list'])->name('training.public');
Route::get('/trainingdetail', function () { return view('user.training.trainingdetail'); });
Route::get('/trainingdata/{id}', [TrainingProgramController::class, 'form'])->name('trainingdata.form');
Route::get('/trainingtransaction', function () { return view('user.training.trainingtransaction'); });
Route::get('/trainingticket', function () { return view('user.training.trainingticket'); });
Route::get('/trainingticketdetail', function () { return view('user.training.trainingticketdetail'); });
Route::get('/training/search', [TrainingController::class, 'search'])->name('training.search');
Route::post('/get-snap-token/{id}', [TrainingTransactionController::class, 'getSnapToken'])->name('get.snap.token');
Route::post('/training/transaction/{id}', [TrainingTransactionController::class, 'store'])->name('trainingtransaction.store');
Route::get('/trainingtransaction', [TrainingTransactionController::class, 'userIndex'])->name('trainingtransaction.index');
Route::get('/training/payment-success', [TrainingTransactionController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/training/transaction/pay/{id}', [TrainingTransactionController::class, 'pay'])->name('trainingtransaction.pay');



// Admin dashboard Training and Product Data
Route::get('/dashboardadmin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/userdata', [UserController::class, 'adminIndex'])->name('admin.userdata');
Route::get('/trainingadmin', [TrainingProgramController::class, 'index']);
Route::get('/traineeadmin', [TraineeController::class, 'index'])->name('admin.trainee.index');
Route::get('/trainingtransactionadmin', [TrainingTransactionController::class, 'adminIndex'])->name('admin.trainingtransaction.index');
Route::get('/trainingticketadmin', [TrainingTicketController::class, 'index'])->name('admin.trainingticket.index');
Route::get('/trainingregion', [TrainingRegionController::class, 'index'])->name('trainingregion.index');

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
    Route::resource('productcollection', ProductCollectionController::class, [
        'names' => [
            'index' => 'productcollection.index',
            'create' => 'productcollection.create',
            'store' => 'productcollection.store',
            'show' => 'productcollection.show',
            'edit' => 'productcollection.edit',
            'update' => 'productcollection.update',
            'destroy' => 'productcollection.destroy',
        ],
        'parameters' => [
            'productcollection' => 'productcollection'
        ]
    ]);
    Route::resource('productimages', ProductImagesController::class, [
        'names' => [
            'index' => 'productimages.index',
            'create' => 'productimages.create',
            'store' => 'productimages.store',
            'show' => 'productimages.show',
            'edit' => 'productimages.edit',
            'update' => 'productimages.update',
            'destroy' => 'productimages.destroy',
        ],
        'parameters' => [
            'productimages' => 'productimageid'
        ]
    ]);
    Route::post('productimages/{productimageid}/set-thumbnail', [\App\Http\Controllers\ProductImagesController::class, 'setThumbnail'])->name('productimages.setThumbnail');
    Route::get('producttransactionadmin', [ProductTransactionController::class, 'index'])->name('producttransactionadmin.index');
    Route::get('customerdata', [CustomerController::class, 'index'])->name('customerdata.index');
    Route::get('productorder', [ProductOrderController::class, 'index'])->name('productorder.index');
});

// Google Auth
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('/auth/google/signup', [GoogleController::class, 'redirectToGoogle'])->name('google.signup');

// Training Admin
Route::prefix('admin/training')->name('admin.training.')->group(function () {
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
    Route::get('/profile', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [UserController::class, 'update'])->name('profile.update');
    Route::put('/profile', function (Illuminate\Http\Request $request) {
        $user = \App\Models\User::find(Auth::id());
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
Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::post('/cart/delete-items', [CartController::class, 'deleteItems']);

/* =====================  RAJA ONGKIR  ===================== */

Route::get('/api/provinces', [App\Http\Controllers\RajaOngkirController::class, 'getProvinces']);
Route::get('/api/cities', [App\Http\Controllers\RajaOngkirController::class, 'getCities']);
Route::post('/api/check-shipping', [App\Http\Controllers\ShippingController::class, 'checkShipping']);

/* =====================  MIDTRANS  ===================== */

Route::middleware(['auth'])->get('/snap/token/{transaction}', [TrainingTransactionController::class, 'getSnapToken'])->name('snap.token');
Route::post('/midtrans/notification', [TrainingTransactionController::class, 'handleNotification'])->name('midtrans.notification');

//search
Route::get('/product/search', [ProductController::class, 'search'])->name('product.search');
// Admin User Management
Route::get('/admin/user/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
Route::put('/admin/user/{id}', [UserController::class, 'update'])->name('admin.user.update');
Route::delete('/admin/user/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');