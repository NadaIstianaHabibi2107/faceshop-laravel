<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name'        => 'required|string|max:120',
            'phone'       => 'required|string|max:30',
            'address'     => 'required|string|max:500',

            'skin_type'   => 'required|in:Normal,Berminyak,Kering,Kombinasi,Sensitif',
            'skin_tone'   => 'required|in:Fair,Light,Medium,Tan,Deep,Dark',
            'undertone'   => 'required|in:Warm,Neutral,Cool',
            'vein_color'  => 'nullable|in:Biru,Hijau,Ungu,Campuran',
            'skin_problem'=> 'nullable|array',
            'skin_problem.*' => 'string|max:50',
        ]);

        // simpan checkbox jadi string (mis: "Jerawat, Komedo")
        $data['skin_problem'] = !empty($data['skin_problem'])
            ? implode(', ', $data['skin_problem'])
            : '';

        $user->update($data);

        return redirect()
            ->route('profile')
            ->with('success', 'Profil berhasil disimpan.');
    }
}
