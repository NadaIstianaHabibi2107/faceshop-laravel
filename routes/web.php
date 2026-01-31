<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController; 
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\TryOnController;


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

Route::get('/produk', [ProductController::class, 'index'])
    ->name('produk');

Route::get('/produk/{id}', [ProductController::class, 'show'])
    ->name('produk.show');

Route::get('/rekomendasi', [RecommendationController::class, 'index'])
    ->middleware('auth')
    ->name('rekomendasi');

Route::get('/profile', [ProfileController::class, 'index'])
    ->middleware('auth')
    ->name('profile');

Route::post('/profile', [ProfileController::class, 'update'])
    ->middleware('auth')
    ->name('profile.update');

Route::get('/keranjang', [CartController::class, 'index'])
    ->name('keranjang');

Route::get('/pesanan-saya', [OrderController::class, 'index'])
    ->middleware('auth')
    ->name('orders.index');

Route::get('/pesanan/{order}', [OrderController::class, 'show'])
    ->middleware('auth')
    ->name('orders.show');

Route::post('/keranjang/tambah', [CartController::class, 'add'])
    ->name('keranjang.tambah');

Route::post('/keranjang/update', [CartController::class, 'update'])
    ->name('keranjang.update');

Route::post('/keranjang/hapus', [CartController::class, 'remove'])
    ->name('keranjang.hapus');

    
Route::get('/checkout', [CheckoutController::class, 'show'])
    ->middleware('auth')
    ->name('checkout.show');

Route::post('/checkout', [CheckoutController::class, 'process'])
    ->middleware('auth')
    ->name('checkout.process');

Route::get('/produk/search', [ProductController::class, 'search'])
    ->name('produk.search');

Route::get('/virtual_tryon', [TryOnController::class, 'index'])->name('tryon');

Route::get('/produk/{product}/tryon/{shade}', [TryOnController::class, 'show'])
    ->name('tryon.show');