<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // JIKA USER SUDAH LOGIN
        if (Auth::check()) {
            return view('index', [
                'isLogin' => true
            ]);
        }

        // JIKA USER BELUM LOGIN
        return view('index', [
            'isLogin' => false
        ]);
    }
}
