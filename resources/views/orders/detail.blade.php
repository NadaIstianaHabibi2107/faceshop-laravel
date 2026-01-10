<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pesanan | Faceshop</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/orders.css">
</head>
<body>

@include('layout.navbar')

<div class="container">

    <div class="order-detail-card">

        <h2 class="order-detail-title">Detail Pesanan</h2>

        <div class="detail-row">
            <span>No Pesanan</span>
            <strong>#{{ $order->order_code }}</strong>
        </div>

        <div class="detail-row">
            <span>Tanggal</span>
            <strong>{{ $order->created_at->format('d F Y') }}</strong>
        </div>

        <div class="detail-row">
            <span>Status</span>
            <span class="order-status status-terkirim">
                {{ ucfirst($order->status) }}
            </span>
        </div>

        <div class="order-divider"></div>

        <div class="detail-row total">
            <span>Total Pembayaran</span>
            <strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong>
        </div>

        <a href="{{ route('produk') }}" class="btn-primary">
            Lanjut Belanja
        </a>

    </div>

</div>

@include('layout.footer')

</body>
</html>
