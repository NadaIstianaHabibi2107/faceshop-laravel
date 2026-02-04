<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} | Faceshop</title>

    <!-- GLOBAL CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">

    <!-- DETAIL PRODUK CSS -->
    <link rel="stylesheet" href="/assets/css/detail-produk.css">
</head>
<body>

@include('layout.navbar')

<section class="detail-container">

    <!-- GAMBAR PRODUK -->
    <div class="detail-image">
        <img src="/assets/image/1.png" alt="{{ $product->name }}">
    </div>

    <!-- INFO PRODUK -->
    <div class="detail-info">
        <small class="brand">{{ $product->brand }}</small>
        <h1 class="product-name">{{ $product->name }}</h1>

        <h3 class="section-title">Deskripsi</h3>
        <p class="description">
            {{ $product->description }}
        </p>

        <!-- FORM TAMBAH KE KERANJANG -->
        <form action="{{ route('keranjang.tambah') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">

        <select name="shade_id" id="shade_id" class="shade-select" required>
            <option value="">-- Pilih Shade --</option>
            @foreach($product->shades as $shade)
                @php
                $isRecommended = in_array($shade->id, $recommendedShadeIds ?? []);
                @endphp

                <option
                value="{{ $shade->id }}"
                data-tryon-url="{{ route('tryon.show', ['product' => $product->id, 'shade' => $shade->id]) }}"
                data-hex="{{ $shade->hex_color }}"
                >
                {{ $shade->shade_name }} ({{ $shade->undertone }})
                {{ $isRecommended ? '⭐ Recommended' : '' }}
                </option>
            @endforeach
        </select>


        <div class="price-qty">
            <span class="price">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </span>

            <div class="qty-control">
                <button type="button" onclick="decreaseQty()">−</button>
                <input type="text" id="qty" name="qty" value="1" readonly>
                <button type="button" onclick="increaseQty()">+</button>
            </div>
        </div>

        <button type="submit" class="btn-cart">
            Tambah Ke Keranjang
        </button>
        </form>

        <!-- ✅ TRYON BUTTON (LINK DINAMIS) -->
        <a href="#" class="btn-tryon" id="btnTryOn" style="pointer-events:none; opacity:.6;">
        Virtual Try On
        </a>

        <script>
        function increaseQty() {
        let qty = document.getElementById('qty');
        qty.value = parseInt(qty.value) + 1;
        }
        function decreaseQty() {
        let qty = document.getElementById('qty');
        if (qty.value > 1) qty.value = parseInt(qty.value) - 1;
        }

        // ✅ update link tryon sesuai shade yang dipilih
        const shadeSelect = document.getElementById('shade_id');
        const btnTryOn = document.getElementById('btnTryOn');

        shadeSelect.addEventListener('change', function(){
        const opt = shadeSelect.options[shadeSelect.selectedIndex];
        const url = opt.getAttribute('data-tryon-url');

        if(!url){
            btnTryOn.href = "#";
            btnTryOn.style.pointerEvents = "none";
            btnTryOn.style.opacity = ".6";
            return;
        }

        btnTryOn.href = url;
        btnTryOn.style.pointerEvents = "auto";
        btnTryOn.style.opacity = "1";
        });
        </script>

    </div>

</section>

@include('layout.footer')

<!-- JS KHUSUS DETAIL PRODUK -->
<script>
function increaseQty() {
    let qty = document.getElementById('qty');
    qty.value = parseInt(qty.value) + 1;
}

function decreaseQty() {
    let qty = document.getElementById('qty');
    if (qty.value > 1) {
        qty.value = parseInt(qty.value) - 1;
    }
}
</script>

</body>
</html>
