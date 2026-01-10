<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesanan Saya | Faceshop</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/orders.css">
</head>
<body>

@include('layout.navbar')

<div class="container">

    <h2 class="order-title">
        Pesanan <span>Saya</span>
    </h2>

    @forelse ($orders as $order)
        <a href="{{ route('orders.show', $order->id) }}" class="order-link">

            <div class="order-card">

                <!-- HEADER -->
                <div class="order-header">
                    <div>
                        <h4>Pesanan #{{ $order->order_code }}</h4>
                        <div class="order-date">
                            {{ $order->created_at->format('d/m/Y') }}
                        </div>
                    </div>

                    <!-- STATUS -->
                    <span class="order-status
                        @if($order->status === 'menunggu') status-menunggu
                        @elseif($order->status === 'mengirim') status-mengirim
                        @else status-terkirim
                        @endif
                    ">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <div class="order-divider"></div>

                <!-- JUMLAH ITEM -->
                <div class="order-items">
                    {{ $order->items_count ?? '3' }} item
                </div>

                <!-- TOTAL -->
                <div class="order-footer">
                    <strong>TOTAL</strong>
                    <strong>
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </strong>
                </div>

            </div>

        </a>
    @empty
        <div class="order-card">
            <p>Belum ada pesanan.</p>
        </div>
    @endforelse

</div>

@include('layout.footer')

</body>
</html>
