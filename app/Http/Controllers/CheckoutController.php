<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductShade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('keranjang')
                ->withErrors(['cart' => 'Keranjang masih kosong.']);
        }

        $items = [];
        $total = 0;

        foreach ($cart as $item) {
            $product = Product::find($item['product_id'] ?? null);
            $shade   = ProductShade::find($item['shade_id'] ?? null);

            if (!$product) continue;

            $qty = max(1, (int) ($item['qty'] ?? 1));
            $subtotal = $product->price * $qty;

            $items[] = [
                'product'  => $product,
                'shade'    => $shade,
                'qty'      => $qty,
                'subtotal' => $subtotal,
            ];

            $total += $subtotal;
        }

        // Ongkir TIDAK dihitung dulu
        $shipping = 0;
        $grandTotal = $total;

        return view('checkout.index', compact('user', 'items', 'total', 'shipping', 'grandTotal'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'name'            => 'required|string|max:120',
            'email'           => 'required|email|max:120',
            'phone'           => 'required|string|max:30',
            'address'         => 'required|string|max:500',

            'delivery_method' => 'required|in:courier,pickup',
            'method'          => 'required|in:transfer,cod,store',

            'bank'            => $request->method === 'transfer' ? 'required|string' : 'nullable',
            'payment_proof'   => $request->method === 'transfer'
                ? 'required|image|max:2048'
                : 'nullable',
        ], [
            'bank.required' => 'Silakan pilih bank / e-wallet.',
        ]);

        // Bayar di Toko hanya untuk pickup
        if ($request->method === 'store' && $request->delivery_method !== 'pickup') {
            return back()
                ->withErrors(['method' => 'Metode "Bayar di Toko" hanya tersedia untuk Pick Up.'])
                ->withInput();
        }

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('keranjang')
                ->withErrors(['cart' => 'Keranjang kosong.']);
        }

        DB::beginTransaction();

        try {
            // status order:
            // transfer => menunggu_verifikasi
            // cod/store => diproses
            $orderStatus = ($request->method === 'transfer')
                ? 'menunggu_verifikasi'
                : 'diproses';

            $order = Order::create([
                'user_id'     => Auth::id(),
                'order_code'  => 'ORD-' . strtoupper(Str::random(8)),
                'total_price' => 0,
                'status'      => $orderStatus,
            ]);

            $total = 0;

            foreach ($cart as $item) {
                $product = Product::find($item['product_id'] ?? null);
                $shade   = ProductShade::find($item['shade_id'] ?? null);

                if (!$product) continue;

                $qty = max(1, (int) ($item['qty'] ?? 1));
                $subtotal = $product->price * $qty;

                OrderItem::create([
                    'order_id'         => $order->id,
                    'product_id'       => $product->id,
                    'product_shade_id' => $shade?->id,
                    'price'            => $product->price,
                    'qty'              => $qty,
                    'subtotal'         => $subtotal,
                ]);

                $product->decrement('stock', $qty);
                $total += $subtotal;
            }

            // ongkir tidak dihitung toko -> total_price = subtotal
            $order->update([
                'total_price' => $total,
            ]);

            // upload bukti transfer
            $proofPath = null;
            if ($request->method === 'transfer' && $request->hasFile('payment_proof')) {
                $proofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
            }

            // status payment
            $paymentStatus = match ($request->method) {
                'transfer' => 'waiting_verification',
                'cod'      => 'pending',
                'store'    => 'pending',
                default    => 'pending',
            };

            // catatan payment
            $note = null;
            if ($request->method === 'transfer') {
                $note = 'Bank/E-Wallet: ' . ($request->bank ?? '-');
            } elseif ($request->method === 'store') {
                $note = 'Bayar langsung di toko (Pick Up).';
            }

            Payment::create([
                'order_id'      => $order->id,
                'method'        => $request->method,
                'status'        => $paymentStatus,
                'payment_proof' => $proofPath,
                'note'          => $note,
            ]);

            session()->forget('cart');

            DB::commit();

            return redirect()->route('orders.show', $order->id)
                ->with('success', 'Checkout berhasil!');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['checkout' => $e->getMessage()]);
        }
    }
}
