<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(AdminController::class)->group(function () {
    Route::get('/', 'index')->name('admin.root');
});

@include('admin.php');
