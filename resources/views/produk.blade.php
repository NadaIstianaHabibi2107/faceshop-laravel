<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produk | Faceshop</title>

  <!-- GLOBAL CSS -->
  <link rel="stylesheet" href="/assets/css/style.css">

  <!-- PRODUK CSS -->
  <link rel="stylesheet" href="/assets/css/produk.css">
</head>
<body>

@include('layout.navbar')

<!-- HEADER -->
<section class="produk-header">
  <h1>Koleksi Produk</h1>
  <p>Temukan produk kecantikan yang tepat untuk kulitmu</p>
</section>

<!-- SEARCH & TOOLS -->
<section class="produk-tools">
  <div class="search-box">
    🔍 <input type="text" placeholder="Cari Produk...">
  </div>

  <div class="tools-right">
    <a href="/keranjang" class="cart-icon">
      🛒
      <span id="cart-count">0</span>
    </a>

    <button class="icon-btn">⚙️ Filter</button>
  </div>
</section>

<!-- REKOMENDASI -->
<section class="produk-section">
  <div class="section-title">
    <h2>Rekomendasi</h2>
    <a href="/rekomendasi" class="lihat-semua">Lihat Semua →</a>
  </div>

  <div class="product-list">

    <!-- CARD -->
    @for ($i = 0; $i < 3; $i++)
    <div class="card">
      <span class="badge">Best Seller</span>

      <img src="/assets/image/1.png" alt="Produk">

      <small>Skintific</small>
      <h3>Brightening Serum</h3>
      <p>Kulit Normal</p>

      <div class="card-bottom">
        <strong>RP 80.000</strong>
        <button class="btn-add-cart">🛒</button>
      </div>
    </div>
    @endfor

  </div>
</section>

<!-- PRODUK LAINNYA -->
<section class="produk-section">
  <h2>Produk Lainnya</h2>

  <div class="product-list">

    @for ($i = 0; $i < 6; $i++)
    <div class="card">
      <img src="/assets/image/1.png" alt="Produk">

      <small>Skintific</small>
      <h3>Brightening Serum</h3>
      <p>Kulit Normal</p>

      <div class="card-bottom">
        <strong>RP 80.000</strong>
        <button class="btn-add-cart">🛒</button>
      </div>
    </div>
    @endfor

  </div>
</section>

@include('layout.footer')

<script src="/assets/js/cart.js"></script>
</body>
</html>
