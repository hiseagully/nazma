<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/landingpage', function () {
    return view('landingpage');
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
    return view('user.training');
});

Route::get('/trainingdetail', function () {
    return view('user.trainingdetail');
});

Route::get('/trainingdata', function () {
    return view('user.trainingdata');
});