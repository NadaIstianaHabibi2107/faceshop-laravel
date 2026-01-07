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

        <form action="/daftar" method="POST">
          @csrf

          <label>Nama Lengkap</label>
          <input type="text" name="name" placeholder="Masukkan nama lengkap" required>

          <label>Email</label>
          <input type="email" name="email" placeholder="Masukkan email" required>

          <label>Password</label>
          <input type="password" name="password" placeholder="Masukkan password" required>

          <label>Alamat</label>
          <input type="text" name="address" placeholder="Masukkan alamat" required>

          <label>Nomor Telepon</label>
          <input type="number" name="phone" placeholder="Masukkan nomor telepon" required>

          <hr>
          <h3>Profil kecantikan</h3>

          <label>Jenis Kulit</label>
          <select name="skin_type" required>
            <option value="">Pilih jenis kulit</option>
            <option value="Normal">Normal</option>
            <option value="Berminyak">Berminyak</option>
          </select>

          <label>Warna Kulit</label>
          <select name="skin_tone" required>
            <option value="">Pilih warna kulit</option>
            <option value="Fair">Fair/Putih</option>
          </select>

          <label>Undertone</label>
          <select name="undertone" required>
            <option value="Warm">Warm</option>
          </select>

          <label>Masalah Kulit</label>
          <select name="skin_problem" required>
            <option value="Jerawat">Jerawat</option>
          </select>

          <label>Warna Pembuluh Darah</label>
          <select name="vein_color" required>
            <option value="Biru">Biru / Ungu</option>
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


</body>

</html>