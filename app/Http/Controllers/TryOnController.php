<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductShade;

class TryOnController extends Controller
{
    public function show(Product $product, ProductShade $shade)
    {
        // ✅ Pastikan shade benar-benar milik product ini (lebih aman)
        $activeShade = $product->shades()
            ->whereKey($shade->id)
            ->firstOrFail();

        $shades = $product->shades()->get();

        $image = !empty($product->image)
            ? asset('storage/' . $product->image)
            : '/assets/image/1.png';

        return view('virtual_tryon', [
            'product'     => $product,
            'shades'      => $shades,
            'activeShade' => $activeShade,
            'image'       => $image,
        ]);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductShade;

class TryOnController extends Controller
{
    public function show(Product $product, ProductShade $shade)
    {
        // Ambil semua shades milik product (sekali saja)
        $product->load('shades');

        // Pastikan shade benar-benar milik product ini
        $activeShade = $product->shades->firstWhere('id', $shade->id);

        if (! $activeShade) {
            abort(404);
        }

        // Gambar produk
        $image = !empty($product->image)
            ? asset('storage/' . $product->image)
            : asset('assets/image/1.png');

        return view('virtual_tryon', [
            'product'     => $product,
            'shades'      => $product->shades,
            'activeShade' => $activeShade,
            'image'       => $image,
        ]);
    }
}
