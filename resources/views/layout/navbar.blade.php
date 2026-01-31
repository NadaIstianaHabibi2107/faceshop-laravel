<div class="navbar">
    {{-- KIRI --}}
    <div class="logo">
        <img src="/assets/image/faceshop.png" alt="Faceshop">
        <span>FACESHOP</span>
    </div>

    {{-- TENGAH --}}
    <nav class="nav-menu">
        <a href="/">Beranda</a>
        <a href="/produk">Produk</a>
      
        <a href="/rekomendasi">Rekomendasi</a>
    </nav>

    {{-- KANAN --}}
    <div class="nav-right">
        @auth
            <div class="user-menu">
                <button type="button" id="userToggle" class="user-name">
                    {{ Auth::user()->name }}
                </button>

                <div id="userDropdown" class="dropdown">
                    <a href="{{ route('profile') }}">Profil</a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                </div>
            </div>
        @else
            <a href="{{ route('login') }}">
                <button class="btn-login">Login</button>
            </a>
        @endauth
    </div>
</div>

{{-- SCRIPT DROPDOWN --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    const toggle = document.getElementById("userToggle");
    const dropdown = document.getElementById("userDropdown");

    if (toggle && dropdown) {
        toggle.addEventListener("click", function (e) {
            e.stopPropagation();
            dropdown.classList.toggle("show");
        });

        document.addEventListener("click", function () {
            dropdown.classList.remove("show");
        });

        dropdown.addEventListener("click", function (e) {
            e.stopPropagation();
        });
    }
});
</script>
