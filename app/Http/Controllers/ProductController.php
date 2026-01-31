<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Halaman daftar produk
    public function index()
    {
        $products = Product::all();
        return view('produk', compact('products'));
    }

    // Halaman detail produk
    public function show($id)
    {
        // Ambil produk BESERTA relasi shades
        $product = Product::with('shades')->findOrFail($id);

        return view('detail_produk', compact('product'));
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
