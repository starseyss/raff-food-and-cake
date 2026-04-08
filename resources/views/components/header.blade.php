<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RAFF Food & Cake</title>
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


<!-- ================= NAVBAR ================= -->
<header class="relative z-50 bg-white border-b border-gray-200">

    <div class="max-w-[1320px] mx-auto px-6">

        <!-- ================= BARIS ATAS ================= -->
        <div class="h-[60px] flex items-center justify-between text-[14px]">

            <!-- MENU -->
            <nav class="hidden md:flex items-center gap-10 text-gray-500">
                <a href="{{ route('landing.home') }}" class="hover:text-black">Home</a>
                <a href="{{ route('landing.menu') }}" class="hover:text-black">Menu</a>
                <a href="#" class="hover:text-black">Food</a>
                <a href="#" class="hover:text-black">Cake</a>
                <a href="#" class="hover:text-black">Catering</a>
                <a href="#" class="hover:text-black">Contact me</a>
            </nav>

            <!-- ICON KANAN -->
<div class="flex items-center gap-6">

    @auth
        <!-- NOTIF -->
        <button class="relative">
            🔔
        </button>

        <div class="relative">
            <button id="profileBtn"
                class="w-8 h-8 bg-[#F59A40] text-white rounded-full
                       flex items-center justify-center text-sm font-semibold
                       hover:scale-105 transition">
                {{ strtoupper(substr(auth()->user()->name,0,1)) }}
            </button>

            <div id="profileDropdown"
                class="hidden absolute right-0 top-full mt-3 w-44 bg-white
                       border border-gray-200 rounded-xl shadow-xl
                       overflow-hidden text-sm z-[999]">

                <a href="{{ route('landing.profil') }}"
                   class="block px-4 py-3 hover:bg-gray-50 transition">
                    👤 Akun Saya
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-4 py-3 hover:bg-red-50
                               text-red-500 transition">
                        🚪 Logout
                    </button>
                </form>
            </div>
        </div>
    @endauth


    @guest
        <a href="{{ route('login') }}"
           class="px-5 py-2 bg-[#F59A40] text-white text-sm
                  rounded-full font-medium
                  hover:opacity-90 transition">
            Masuk
        </a>
    @endguest

</div>
        </div>

        <!-- ================= BARIS BAWAH ================= -->
        <div class="h-[90px] flex items-center justify-between">

            <!-- LOGO -->
            <div class="flex items-center gap-4">
                <img src="{{ asset('images/logo-raff.png') }}"
                     class="w-[55px] object-contain">

                <div class="leading-tight">
                    <h1 class="text-[28px] font-bold text-[#F59A40]">
                        RAFF
                    </h1>
                    <p class="text-[11px] tracking-[0.3em] text-[#F59A40]">
                        FOOD & CAKE
                    </p>
                </div>
            </div>

<!-- SEARCH BAR -->
<div class="flex-1 mx-16 relative">

    <input type="text"
           placeholder="Cari paket catering atau kue kesukaan mu..."
           class="w-full h-[50px] rounded-full border
                  px-6 pr-14 text-sm outline-none
                  focus:border-[#F59A40]">

    <button class="absolute right-2 top-1/2 -translate-y-1/2
                   w-10 h-10 rounded-full
                   bg-[#F59A40]
                   flex items-center justify-center">

        <img src="{{ asset('images/searchbar.png') }}"
             class="w-6 h-6 object-contain">

    </button>

</div>

            <!-- CART -->
            @auth
            <a href="{{ route('landing.cart') }}" class="relative">
                <img src="{{ asset('images/cart.png') }}"
                     class="w-7 object-contain opacity-70">

                <span class="absolute -top-2 -right-2 bg-[#F59A40]
                             text-white text-[10px] px-1.5 rounded-full">
                    10
                </span>
            </a>
            @endauth

        </div>

    </div>

</header>
