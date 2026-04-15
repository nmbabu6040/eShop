<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\CheckoutController;
use App\Http\Controllers\Web\DashboardController as WebDashboardController;
use App\Http\Controllers\Web\OrderController;
use App\Http\Controllers\Web\WishListController;
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
    Route::get('/product-single/{slug}', 'singleProduct')->name('singleProduct');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'postLogin')->name('postLogin');
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'postRegister')->name('postRegister');
    Route::get('/logout', 'logout')->name('logout');
});

Route::middleware(['auth'])->group(function () {

    // cart routes
    Route::controller(CartController::class)->group(function () {
        Route::get('/cart/details', 'cartDetails')->name('cart.index');
        Route::post('/cart/store', 'store')->name('cart.store');
        Route::post('/cart/update', 'updateCart')->name('cart.update');
        Route::get('/cart/{cart}/delete', 'deleteCart')->name('cart.delete');
        Route::post('/cart/coupon/apply', 'cartCouponApply')->name('cart.couponApply');
    });

    // wishlist routes
    Route::controller(WishListController::class)->group(function () {
        Route::get('/wishlist', 'index')->name('wishlist');
        Route::get('/wishlist/{slug}/store', 'store')->name('wishlist.store');
        Route::get('/wishlist/{slug}/destroy', 'destroy')->name('wishlist.destroy');
    });

    // Checkout routes
    Route::controller(CheckoutController::class)->group(function () {
        Route::post('/checkout', 'index')->name('checkout.index');
        Route::post('/checkout/store', 'store')->name('checkout.store');
    });

    // order routes
    Route::controller(OrderController::class)->group(function () {
        Route::post('/order/product/store', 'orderStore')->name('customer.order.store');
    });

    // dashboard routes
    Route::controller(WebDashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('user.dashboard');
        Route::get('/orders', 'orders')->name('user.orders');
        Route::get('/order/{order}/details', 'orderDetails')->name('user.order.details');
    });
});

@include('admin.php');
