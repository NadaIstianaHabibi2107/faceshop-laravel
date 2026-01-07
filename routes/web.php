<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

Route::get('/daftar', function () {
    return view('daftar');
})->name('daftar.show');
Route::post('/daftar', [RegisterController::class, 'store'])->name('daftar.store');
Route::get('/', function () {
    return view('index');
});
Route::get('/produk', function () {
    return view('produk');
});
Route::get('/rekomendasi', function () {
    return view('rekomendasi');
});
Route::get('/login', function () {
    return view('login');
});
