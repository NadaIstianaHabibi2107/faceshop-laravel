<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja | Faceshop</title>

    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/keranjang.css">
</head>

<body>

@include('layout.navbar')

<section class="cart-section">
    <h1 class="cart-title">Keranjang <span>Belanja</span></h1>

    <div class="cart-container">

        {{-- LIST PRODUK --}}
        <div class="cart-list">

            {{-- ITEM --}}
            <div class="cart-item" data-price="80000">
                <img src="/assets/image/serum.png" alt="Produk">

                <div class="cart-info">
                    <small>Skintific</small>
                    <h4>Brightening Serum</h4>
                    <p>Kulit Normal</p>

                    <div class="qty-control">
                        <button class="qty-btn minus">−</button>
                        <span class="qty">1</span>
                        <button class="qty-btn plus">+</button>
                    </div>
                </div>

                <div class="cart-price">
                    <p class="price-unit">Rp 80.000</p>
                    <p class="price-total">Rp 80.000</p>
                </div>
            </div>

        </div>

        {{-- RINGKASAN --}}
        <div class="cart-summary">
            <h3>Ringkasan Pesanan</h3>

            <p>Subtotal <span id="subtotal">Rp 80.000</span></p>
            <p>Ongkos Kirim <span>Rp 10.000</span></p>

            <hr>

            <p class="total">TOTAL <span id="total">Rp 90.000</span></p>

            <button class="btn-checkout">Check Out</button>
            <a href="/" class="continue">Lanjut Belanja</a>
        </div>

    </div>
</section>

<script src="/assets/js/keranjang.js"></script>

</body>
</html>
