<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Faceshop</title>
    <link rel="stylesheet" href="/assets/css/style.css" />
    {{-- @vite(['resources/css/style.css']) --}}
</head>

<body>
    @include('layout.navbar')
    <!-- NAVBAR -->
    <div id="navbar"></div>

    <!-- HERO -->
    <section class="hero">
        <div class="hero-text">
            <h1>
                Temukan <span class="highlight">Kecantikan</span><br>
                yang Sesuai dengan<br>
                <span class="highlight-soft">Warna Kulitmu!</span>
            </h1>
            <p>
                Dapatkan rekomendasi produk kosmetik terbaik yang sesuai
                dengan jenis kulit dan warna kulitmu melalui analisis kulit personal kami.
            </p>
            <div class="hero-btn">
                <button class="btn-primary">Mulai Skin Quiz →</button>
                <button class="btn-outline">Lihat Produk</button>
            </div>
        </div>

        <div class="hero-image">
            <img src="assets/image/hero-product.png" alt="Produk">
        </div>
    </section>

    <!-- PRODUK -->
    <section class="product">
        <div class="section-header">
            <div>
                <small>Koleksi Terbaik</small>
                <h2>Produk <span>Unggulan</span></h2>
            </div>
            <button class="btn-outline small">Lihat Semua →</button>
        </div>

        <div class="product-list">
            <div class="card">
                <span class="badge">Best Seller</span>
                <img src="assets/image/1.png" alt="">
                <h4>Skintific</h4>
                <h3>Brightening Serum</h3>
                <p>Kulit Normal</p>
                <strong>RP 80.000</strong>
            </div>

            <div class="card">
                <span class="badge">Popular</span>
                <img src="assets/image/1.png" alt="">
                <h4>Skintific</h4>
                <h3>Brightening Serum</h3>
                <p>Kulit Normal</p>
                <strong>RP 80.000</strong>
            </div>

            <div class="card">
                <span class="badge">New</span>
                <img src="assets/image/1.png" alt="">
                <h4>Skintific</h4>
                <h3>Brightening Serum</h3>
                <p>Kulit Normal</p>
                <strong>RP 80.000</strong>
            </div>
        </div>
    </section>


    <!-- PRODUK -->
    <section class="product">
        ...
    </section>

    <!-- FOOTER -->
    <div id="footer"></div>

    <script src="script.js"></script>
</body>

</html>