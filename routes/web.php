<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/landingpage', function () {
    return view('landingpage');
});

//user
Route::get('/signup', function () {
    return view('user.signup');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/profile', function () {
    return view('user.profile');
});

//user//product
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

//admin
Route::get('/signupadmin', function () {
    return view('admin.signupadmin');
});

Route::get('/loginadmin', function () {
    return view('admin.loginadmin');
});

//admin
Route::get('/dashboardadmin', function () {
    return view('admin.dashboardadmin');
});

Route::get('/userdata', function () {
    return view('admin.userdata');
});

Route::get('/trainingdata', function () {
    return view('admin.training.trainingdata');
});

Route::get('/traineedata', function () {
    return view('admin.training.traineedata');
});

Route::get('/trainingtransactiondata', function () {
    return view('admin.training.trainingtransactiondata');
});

Route::get('/trainingticketdata', function () {
    return view('admin.training.trainingticketdata');
});

Route::get('/productdata', function () {
    return view('admin.product.productdata');
});


\Route::get('/customerdata', function () {
    return view('admin.product.customerdata');
});

Route::get('/productorder', function () {
    return view('admin.product.productorder');
});

Route::get('/producttransaction', function () {
    return view('admin.product.producttransaction');
});


use App\Http\Controllers\Auth\LoginController;
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

use App\Http\Controllers\SignupController;
Route::get('/signup', [SignupController::class, 'create'])->name('signup');
Route::post('/signup', [SignupController::class, 'store'])->name('signup.store');

use App\Http\Controllers\Auth\GoogleController;
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('/auth/google/signup', [GoogleController::class, 'redirectToGoogle'])->name('google.signup');

use App\Http\Controllers\TrainingController;
Route::resource('users', UserController::class);

use App\Http\Controllers\TrainingRegionController;
Route::resource('trainingregions', TrainingRegionController::class);

use App\Http\Controllers\TrainingProgramController;
Route::resource('trainingprogram', TrainingProgramController::class);

use App\Http\Controllers\TrainingTransactionController;
Route::resource('trainingtransaction', TrainingTransactionController::class);
