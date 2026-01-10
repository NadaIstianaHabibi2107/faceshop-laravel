<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Profil Saya | Faceshop</title>
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/css/profile.css">
</head>
<body>

@include('layout.navbar')

<section class="profile-section">
  <h1 class="profile-title">Profil Saya</h1>

  <div class="profile-tabs">
    <a href="{{ route('profile') }}" class="tab active">
      Profil & Preferensi
    </a>

    <a href="{{ route('orders.index') }}" class="tab">
      Pesanan Saya
    </a>
  </div>

  <form class="profile-wrapper">
    <!-- KIRI -->
    <div class="profile-card">
      <h2>Informasi Pribadi</h2>

      <label>Nama Lengkap</label>
      <input type="text" value="{{ $user->name }}">

      <label>Email</label>
      <input type="email" value="{{ $user->email }}" disabled>

      <label>Nomor Telepon</label>
      <input type="text" value="{{ $user->phone }}">
    </div>

    <!-- KANAN -->
    <div class="profile-card">
      <h2>Profil Kulit (untuk Rekomendasi)</h2>

      <label>Jenis Kulit</label>
      <select>
        <option selected>{{ $user->skin_type }}</option>
        <option>Normal</option>
        <option>Berminyak</option>
        <option>Kering</option>
      </select>

      <label>Warna Kulit</label>
      <select>
        <option selected>{{ $user->skin_tone }}</option>
        <option>Fair</option>
        <option>Medium</option>
        <option>Dark</option>
      </select>

      <label>Undertone Kulit</label>
      <select>
        <option selected>{{ $user->undertone }}</option>
        <option>Warm</option>
        <option>Neutral</option>
        <option>Cool</option>
      </select>
    </div>

    <!-- MASALAH KULIT -->
    <div class="profile-card full">
      <h2>Masalah Kulit yang Ingin Diatasi</h2>

      <div class="skin-problems">
        @php
          $problems = ['Jerawat','Komedo','Pori-pori Besar','Kulit Kusam','Hiperpigmentasi','Bekas Jerawat'];
        @endphp

        @foreach ($problems as $problem)
          <label>
            <input type="checkbox"
              {{ str_contains($user->skin_problem, $problem) ? 'checked' : '' }}>
            {{ $problem }}
          </label>
        @endforeach
      </div>
    </div>

    <div class="profile-action">
      <button type="submit" class="btn-save">Simpan Perubahan</button>
    </div>
  </form>
</section>

</body>
</html>
