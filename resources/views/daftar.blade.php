<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar | Faceshop</title>

  <!-- CSS GLOBAL -->
  <link rel="stylesheet" href="/assets/css/style.css" />

  <!-- CSS KHUSUS DAFTAR -->
  <link rel="stylesheet" href="/assets/css/daftar.css">
</head>
<body>

<!-- NAVBAR -->
 @include('layout.navbar')
    <!-- NAVBAR -->

<!-- DAFTAR SECTION -->
<section class="daftar-section">
  <div class="daftar-wrapper">

    <h1>Selamat Datang di FaceShop</h1>
    <p class="subtitle">Masuk untuk melihat rekomendasi personal</p>

    <div class="daftar-card">
      <h2>Daftar</h2>

      <form>
        <label>Nama Lengkap</label>
        <input type="text" placeholder="Masukkan nama lengkap">

        <label>Email</label>
        <input type="email" placeholder="Masukkan email">

        <label>Password</label>
        <input type="password" placeholder="Masukkan password">

        <label>Alamat</label>
        <input type="text" placeholder="Masukkan alamat">

        <label>Nomor Telepon</label>
        <input type="text" placeholder="Masukkan nomor telepon">

        <hr>

        <h3>Profil kecantikan</h3>

        <label>Jenis Kulit</label>
       <select>
          <option value="">Pilih jenis kulit</option>
          <option>Normal</option>
          <option>Berminyak</option>
          <option>Kering</option>
          <option>Sensitif</option>
          <option>Kombinasi</option>
        </select>

        <label>Warna Kulit</label>
        <select>
          <option value="">Pilih warna kulit</option>
          <option>Fair/Putih</option>
          <option>Light/Kuning langsat</option>
          <option>Medium/Sawo matang</option>
          <option>Tan/Cokelat</option>
          <option>Dark/Gelap / hitam</option>
        </select>

        <label>Undertone</label>
        <select>
          <option value="">Pilih undertone</option>
          <option>Warm (kuning / keemasan)</option>
          <option>Neutral (campuran)</option>
          <option>Cool (merah muda / kebiruan)</option>
        </select>

        <label>Masalah Kulit</label>
        <select>
          <option value="">Pilih masalah kulit</option>
          <option>Jerawat</option>
          <option>Bekas jerawat / noda hitam</option>
          <option>Kulit kusam</option>
          <option>Pori-pori besar</option>
          <option>Tidak ada</option>
        </select>

        <label>Warna Pembuluh Darah</label>
        <select>
          <option value="">Pilih warna pembuluh darah</option>
          <option>Biru / Ungu</option>
          <option>Hijau</option>
          <option>Campuran</option>
        </select>

        <button type="submit" class="btn-daftar">Daftar</button>
      </form>

      <p class="login-text">
        Sudah punya akun?
        <a href="/login">Masuk sekarang</a>
      </p>
    </div>

  </div>
</section>

<!-- FOOTER -->
<div id="footer"></div>

<script src="script.js"></script>
</body>
</html>
