<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/landingpage', function () {
    return view('landingpage');
});


//product
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

Route::get('/productorder', function () {
    return view('user.product.productorder');
});

use App\Http\Controllers\SignupController;

Route::get('/signup', [SignupController::class, 'create'])->name('signup');
Route::post('/signup', [SignupController::class, 'store'])->name('signup.store');

//training
Route::get('/signup', function () {
    return view('user.signup');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/profile', function () {
    return view('user.profile');
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

Route::get('/trainingticketdetail', function () {
    return view('user.training.trainingticketdetail');
});

//admin
Route::get('/dashboardadmin', function () {
    return view('admin.dashboardadmin');
});

use App\Http\Controllers\Auth\GoogleController;

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('/auth/google/signup', [GoogleController::class, 'redirectToGoogle'])->name('google.signup');