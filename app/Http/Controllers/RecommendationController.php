<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Services\RecommendationEngine;

class RecommendationController extends Controller
{
    public function index(RecommendationEngine $engine)
    {
        $user = Auth::user()->load('profile');
        $profileModel = $user->profile;

        $recommendations = collect([]);

        if ($profileModel && ($profileModel->tone && $profileModel->undertone)) {

            $profile = [
                'tone'      => $profileModel->tone,       // lowercase
                'undertone' => $profileModel->undertone,  // lowercase
            ];

            $shades = $engine->recommend($profile);

            $recommendations = $shades
                ->groupBy('product_id')
                ->map(fn ($group) => $group->first())
                ->values();
        }

        return view('rekomendasi', [
            'recommendations' => $recommendations,
            'tone' => ucfirst($profileModel->tone ?? ''),
            'undertone' => ucfirst($profileModel->undertone ?? ''),
        ]);
    }
}
