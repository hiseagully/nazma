<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/landingpage', function () {
    return view('landingpage');
});

Route::get('/product', function () {
    return view('user.product.product');
});

Route::get('/productdetail', function () {
    return view('user.product.productdetail');
});

Route::get('/productcart', function () {
    return view('user.product.productcart');
});

use App\Http\Controllers\SignupController;

Route::get('/signup', [SignupController::class, 'create'])->name('signup');
Route::post('/signup', [SignupController::class, 'store'])->name('signup.store');

Route::get('/signup', function () {
    return view('user.signup');
});

Route::get('/login', function () {
    return view('login');
});