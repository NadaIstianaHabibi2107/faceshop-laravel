<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rekomendasi | Faceshop</title>

  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/rekomendasi.css') }}">
</head>
<body class="faceshop-body">

@include('layout.navbar')

<section class="rekom-header">
  <div class="rekom-header-inner">
    <h1>Rekomendasi Personal Untukmu</h1>
    <p>Berdasarkan tone & undertone kamu, kami pilih produk yang paling cocok.</p>
  </div>
</section>

<section class="rekom-page">

  {{-- INFO MATCH / EMPTY --}}
  @if(!$tone || !$undertone)
    <div class="rekom-alert">
      <div class="rekom-alert-text">
        <b>Profil tone & undertone belum lengkap</b>
        <p>Lengkapi dulu profil supaya rekomendasi bisa muncul.</p>
      </div>
      <a href="{{ route('profile') }}" class="btn-primary-mini">Lengkapi Profil</a>
    </div>
  @else
    <div class="rekom-top">
      <div>
        <h2>Produk yang Direkomendasikan</h2>
        <div class="match-pill">
          Match: <b>{{ $tone }}</b> • <b>{{ $undertone }}</b>
        </div>
      </div>

      <button class="btn-lite" type="button" disabled>Filter</button>
    </div>
  @endif

  {{-- GRID --}}
  <div class="rekom-grid">
    @forelse($recommendations as $shade)
      <div class="rekom-card">
        <span class="badge">Recommended</span>

        <a href="{{ route('produk.show', $shade->product->id) }}" class="rekom-link">
          <div class="rekom-img">
            <img src="/assets/image/1.png" alt="{{ $shade->product->name }}">
          </div>

          <div class="rekom-body">
            <small class="brand">{{ $shade->product->brand }}</small>
            <h3 class="name">{{ $shade->product->name }}</h3>

            <div class="shade-line">
              <span class="dot" style="background: {{ $shade->hex_color ?? '#ddd' }}"></span>
              <div class="shade-text">
                <b>{{ $shade->shade_name }}</b>
                <small>{{ $shade->tone }} • {{ $shade->undertone }}</small>
              </div>
            </div>

            <div class="price">
              Rp {{ number_format($shade->product->price, 0, ',', '.') }}
            </div>

            <div class="cta">Lihat Detail →</div>
          </div>
        </a>
      </div>
    @empty
      @if($tone && $undertone)
        <div class="rekom-empty">
          <b>Tidak ada rekomendasi yang cocok.</b>
          <p>Coba ubah tone / undertone di profil untuk melihat hasil lain.</p>
          <a href="{{ route('profile') }}" class="btn-primary-mini">Ubah Profil</a>
        </div>
      @endif
    @endforelse
  </div>

</section>

@include('layout.footer')

</body>
</html>
