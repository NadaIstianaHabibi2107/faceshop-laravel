<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\ProductShade;

class RecommendationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil dari tabel USERS (karena profile kamu nyimpannya ke users)
        $tone = $user->skin_tone;      // contoh: Fair/Medium/Dark dst
        $undertone = $user->undertone; // Warm/Neutral/Cool

        $recommendations = collect([]);

        // tone & undertone wajib ada
        if (!empty($tone) && !empty($undertone)) {
            $matchedShades = ProductShade::with('product')
                ->where('tone', $tone)
                ->where('undertone', $undertone)
                ->get();

            // 1 produk ditampilkan sekali (ambil shade pertama)
            $recommendations = $matchedShades
                ->groupBy('product_id')
                ->map(fn ($group) => $group->first())
                ->values();
        }

        return view('rekomendasi', compact('recommendations', 'tone', 'undertone'));
    }
}
