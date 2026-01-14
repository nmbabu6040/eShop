<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Web\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('root');
    Route::get('/about', 'about')->name('about');
    Route::get('/shop', 'shop')->name('shop');
    Route::get('/faq', 'faq')->name('faq');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/recently-view', 'recentlyView')->name('recentlyView');
    Route::get('/compare', 'compare')->name('compare');
    Route::get('/product', 'product')->name('product');
    Route::get('/product-single', 'singleProduct')->name('singleProduct');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'postLogin')->name('postLogin');
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'postRegister')->name('postRegister');
    Route::get('/logout', 'logout')->name('logout');
});

@include('admin.php');
