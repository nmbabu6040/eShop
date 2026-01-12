<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Web\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('root');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'postLogin')->name('postLogin');
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'postRegister')->name('postRegister');
    Route::get('/logout', 'logout')->name('logout');
});

@include('admin.php');
