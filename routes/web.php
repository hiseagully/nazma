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

Route::get('/productdata', function () {
    return view('user.product.productdata');
});

Route::get('/producttransaction', function () {
    return view('user.product.producttransaction');
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

Route::get('/training', function () {
    return view('user.training.training');
});

Route::get('/trainingdetail', function () {
    return view('user.training.trainingdetail');
});

Route::get('/trainingdata', function () {
    return view('user.training.trainingdata');
});

Route::get('/trainingtransaction', function () {
    return view('user.training.trainingtransaction');
});

Route::get('/trainingticket', function () {
    return view('user.training.trainingticket');
});