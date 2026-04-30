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
     class="fixed inset-0 bg-black/60 flex items-center justify-center z-[999] p-4">

    <div class="relative">

        <button id="closePopup"
                class="absolute -top-2 -right-2 bg-white w-8 h-8 rounded-full
                       flex items-center justify-center shadow text-black font-bold z-10">
            ✕
        </button>

        <a href="{{ route('login') }}">
            <img src="{{ asset('images/welcome.png') }}"
                 class="w-full max-w-[400px] rounded-2xl shadow-2xl cursor-pointer">
        </a>

    </div>
</div>
@endguest
<header class="relative z-50 bg-white border-b border-gray-200">

    <div class="max-w-[1320px] mx-auto px-3 md:px-6">

        <!-- ================= BARIS ATAS ================= -->
<div class="h-14 md:h-[60px] flex items-center justify-between text-[13px] md:text-[14px]">

    <!-- LEFT SIDE -->
    <div class="flex items-center gap-3">

        <!-- HAMBURGER MOBILE -->
        <button id="menuBtn"
            class="md:hidden text-2xl min-w-[44px] min-h-[44px]
                   flex items-center justify-center">
            ☰
        </button>

        <!-- LOGO MOBILE -->
        <a href="{{ route('home') }}"
           class="md:hidden flex items-center">

            <img src="{{ asset('images/rafflogo.png') }}"
                 class="h-9 w-auto object-contain">
        </a>

        <!-- MENU DESKTOP -->
        <nav class="hidden md:flex items-center gap-6 lg:gap-10 text-gray-500">

            <a href="{{ route('home') }}" class="hover:text-black">
                Home
            </a>

            <a href="{{ route('menu') }}" class="hover:text-black">
                Menu
            </a>

            <a href="{{ route('pesanan') }}" class="hover:text-black">
                Pesanan Saya
            </a>

            <a href="{{ route('contact') }}" class="hover:text-black">
                Bantuan
            </a>

            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}"
                       class="hover:text-blue-500 font-semibold">
                        Dashboard Admin
                    </a>
                @endif
            @endauth

        </nav>

    </div>

    <!-- RIGHT -->
    <div class="flex items-center gap-3 md:gap-6">

        @auth
            <button class="relative text-xl p-2 min-w-[44px] min-h-[44px]
                           flex items-center justify-center">
                🔔
            </button>

            <!-- PROFILE -->
            <div class="relative">

                <button id="profileBtn"
                    class="w-8 h-8 md:w-9 md:h-9 bg-[#F59A40]
                           text-white rounded-full
                           flex items-center justify-center
                           text-sm font-semibold">

                    {{ strtoupper(substr(auth()->user()->name,0,1)) }}

                </button>

                <div id="profileDropdown"
                    class="hidden absolute right-0 top-full mt-3
                           w-48 bg-white border border-gray-200
                           rounded-xl shadow-xl overflow-hidden
                           text-sm z-[999]">

                    <a href="{{ route('landing.profil') }}"
                       class="block px-4 py-3 hover:bg-gray-50">
                        👤 Akun Saya
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit"
                            class="w-full text-left px-4 py-3
                                   hover:bg-red-50 text-red-500">

                            🚪 Logout

                        </button>
                    </form>

                </div>

            </div>
        @endauth

        @guest
            <a href="{{ route('login') }}"
               class="px-4 py-2 bg-[#F59A40]
                      text-white text-sm rounded-full
                      min-h-[44px] flex items-center">

                Masuk

            </a>
        @endguest

    </div>

</div>
        <!-- ================= BARIS BAWAH ================= -->
        <div class="h-20 md:h-[90px] flex flex-col md:flex-row md:items-center md:justify-between gap-2 md:gap-0">

<!-- LOGO -->
<div class="hidden md:flex items-center gap-4">
    <img src="{{ asset('images/rafflogo.png') }}"
         class="h-14 lg:h-[60px] w-auto object-contain">
</div>

            <!-- SEARCH -->
<!-- SEARCH + CART WRAPPER -->
<div class="flex items-center gap-2 md:gap-4 w-full md:flex-1">

    <!-- SEARCH -->
    <div class="flex-1 relative min-w-0">

        <input type="text"
               placeholder="Cari makanan..."
               class="
                    w-full
                    h-10 md:h-11 lg:h-[50px]
                    rounded-full
                    border border-gray-200
                    bg-white
                    px-4 md:px-6
                    pr-12
                    text-sm
                    outline-none
                    focus:border-[#F59A40]
                    transition
               ">

        <!-- BUTTON -->
        <button
            class="
                absolute
                right-1.5
                top-1/2
                -translate-y-1/2
                w-8 h-8
                md:w-10 md:h-10
                rounded-full
                bg-[#F59A40]
                flex items-center justify-center
                shrink-0
            ">

            <img src="{{ asset('images/searchbar.png') }}"
                 class="w-4 h-4 md:w-5 md:h-5 object-contain">

        </button>

    </div>

    <!-- CART -->
    @auth
    <a href="{{ route('landing.cart') }}"
       class="
            relative
            flex items-center justify-center
            min-w-[44px]
            min-h-[44px]
            md:min-w-[48px]
            md:min-h-[48px]
            rounded-full
            hover:bg-gray-100
            transition
            shrink-0
       ">

        <img src="{{ asset('images/cart.png') }}"
             class="
                w-7
                md:w-9
                object-contain
                opacity-90
             ">

        <span id="cartCount"
              class="
                absolute
                -top-1
                -right-1
                min-w-[18px]
                h-[18px]
                px-1
                bg-[#F59A40]
                text-white
                text-[10px]
                font-semibold
                rounded-full
                flex items-center justify-center
                hidden
              ">
            0
        </span>

    </a>
    @endauth

</div>
    </div>

<div id="mobileMenu"
     class="hidden md:hidden bg-white border-t border-gray-200 px-4 py-3 space-y-1">

    <a href="{{ route('home') }}"
       class="block py-3 px-2 text-base rounded-xl hover:bg-gray-100 transition">
        Home
    </a>

    <a href="{{ route('menu') }}"
       class="block py-3 px-2 text-base rounded-xl hover:bg-gray-100 transition">
        Menu
    </a>

    <a href="{{ route('pesanan') }}"
       class="block py-3 px-2 text-base rounded-xl hover:bg-gray-100 transition">
        Pesanan Saya
    </a>

    <a href="{{ route('contact') }}"
       class="block py-3 px-2 text-base rounded-xl hover:bg-gray-100 transition">
        Bantuan
    </a>

    @auth
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}"
               class="block py-3 px-2 text-base rounded-xl
                      bg-blue-50 text-blue-600 font-semibold
                      hover:bg-blue-100 transition">

                Dashboard Admin
            </a>
        @endif
    @endauth

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