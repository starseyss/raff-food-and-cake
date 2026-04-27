<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RAFF Food & Cake</title>
    <link rel="icon" href="/images/rafflogo.png?v=<?= time(); ?>" type="image/png">
<link rel="shortcut icon" href="/images/rafflogo.png?v=<?= time(); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="bg-[#F5F5F5] text-black">

<!-- ================= POPUP LOGIN (HANYA GUEST) ================= -->
@guest
<div id="welcomePopup"
     class="fixed inset-0 bg-black/60 flex items-center justify-center z-[999]">

    <div class="relative">

        <button id="closePopup"
                class="absolute -top-3 -right-3 bg-white w-8 h-8 rounded-full
                       flex items-center justify-center shadow text-black font-bold">
            ✕
        </button>

        <a href="{{ route('login') }}">
            <img src="{{ asset('images/welcome.png') }}"
                 class="w-[400px] rounded-2xl shadow-2xl cursor-pointer">
        </a>

    </div>
</div>
@endguest
<header class="relative z-50 bg-white border-b border-gray-200">

    <div class="max-w-[1320px] mx-auto px-4 md:px-6">

        <!-- ================= BARIS ATAS ================= -->
        <div class="h-[60px] flex items-center justify-between text-[14px]">

            <!-- MENU DESKTOP -->
<nav class="hidden md:flex items-center gap-10 text-gray-500">
    <a href="{{ route('home') }}" class="hover:text-black">Home</a>
    <a href="{{ route('menu') }}" class="hover:text-black">Menu</a>
    <a href="{{ route('pesanan') }}" class="hover:text-black">Pesanan Saya</a>
    <a href="{{ route('contact') }}" class="hover:text-black">Bantuan</a>

    @auth
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}"
               class="hover:text-blue-500 font-semibold">
                Dashboard Admin
            </a>
        @endif
    @endauth
</nav>

            <!-- HAMBURGER MOBILE -->
            <button id="menuBtn" class="md:hidden text-2xl">
                ☰
            </button>

            <!-- ICON KANAN -->
            <div class="flex items-center gap-4 md:gap-6">

                @auth
                    <button class="relative text-xl">
                        🔔
                    </button>

                    <!-- PROFILE -->
                    <div class="relative">
                        <button id="profileBtn"
                            class="w-8 h-8 bg-[#F59A40] text-white rounded-full
                                   flex items-center justify-center text-sm font-semibold">
                            {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                        </button>

                        <div id="profileDropdown"
                            class="hidden absolute right-0 top-full mt-3 w-44 bg-white
                                   border border-gray-200 rounded-xl shadow-xl
                                   overflow-hidden text-sm z-[999]">

                            <a href="{{ route('landing.profil') }}"
                               class="block px-4 py-3 hover:bg-gray-50">
                                👤 Akun Saya
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-3 hover:bg-red-50 text-red-500">
                                    🚪 Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth

                @guest
                    <a href="{{ route('login') }}"
                       class="px-4 py-2 bg-[#F59A40] text-white text-sm rounded-full">
                        Masuk
                    </a>
                @endguest

            </div>
        </div>

        <!-- ================= BARIS BAWAH ================= -->
        <div class="h-[90px] flex flex-col md:flex-row md:items-center md:justify-between gap-4 md:gap-0">

            <!-- LOGO -->
            <div class="flex items-center gap-3 md:gap-4">
                <img src="{{ asset('images/rafflogo.png') }}"
                     class="h-[60px] w-auto object-contain ml-19">
            </div>

            <!-- SEARCH -->
            <div class="w-full md:flex-1 md:mx-16 relative">

                <input type="text"
                       placeholder="Cari makanan..."
                       class="w-full h-[42px] md:h-[50px] rounded-full border
                              px-4 md:px-6 pr-12 text-sm outline-none
                              focus:border-[#F59A40]">

                <button class="absolute right-2 top-1/2 -translate-y-1/2
                               w-9 h-9 md:w-10 md:h-10 rounded-full bg-[#F59A40]
                               flex items-center justify-center">

                    <img src="{{ asset('images/searchbar.png') }}"
                         class="w-5 h-5 md:w-6 md:h-6">
                </button>

            </div>

            <!-- CART -->
            @auth
            <a href="{{ route('landing.cart') }}" class="relative self-end md:self-auto">
                <img src="{{ asset('images/cart.png') }}"
                     class="w-9 md:w-10 opacity-80">

                <span id="cartCount"
                      class="absolute -top-2 -right-2 bg-[#F59A40]
                             text-white text-[10px] px-1.5 rounded-full hidden">
                    0
                </span>
            </a>
            @endauth

        </div>
    </div>

    <!-- ================= MOBILE MENU ================= -->
    <div id="mobileMenu"
         class="hidden md:hidden bg-white border-t border-gray-200 px-6 py-4 space-y-3">

        <a href="{{ route('home') }}" class="block">Home</a>
        <a href="{{ route('menu') }}" class="block">Menu</a>
        <a href="{{ route('pesanan') }}" class="block">Pesanan Saya</a>
        <a href="{{ route('contact') }}" class="block">Bantuan</a>

    </div>

</header>
<script>
const menuBtn = document.getElementById('menuBtn');
const mobileMenu = document.getElementById('mobileMenu');

if (menuBtn) {
    menuBtn.addEventListener('click', function () {
        mobileMenu.classList.toggle('hidden');
    });
}
</script>
<script>
const profileBtn = document.getElementById('profileBtn');
const profileDropdown = document.getElementById('profileDropdown');

if (profileBtn && profileDropdown) {
    profileBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        profileDropdown.classList.toggle('hidden');
    });

    // klik luar = tutup dropdown
    document.addEventListener('click', function () {
        profileDropdown.classList.add('hidden');
    });
}
</script>