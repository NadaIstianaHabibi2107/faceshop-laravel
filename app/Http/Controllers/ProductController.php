<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Services\RecommendationEngine;

class ProductController extends Controller
{
    // Halaman daftar produk
    public function index()
    {
        $products = Product::all();
        return view('produk', compact('products'));
    }

    // Halaman detail produk
    public function show($id, RecommendationEngine $engine)
    {
        $product = Product::with('shades')->findOrFail($id);

        $recommendedShadeIds = [];

        if (Auth::check()) {
            $user = Auth::user()->load('profile');
            $profileModel = $user->profile;

            if ($profileModel && ($profileModel->tone && $profileModel->undertone)) {
                $profile = [
                    'tone'      => $profileModel->tone,       // lowercase
                    'undertone' => $profileModel->undertone,  // lowercase
                ];

                // rekomendasi untuk semua shades, lalu filter hanya product ini
                $recShades = $engine->recommend($profile)
                    ->where('product_id', $product->id);

                $recommendedShadeIds = $recShades->pluck('id')->values()->all();
            }
        }

        return view('detail_produk', compact('product', 'recommendedShadeIds'));
    }

    public function search(Request $request)
    {
        $q = $request->q;

        $products = Product::query()
            ->when($q, function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                      ->orWhere('brand', 'like', "%{$q}%")
                      ->orWhere('skin_type', 'like', "%{$q}%");
            })
            ->limit(12)
            ->get();

        return view('partials.product-cards', compact('products'));
    }
}
