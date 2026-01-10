<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /* ================= PESANAN SAYA ================= */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.my-orders', compact('orders'));
    }

    /* ================= DETAIL PESANAN ================= */
    public function show(Order $order)
    {
        // keamanan: user hanya bisa lihat pesanan sendiri
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('orders.detail', compact('order'));
    }
}
