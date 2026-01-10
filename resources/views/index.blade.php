<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Faceshop</title>
    <link rel="stylesheet" href="/assets/css/style.css" />
</head>

<body>

@include('layout.navbar')

{{-- =====================================================
   JIKA USER BELUM LOGIN → LANDING PAGE UMUM
===================================================== --}}
@if(!$isLogin)

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
            <a href="/login" class="btn-primary">Mulai Sekarang →</a>
            <a href="/produk" class="btn-outline">Lihat Produk</a>
        </div>
    </div>

    <div class="hero-image">
        <img src="/assets/image/hero-product.png" alt="Produk">
    </div>
</section>

<section class="product">
    <div class="section-header">
        <div>
            <small>Koleksi Terbaik</small>
            <h2>Produk <span>Unggulan</span></h2>
        </div>
    </div>

    <div class="product-list">
        @for($i = 0; $i < 3; $i++)
        <div class="card">
            <span class="badge">Best Seller</span>
            <img src="/assets/image/1.png">
            <h4>Skintific</h4>
            <h3>Brightening Serum</h3>
            <p>Kulit Normal</p>
            <strong>RP 80.000</strong>
        </div>
        @endfor
    </div>
</section>

@endif


{{-- =====================================================
   JIKA USER SUDAH LOGIN → LANDING PAGE USER
===================================================== --}}
@if($isLogin)

<section class="product">
    <div class="section-header">
        <div>
            <small>Untuk Kamu</small>
            <h2>Produk <span>Rekomendasi</span></h2>
        </div>
    </div>

    <div class="product-list">
        @for($i = 0; $i < 3; $i++)
        <div class="card">
            <span class="badge">Recommended</span>
            <img src="/assets/image/1.png">
            <h4>Skintific</h4>
            <h3>Brightening Serum</h3>
            <p>Sesuai Kulitmu</p>
            <strong>RP 80.000</strong>
        </div>
        @endfor
    </div>
</section>

<section class="product">
    <div class="section-header">
        <div>
            <small>Koleksi Lengkap</small>
            <h2>Produk <span>Lainnya</span></h2>
        </div>
    </div>

    <div class="product-list">
        @for($i = 0; $i < 6; $i++)
        <div class="card">
            <img src="/assets/image/1.png">
            <h4>Skintific</h4>
            <h3>Brightening Serum</h3>
            <p>Kulit Normal</p>
            <strong>RP 80.000</strong>
        </div>
        @endfor
    </div>
</section>

@endif

@include('layout.footer')

</body>
</html>
