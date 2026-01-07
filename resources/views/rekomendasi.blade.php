<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rekomendasi | Faceshop</title>

  <!-- CSS GLOBAL -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

  <!-- CSS KHUSUS REKOMENDASI -->

  <link rel="stylesheet" href="{{ asset('assets/css/rekomendasi.css') }}">
</head>
<body>

<!-- NAVBAR -->
 @include('layout.navbar')
    <!-- NAVBAR -->
  

<!-- HEADER -->
<section class="rekom-header">
  <h1>Rekomendasi Personal Untukmu</h1>
  <p>Berdasarkan jawaban quiz-mu, kami menemukan produk yang paling cocok</p>
</section>

<!-- CONTENT -->
<section class="rekom-content">

  <!-- PROFIL KULIT -->
  <aside class="profile-card">
    <h4>Profil Kulit Kamu</h4>
    <h3>Nada Istiana Habibi</h3>

    <ul>
      <li><span>Jenis Kulit</span><span class="tag">Kombinasi</span></li>
      <li><span>Skintone</span><span class="tag">Tan</span></li>
      <li><span>Undertone</span><span class="tag">Netral</span></li>
      <li><span>Fokus Perawatan</span><span class="tag">Brightening</span></li>
      <li><span>Sensitivitas</span><span class="tag danger">Tidak</span></li>
    </ul>
  </aside>

  <!-- PRODUK -->
  <div class="rekom-produk">
    <div class="rekom-title">
      <h2>Produk yang Direkomendasikan</h2>
      <button class="btn-filter">Filter</button>
    </div>

    <div class="product-list">
      <!-- CARD -->
      <div class="card">
        <span class="badge">Popular</span>
        <img src="assets/1.png">
        <h4>Skintific</h4>
        <h3>Brightening Serum</h3>
        <p>Kulit Normal</p>
        <strong>RP 80.000</strong>
      </div>

      <div class="card">
        <span class="badge new">New</span>
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
  </div>

</section>

<!-- FOOTER -->
<div id="footer"></div>

</body>
</html>
