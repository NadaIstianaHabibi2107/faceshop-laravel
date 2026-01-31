<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk | Faceshop</title>

    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/produk.css">
</head>

<body>
@include('layout.navbar')

{{-- HERO --}}
<section class="rekom-header">
    <h1>Koleksi Produk</h1>
    <p>Temukan produk kecantikan yang tepat untuk kulitmu</p>
</section>

<section class="produk-page">

    {{-- TOOLBAR --}}
    <div class="produk-toolbar">
        <div class="search-wrap">
            <span class="search-ico">🔍</span>

            <input
                type="text"
                id="searchInput"
                placeholder="Cari nama, brand, kategori (foundation/serum), jenis kulit..."
                autocomplete="off"
            />

            <button type="button" class="search-clear" id="searchClear" aria-label="Clear">
                ✕
            </button>
        </div>

        <div class="toolbar-actions">
            <a href="{{ route('keranjang') }}" class="icon-btn" title="Keranjang">🛍️</a>
            <button type="button" class="filter-btn" title="Filter" disabled>
                ☰ <span>Filter</span>
            </button>
        </div>
    </div>

    {{-- SECTION: REKOMENDASI --}}
    <div class="produk-section-head">
        <h2>Rekomendasi</h2>
        <a href="#" class="lihat-semua">Lihat Semua →</a>
    </div>

    <div class="produk-grid" id="produkGrid">
        @forelse ($products->take(3) as $product)
            <div class="product-card"
                 data-name="{{ strtolower($product->name) }}"
                 data-brand="{{ strtolower($product->brand) }}"
                 data-category="{{ strtolower($product->category ?? '') }}"
                 data-skin="{{ strtolower($product->skin_type ?? '') }}">

                <span class="badge {{ $product->badge ?? 'popular' }}">
                    {{ $product->badge ?? 'Popular' }}
                </span>

                <a href="{{ route('produk.show', $product->id) }}" class="card-link">
                    <div class="product-image">
                        <img src="/assets/image/1.png" alt="{{ $product->name }}">
                    </div>

                    <div class="product-info">
                        <small class="brand">{{ $product->brand }}</small>
                        <h3>{{ $product->name }}</h3>
                        <p class="skin-type">{{ $product->skin_type ?? 'Kulit Normal' }}</p>
                        <div class="price">
                            RP {{ number_format($product->price, 0, ',', '.') }}
                        </div>
                    </div>
                </a>

            </div>
        @empty
            <div class="produk-empty" style="grid-column:1/-1;">
                Produk rekomendasi belum tersedia.
            </div>
        @endforelse
    </div>

    {{-- SECTION: PRODUK LAINNYA --}}
    <div class="produk-section-head" style="margin-top: 28px;">
        <h2>Produk Lainnya</h2>
    </div>

    <div class="produk-grid" id="produkGridAll">
        @forelse ($products as $product)
            <div class="product-card"
                 data-name="{{ strtolower($product->name) }}"
                 data-brand="{{ strtolower($product->brand) }}"
                 data-category="{{ strtolower($product->category ?? '') }}"
                 data-skin="{{ strtolower($product->skin_type ?? '') }}">

                <span class="badge {{ $product->badge ?? 'popular' }}">
                    {{ $product->badge ?? 'Popular' }}
                </span>

                <a href="{{ route('produk.show', $product->id) }}" class="card-link">
                    <div class="product-image">
                        <img src="/assets/image/1.png" alt="{{ $product->name }}">
                    </div>

                    <div class="product-info">
                        <small class="brand">{{ $product->brand }}</small>
                        <h3>{{ $product->name }}</h3>
                        <p class="skin-type">{{ $product->skin_type ?? 'Kulit Normal' }}</p>
                        <div class="price">
                            RP {{ number_format($product->price, 0, ',', '.') }}
                        </div>
                    </div>
                </a>

            </div>
        @empty
            <div class="produk-empty" style="grid-column:1/-1;">
                Produk belum tersedia.
            </div>
        @endforelse

        {{-- Empty state kalau hasil search 0 --}}
        <div class="produk-empty" id="emptyState" style="grid-column:1/-1; display:none;">
            Produk tidak ditemukan.
        </div>
    </div>

</section>

@include('layout.footer')

{{-- Script harus paling bawah --}}
<script src="/assets/js/produk-search.js"></script>
</body>
</html>
