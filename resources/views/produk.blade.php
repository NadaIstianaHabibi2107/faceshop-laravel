<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produk | Faceshop</title>

  <!-- CSS GLOBAL -->
  <link rel="stylesheet" href="/assets/css/style.css" />

  <!-- CSS KHUSUS PRODUK -->
  <link rel="stylesheet" href="/assets/css/produk.css">
</head>
<body>

<!-- NAVBAR -->
 @include('layout.navbar')
    <!-- NAVBAR -->

<!-- HEADER PRODUK -->
<section class="produk-header">
  <h1>Koleksi Produk</h1>
  <p>Temukan produk kecantikan yang tepat untuk kulitmu</p>
</section>

<!-- SEARCH & FILTER -->
<section class="produk-tools">
  <div class="search-box">
    🔍 <input type="text" placeholder="Cari Produk...">
  </div>

  <div class="filter-box">
    🗑️
    <button class="btn-filter">Filter</button>
  </div>
</section>

<!-- REKOMENDASI -->
<section class="produk-section">
  <div class="section-title">
    <h2>Rekomendasi</h2>
    <button class="btn-outline small">Lihat Semua →</button>
  </div>

  <div class="product-list">
    <!-- CARD -->
    <div class="card">
      <span class="badge">Best Seller</span>
      <img src="assets/1.png">
      <h4>Skintific</h4>
      <h3>Brightening Serum</h3>
      <p>Kulit Normal</p>
      <strong>RP 80.000</strong>
    </div>

    <div class="card">
      <span class="badge">Popular</span>
      <img src="assets/1.png">
      <h4>Skintific</h4>
      <h3>Brightening Serum</h3>
      <p>Kulit Normal</p>
      <strong>RP 80.000</strong>
    </div>

    <div class="card">
      <span class="badge">New</span>
      <img src="assets/1.png">
      <h4>Skintific</h4>
      <h3>Brightening Serum</h3>
      <p>Kulit Normal</p>
      <strong>RP 80.000</strong>
    </div>
  </div>
</section>

<!-- PRODUK LAINNYA -->
<section class="produk-section">
  <h2>Produk Lainnya</h2>

  <div class="product-list">
    <!-- COPY CARD -->
    <div class="card">
      <img src="assets/1.png">
      <h4>Skintific</h4>
      <h3>Brightening Serum</h3>
      <p>Kulit Normal</p>
      <strong>RP 80.000</strong>
    </div>

    <div class="card">
      <img src="assets/1.png">
      <h4>Skintific</h4>
      <h3>Brightening Serum</h3>
      <p>Kulit Normal</p>
      <strong>RP 80.000</strong>
    </div>

    <div class="card">
      <img src="assets/1.png">
      <h4>Skintific</h4>
      <h3>Brightening Serum</h3>
      <p>Kulit Normal</p>
      <strong>RP 80.000</strong>
    </div>
  </div>
</section>

<!-- FOOTER -->
<div id="footer"></div>

<script src="script.js"></script>
</body>
</html>
