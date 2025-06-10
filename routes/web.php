<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductTransactionController;
use App\Http\Controllers\TrainingProgramController;
use App\Http\Controllers\TrainingTransactionController;
use App\Http\Controllers\TrainingTicketController;
use App\Http\Controllers\TrainingRegionController;
use App\Http\Controllers\TrainingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

// Product (user)
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/productdetail/{id}', function ($id) {
    $product = ProductCollection::with(['catalog', 'region'])->findOrFail($id);
    return view('user.product.productdetail', compact('product'));
});
Route::get('/productcart', [CartController::class, 'productcart']);
Route::post('/cart/add/{productid}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::post('/cart/delete-items', [CartController::class, 'deleteItems']);
Route::post('/checkout', [ProductTransactionController::class, 'store'])->name('checkout.store');
Route::get('/transaction/{id}', [ProductTransactionController::class, 'show'])->name('transaction.show');

// Product data & order (gunakan controller jika ingin data dinamis)
Route::get('/productdata', function () { return view('user.product.productdata'); });
Route::get('/producttransaction', function () { return view('user.product.producttransaction'); });
Route::get('/productorder', function () { return view('user.product.productorder'); });

// Training (user)
Route::get('/training', [TrainingProgramController::class, 'list'])->name('training.public');
Route::get('/trainingdetail', function () { return view('user.training.trainingdetail'); });
Route::get('/trainingdata/{id}', [TrainingProgramController::class, 'form'])->name('trainingdata.form');
Route::get('/trainingtransaction', [TrainingTransactionController::class, 'userIndex'])->name('trainingtransaction.index');
Route::get('/training/payment-success', [TrainingTransactionController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/training/transaction/pay/{id}', [TrainingTransactionController::class, 'pay'])->name('trainingtransaction.pay');
Route::post('/get-snap-token/{id}', [TrainingTransactionController::class, 'getSnapToken'])->name('get.snap.token');
Route::post('/training/transaction/{id}', [TrainingTransactionController::class, 'store'])->name('trainingtransaction.store');
Route::get('/trainingticket', function () { return view('user.training.trainingticket'); });
Route::get('/trainingticketdetail', function () { return view('user.training.trainingticketdetail'); });
Route::get('/training/search', [TrainingController::class, 'search'])->name('training.search');

// Training Admin
Route::prefix('admin/training')->name('admin.training.')->group(function () {
    Route::get('/', [TrainingProgramController::class, 'index'])->name('index');
    Route::post('/', [TrainingProgramController::class, 'store'])->name('store');
    Route::delete('/{id}', [TrainingProgramController::class, 'destroy'])->name('destroy');
    Route::put('/{id}', [TrainingProgramController::class, 'update'])->name('update');
});

// Training Region Admin (gunakan salah satu, resource atau group manual, jangan dua-duanya)
Route::resource('trainingregion', TrainingRegionController::class);
// Jika ingin pakai group manual, hapus resource di atas dan gunakan group manual saja

// Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/trainingticket', [TrainingTicketController::class, 'index'])->name('trainingticket.index');
    Route::post('/trainingticket/updatestatus', [TrainingTicketController::class, 'updateStatus'])->name('trainingticket.updatestatus');
});

// Profile update
Route::middleware(['auth'])->put('/profile', function (Illuminate\Http\Request $request) {
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

// RajaOngkir API endpoints
Route::get('/api/provinces', [\App\Http\Controllers\OngkirController::class, 'getProvinces']);
Route::post('/api/cities', [\App\Http\Controllers\OngkirController::class, 'getCities']);
Route::post('/api/ongkir', [\App\Http\Controllers\OngkirController::class, 'getOngkir']);

// Midtrans Snap & Notification
Route::middleware(['auth'])->get('/snap/token/{transaction}', [TrainingTransactionController::class, 'getSnapToken'])->name('snap.token');
Route::post('/midtrans/notification', [TrainingTransactionController::class, 'handleNotification'])->name('midtrans.notification');