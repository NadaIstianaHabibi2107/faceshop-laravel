<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductShade;

class TryOnController extends Controller
{
    public function show(Product $product, ProductShade $shade)
    {
        // pastikan shade milik product
        if ($shade->product_id !== $product->id) {
            abort(404);
        }

        $shades = ProductShade::where('product_id', $product->id)->get();

        $image = $product->image
            ? asset('storage/' . $product->image)
            : '/assets/image/1.png';

        return view('virtual_tryon', [
            'product'     => $product,
            'shades'      => $shades,
            'activeShade' => $shade,
            'image'       => $image,
        ]);
    }
    
}
