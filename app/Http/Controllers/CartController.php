<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductShade;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $items = [];
        $total = 0;

        foreach ($cart as $item) {
            $product = Product::find($item['product_id'] ?? null);

            // Ambil shade jika ada shade_id (cart versi baru)
            $shade = null;
            if (!empty($item['shade_id'])) {
                $shade = ProductShade::find($item['shade_id']);
            }

            // Kalau produk tidak ada, skip
            if (!$product) {
                continue;
            }

            $qty = (int) ($item['qty'] ?? 1);
            $qty = max(1, $qty);

            $subtotal = $product->price * $qty;

            $items[] = [
                'product'     => $product,
                'qty'         => $qty,
                'shade'       => $shade,                  // object atau null
                'shade_text'  => $item['shade'] ?? null,  // cart lama (string) kalau masih ada
                'subtotal'    => $subtotal,
            ];

            $total += $subtotal;
        }

        return view('keranjang', compact('items', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty'        => 'required|integer|min:1',
            'shade_id'   => 'required|exists:product_shades,id',
        ], [
            'shade_id.required' => 'Silakan pilih shade terlebih dahulu.',
            'shade_id.exists'   => 'Shade tidak valid.',
        ]);

        // Pastikan shade memang milik product yang dipilih
        $shade = ProductShade::where('id', $request->shade_id)
            ->where('product_id', $request->product_id)
            ->firstOrFail();

        $cart = session()->get('cart', []);

        $cart[] = [
            'product_id' => (int) $request->product_id,
            'qty'        => (int) $request->qty,
            'shade_id'   => (int) $shade->id,
        ];

        session()->put('cart', $cart);

        return redirect()->route('keranjang')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function update(Request $request)
    {
        $request->validate([
            'index' => 'required|integer|min:0',
            'qty'   => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->index])) {
            $cart[$request->index]['qty'] = (int) $request->qty;
        }

        session()->put('cart', $cart);

        return redirect()->route('keranjang');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'index' => 'required|integer|min:0',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->index])) {
            unset($cart[$request->index]);
            $cart = array_values($cart); // rapikan index
        }

        session()->put('cart', $cart);

        return redirect()->route('keranjang');
    }
}
