<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validate the input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'address' => 'required',
            'phone' => 'required',
            'skin_type' => 'required',
            'skin_tone' => 'required',
            'undertone' => 'required',
            'skin_problem' => 'required',
            'vein_color' => 'required',
        ]);

        // 2. Create the User
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), // Encrypt password
            'address' => $validated['address'],
            'phone' => $validated['phone'],
            'skin_type' => $validated['skin_type'],
            'skin_tone' => $validated['skin_tone'],
            'undertone' => $validated['undertone'],
            'skin_problem' => $validated['skin_problem'],
            'vein_color' => $validated['vein_color'],
        ]);

        return redirect('/login')->with('success', 'Registration successful!');
    }
}
