<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProfile;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load('profile');
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            // akun
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:30',
            'address' => 'required|string|max:500',

            // profile rekomendasi (UI boleh kapital, tapi kita simpan lowercase)
            'skin_type'   => 'required|in:normal,berminyak,kering,kombinasi,sensitif',
            'tone'        => 'required|in:fair,light,medium,tan,deep,dark',
            'undertone'   => 'required|in:warm,neutral,cool',
            'vein_color'  => 'nullable|in:biru,hijau,ungu,campuran',
            'skin_problem'=> 'nullable|array',
        ]);

        // 1) simpan akun ke table users
        $user->update([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
        ]);

        // 2) normalisasi -> lowercase untuk DB
        $skinType  = strtolower(trim($validated['skin_type']));
        $tone      = strtolower(trim($validated['tone']));
        $undertone = strtolower(trim($validated['undertone']));
        $veinColor = !empty($validated['vein_color'])
            ? strtolower(trim($validated['vein_color']))
            : null;

        $skinProblemString = isset($validated['skin_problem'])
            ? strtolower(implode(', ', $validated['skin_problem']))
            : null;

        // 3) simpan profil rekomendasi ke user_profiles (bukan users)
        UserProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'skin_type' => $skinType,
                'tone' => $tone,
                'undertone' => $undertone,
                'vein_color' => $veinColor,
                'skin_problem' => $skinProblemString,
            ]
        );

        return back()->with('success', 'Profil berhasil disimpan.');
    }
}
