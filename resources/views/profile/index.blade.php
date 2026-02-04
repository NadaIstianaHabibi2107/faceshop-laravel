<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Profil Saya | Faceshop</title>
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/css/profile.css">
</head>
<body class="faceshop-body">

@include('layout.navbar')

@php
  $profile = $user->profile;

  // helper kecil biar aman (kalau null)
  $p_skin_type  = strtolower($profile->skin_type ?? '');
  $p_tone       = strtolower($profile->tone ?? '');
  $p_undertone  = strtolower($profile->undertone ?? '');
  $p_vein_color = strtolower($profile->vein_color ?? '');
@endphp

<section class="profile-section">
  <div class="profile-head">
    <div>
      <h1 class="profile-title">Profil Saya</h1>
      <p class="profile-subtitle">Atur data diri dan preferensi shade untuk rekomendasi yang lebih akurat.</p>
    </div>

    @if(session('success'))
      <div class="alert-success">{{ session('success') }}</div>
    @endif
  </div>

  @if ($errors->any())
    <div class="alert-error">
      <b>Gagal menyimpan:</b>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="profile-tabs">
    <a href="{{ route('profile') }}" class="tab active">Profil & Preferensi</a>
    <a href="{{ route('orders.index') }}" class="tab">Pesanan Saya</a>
  </div>

  <form class="profile-wrapper" method="POST" action="{{ route('profile.update') }}">
    @csrf

    {{-- KIRI --}}
    <div class="profile-card">
      <div class="card-title">
        <h2>Informasi Pribadi</h2>
        <small>* wajib diisi</small>
      </div>

      <div class="field">
        <label>Nama Lengkap <span class="req">*</span></label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Nama lengkap">
      </div>

      <div class="field">
        <label>Email</label>
        <input type="email" value="{{ $user->email }}" disabled>
        <small class="hint">Email tidak bisa diubah.</small>
      </div>

      <div class="field">
        <label>Nomor Telepon <span class="req">*</span></label>
        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="08xxxxxxxxxx">
      </div>

      <div class="field">
        <label>Alamat Lengkap <span class="req">*</span></label>
        <textarea name="address" rows="4" placeholder="Alamat lengkap untuk pengiriman">{{ old('address', $user->address) }}</textarea>
      </div>
    </div>

    {{-- KANAN --}}
    <div class="profile-card">
      <div class="card-title">
        <h2>Profil Shade</h2>
        <small>* wajib diisi</small>
      </div>

      <div class="grid-2">
        <div class="field">
          <label>Jenis Kulit  <span class="req">*</span></label>
          <select name="skin_type">
            @foreach ([
              'normal' => 'Normal',
              'berminyak' => 'Berminyak',
              'kering' => 'Kering',
              'kombinasi' => 'Kombinasi',
              'sensitif' => 'Sensitif',
            ] as $val => $label)
              <option value="{{ $val }}" {{ old('skin_type', $profile->skin_type ?? '') === $val ? 'selected' : '' }}>
                {{ $label }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="field">
          <label>Warna Nadi (opsional)</label>
          <select name="vein_color">
            <option value="" {{ old('vein_color', $profile->vein_color ?? '') ? '' : 'selected' }}>-</option>
            @foreach ([
              'biru' => 'Biru',
              'hijau' => 'Hijau',
              'ungu' => 'Ungu',
              'campuran' => 'Campuran',
            ] as $val => $label)
              <option value="{{ $val }}" {{ old('vein_color', $profile->vein_color ?? '') === $val ? 'selected' : '' }}>
                {{ $label }}
              </option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="grid-2">
        <div class="field">
          <label>Skintone (Warna Kulit) <span class="req">*</span></label>
          <select name="tone">
          @foreach ([
            'fair' => 'Fair (Putih Pucat)',
            'light' => 'Light (Putih Gading / Kuning Langsat)',
            'medium' => 'Medium (Sawo Matang)',
            'tan' => 'Tan (Cokelat Muda)',
            'deep' => 'Deep (Cokelat Tua)',
            'dark' => 'Dark (Gelap / Ebony)',
          ] as $val => $label)
            <option value="{{ $val }}" {{ old('tone', $profile->tone ?? '') === $val ? 'selected' : '' }}>
              {{ $label }}
            </option>
          @endforeach
        </select>
        </div>

        <div class="field">
          <label>Undertone (Warna Nadi)<span class="req">*</span></label>
          <select name="undertone">
            @foreach ([
              'warm' => 'Warm (Hijau)',
              'neutral' => 'Neutral (Campuran)',
              'cool' => 'Cool (Biru/Ungu)',
            ] as $val => $label)
              <option value="{{ $val }}" {{ old('undertone', $profile->undertone ?? '') === $val ? 'selected' : '' }}>
                {{ $label }}
              </option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="field">
        <label>Masalah Kulit (opsional)</label>
        @php
          $problems = ['Jerawat','Komedo','Pori-pori Besar','Kulit Kusam','Hiperpigmentasi','Bekas Jerawat'];

          // DB kamu simpan jadi string lowercase "jerawat, komedo..."
          $selectedFromDb = ($profile && $profile->skin_problem)
            ? array_map('trim', explode(',', $profile->skin_problem))
            : [];

          // old('skin_problem') dari form adalah array dengan kapital (sesuai value checkbox)
          // jadi kita pakai old jika ada, kalau tidak, pakai DB tetapi ubah jadi kapital awal biar match checkbox
          $selected = old('skin_problem')
            ? old('skin_problem')
            : array_map(fn($x) => ucwords($x), $selectedFromDb);
        @endphp

        <div class="pill-grid">
          @foreach ($problems as $problem)
            <label class="pill">
              <input type="checkbox" name="skin_problem[]" value="{{ $problem }}"
                {{ in_array($problem, $selected) ? 'checked' : '' }}>
              <span>{{ $problem }}</span>
            </label>
          @endforeach
        </div>
      </div>

      <div class="profile-action">
        <button type="submit" class="btn-save">Simpan Perubahan</button>
      </div>

      <div class="note">
        <b>Catatan:</b> Rekomendasi shade akan memakai <b>Skintone</b> & <b>Undertone</b> kamu.
      </div>
    </div>
  </form>
</section>

@include('layout.footer')
</body>
</html>
