<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index']);
Route::get('/main', function () {
    return view('main');
});

Route::get('/shop', [ShopController::class, 'index'])->name('shop');

Route::get('/product/{slug}', [ProductController::class, 'show']);
