<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Faceshop</title>

  <!-- CSS GLOBAL -->
  <link rel="stylesheet" href="/assets/css/style.css" />

  <!-- CSS KHUSUS LOGIN -->
  <link rel="stylesheet" href="/assets/css/login.css">
</head>
<body>


<!-- NAVBAR -->
 @include('layout.navbar')
    <!-- NAVBAR -->

<!-- LOGIN SECTION -->
<section class="login-section">
  <div class="login-wrapper">

    <h1>Selamat Datang di FaceShop</h1>
    <p class="subtitle">Masuk untuk melihat rekomendasi personal</p>

    <div class="login-card">
      <h2>Login</h2>

      <form>
        <label>Email</label>
        <input type="email" placeholder="Masukkan email">

        <label>Password</label>
        <input type="password" placeholder="Masukkan password">

        <button type="submit" class="btn-login-main">Login</button>
      </form>

      <p class="register-text">
        Belum punya akun?
        <a href="/daftar">Daftar sekarang</a>
      </p>
    </div>

  </div>
</section>

<!-- FOOTER -->
<div id="footer"></div>

<script src="script.js"></script>
</body>
</html>
