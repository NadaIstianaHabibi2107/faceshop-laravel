<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;



Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/daftar', function () {
    return view('daftar');
})->name('daftar.show');

Route::post('/daftar', [RegisterController::class, 'store'])->name('daftar.store');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [LoginController::class, 'process'])->name('login.process');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/produk', function () {
    return view('produk');
})->name('produk');


Route::get('/rekomendasi', function () {
    return view('rekomendasi');
});

Route::get('/profile', [ProfileController::class, 'index'])
    ->middleware('auth')
    ->name('profile');
    
Route::get('/keranjang', function () {
    return view('keranjang');
})->name('keranjang');

Route::get('/pesanan-saya', [OrderController::class, 'index'])
    ->middleware('auth')
    ->name('orders.index');

Route::get('/pesanan/{order}', [OrderController::class, 'show'])
    ->middleware('auth')
    ->name('orders.show');