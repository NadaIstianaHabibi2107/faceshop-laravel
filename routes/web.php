<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/daftar', function () {
    return view('daftar');
});
