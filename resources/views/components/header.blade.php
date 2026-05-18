<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>RAFF Food & Cake</title>

    <link rel="icon"
          href="/images/logo-raff.png?v=<?= time(); ?>"
          type="image/png">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">

    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>

        body{
            font-family:'Poppins',sans-serif;
        }

        .menu-category-btn{
            width:100%;
            display:flex;
            align-items:center;
            justify-content:space-between;
            text-align:left;
            padding:14px 16px;
            border-radius:18px;
            transition:.2s;
        }

        .menu-category-btn:hover{
            background:#FFF7ED;
        }

        .submenu-item{
            display:block;
            padding:10px 14px;
            border-radius:12px;
            font-size:14px;
            color:#374151;
            transition:.2s;
        }

        .submenu-item:hover{
            background:#F3F4F6;
        }

    </style>

</head>

<body class="bg-[#F5F5F5] text-black">

<!-- ================= HEADER ================= -->
<header class="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-gray-100 shadow-sm">

    <div class="max-w-[1320px] mx-auto px-4 md:px-6">

        <div class="h-[74px] flex items-center justify-between">

            <!-- ================= LEFT ================= -->
            <div class="flex items-center gap-10">

                <!-- MOBILE MENU BUTTON -->
                <button id="menuBtn"
                        class="md:hidden w-11 h-11 rounded-xl
                               hover:bg-gray-100 transition
                               flex items-center justify-center text-2xl">

                    ☰

                </button>

                <!-- LOGO -->
                <a href="{{ route('home') }}"
                   class="flex items-center shrink-0">

                    <img src="{{ asset('images/rafflogo.png') }}"
                         class="h-11 md:h-[52px] object-contain">

                </a>

                <!-- ================= DESKTOP NAV ================= -->
                <nav class="hidden md:flex items-center gap-8
                            text-[15px] font-medium text-gray-600">

                    <a href="{{ route('home') }}"
                       class="hover:text-[#F59A40] transition">

                        Home

                    </a>

                    <!-- ================= DROPDOWN ================= -->
                    <div class="relative">

                        <button id="menuDropdownBtn"
                                class="flex items-center gap-2
                                       hover:text-[#F59A40] transition">

                            Menu

                            <svg id="menuDropdownArrow"
                                 class="w-4 h-4 transition duration-200"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>

                            </svg>

                        </button>

                        <!-- DROPDOWN CONTENT -->
                        <div id="menuDropdown"
                             class="hidden absolute left-0 top-full mt-4
                                    w-[340px]
                                    bg-white border border-gray-100
                                    rounded-3xl shadow-2xl p-3">

                            <!-- SEMUA MENU -->
                            <a href="{{ route('menu') }}"
                               class="block px-4 py-3 rounded-2xl
                                      hover:bg-orange-50 transition">

                                <p class="font-semibold text-gray-800">
                                    Semua Menu
                                </p>

                                <p class="text-xs text-gray-500 mt-1">
                                    Lihat semua produk
                                </p>

                            </a>

                            <!-- ================= KUE ================= -->
                            <div class="mt-2">

                                <button type="button"
                                        class="menu-category-btn"
                                        data-cat="kue">

                                    <div>

                                        <p class="font-semibold text-gray-800">
                                            🍰 Kue & Snack
                                        </p>

                                        <p class="text-xs text-gray-500 mt-1">
                                            Kue basah, dessert, pudding
                                        </p>

                                    </div>

                                </button>

                                <div class="hidden mt-2 grid grid-cols-2 gap-1"
                                     data-submenu="kue">

                                    <a href="{{ route('menu',['kategori'=>'kue']) }}"
                                       class="submenu-item">
                                        Kue
                                    </a>

                                    <a href="{{ route('menu',['kategori'=>'kue basah']) }}"
                                       class="submenu-item">
                                        Kue Basah
                                    </a>

                                    <a href="{{ route('menu',['kategori'=>'kue kering']) }}"
                                       class="submenu-item">
                                        Kue Kering
                                    </a>

                                    <a href="{{ route('menu',['kategori'=>'dessert']) }}"
                                       class="submenu-item">
                                        Dessert
                                    </a>

                                    <a href="{{ route('menu',['kategori'=>'pudding']) }}"
                                       class="submenu-item">
                                        Pudding
                                    </a>

                                    <a href="{{ route('menu',['kategori'=>'snack kecil']) }}"
                                       class="submenu-item">
                                        Snack
                                    </a>

                                </div>

                            </div>

                            <!-- ================= MASAKAN ================= -->
                            <div class="mt-2">

                                <button type="button"
                                        class="menu-category-btn"
                                        data-cat="masakan">

                                    <div>

                                        <p class="font-semibold text-gray-800">
                                            🍛 Masakan
                                        </p>

                                        <p class="text-xs text-gray-500 mt-1">
                                            Lauk, ayam, nasi, sup
                                        </p>

                                    </div>

                                </button>

                                <div class="hidden mt-2 grid grid-cols-2 gap-1"
                                     data-submenu="masakan">

                                    <a href="{{ route('menu',['kategori'=>'ayam']) }}"
                                       class="submenu-item">
                                        Ayam
                                    </a>

                                    <a href="{{ route('menu',['kategori'=>'ikan']) }}"
                                       class="submenu-item">
                                        Ikan
                                    </a>

                                    <a href="{{ route('menu',['kategori'=>'daging']) }}"
                                       class="submenu-item">
                                        Daging
                                    </a>

                                    <a href="{{ route('menu',['kategori'=>'nasi']) }}"
                                       class="submenu-item">
                                        Nasi
                                    </a>

                                    <a href="{{ route('menu',['kategori'=>'mie']) }}"
                                       class="submenu-item">
                                        Mie
                                    </a>

                                    <a href="{{ route('menu',['kategori'=>'tumisan']) }}"
                                       class="submenu-item">
                                        Tumisan
                                    </a>

                                    <a href="{{ route('menu',['kategori'=>'sup / kuah']) }}"
                                       class="submenu-item">
                                        Sup
                                    </a>

                                    <a href="{{ route('menu',['kategori'=>'sambal']) }}"
                                       class="submenu-item">
                                        Sambal
                                    </a>

                                </div>

                            </div>

                            <!-- ================= GORENGAN ================= -->
                            <div class="mt-2">

                                <button type="button"
                                        class="menu-category-btn"
                                        data-cat="gorengan">

                                    <div>

                                        <p class="font-semibold text-gray-800">
                                            🥟 Gorengan
                                        </p>

                                        <p class="text-xs text-gray-500 mt-1">
                                            Snack & gorengan hangat
                                        </p>

                                    </div>

                                </button>

                                <div class="hidden mt-2 grid grid-cols-2 gap-1"
                                     data-submenu="gorengan">

                                    <a href="{{ route('menu',['kategori'=>'gorengan']) }}"
                                       class="submenu-item">
                                        Gorengan
                                    </a>

                                    <a href="{{ route('menu',['kategori'=>'snack kecil']) }}"
                                       class="submenu-item">
                                        Snack Kecil
                                    </a>

                                </div>

                            </div>
                            <!-- ================= MINUMAN ================= -->
<div class="mt-2">

    <button type="button"
            class="menu-category-btn"
            data-cat="minuman">

        <div>

            <p class="font-semibold text-gray-800">
                🥤 Minuman & Fresh
            </p>

            <p class="text-xs text-gray-500 mt-1">
                Minuman, buah, dessert segar
            </p>

        </div>

    </button>

    <div class="hidden mt-2 grid grid-cols-2 gap-1"
         data-submenu="minuman">

        <a href="{{ route('menu',['kategori'=>'minuman']) }}"
           class="submenu-item">
            Minuman
        </a>

        <a href="{{ route('menu',['kategori'=>'buah']) }}"
           class="submenu-item">
            Buah
        </a>

        <a href="{{ route('menu',['kategori'=>'pudding']) }}"
           class="submenu-item">
            Pudding
        </a>

        <a href="{{ route('menu',['kategori'=>'dessert']) }}"
           class="submenu-item">
            Dessert
        </a>

        <a href="{{ route('menu',['kategori'=>'manis']) }}"
           class="submenu-item">
            Manis
        </a>

<a href="{{ route('menu',['kategori'=>'pondoka']) }}"
                                   class="submenu-item">
                                    Pondoka
                                </a>

    </div>

</div>

                        </div>

                    </div>

                    <a href="{{ route('pesanan') }}"
                       class="hover:text-[#F59A40] transition">

                        Pesanan Saya

                    </a>

                    <a href="{{ route('contact') }}"
                       class="hover:text-[#F59A40] transition">

                        Bantuan

                    </a>

                    @auth
                        @if(auth()->user()->role === 'admin')

                            <a href="{{ route('admin.dashboard') }}"
                               class="text-blue-500 font-semibold">

                                Dashboard Admin

                            </a>

                        @endif
                    @endauth

                </nav>

            </div>

            <!-- ================= RIGHT ================= -->
            <div class="flex items-center gap-3">

                <!-- SEARCH -->
                <form method="GET"
                      action="{{ route('menu') }}"
                      class="hidden md:flex relative w-[320px]">

                    <input type="text"
                           name="search"
                           placeholder="Cari makanan..."
                           value="{{ request('search') }}"
                           class="w-full h-11 rounded-full
                                  border border-gray-200
                                  bg-white
                                  px-5 pr-12
                                  text-sm outline-none
                                  focus:border-[#F59A40]">

                    <button type="submit"
                            class="absolute right-1 top-1/2
                                   -translate-y-1/2
                                   w-9 h-9 rounded-full
                                   bg-[#F59A40]
                                   flex items-center justify-center">

                        <img src="{{ asset('images/searchbar.png') }}"
                             class="w-4 h-4">

                    </button>

                </form>

                @auth

                <!-- NOTIFIKASI -->
                <a href="{{ route('notifikasi.index') }}"
                   class="relative w-11 h-11 rounded-full
                          hover:bg-gray-100 transition
                          flex items-center justify-center">

                    <img src="{{ asset('images/notif.png') }}"
                         class="w-6">


                    @php
                        $unreadCount = \App\Models\UserOrderNotification::where('user_id', auth()->id())
                            ->unread()
                            ->count();
                    @endphp

                    @if($unreadCount > 0)
                        <span class="absolute -top-1 -right-1 min-w-[18px] h-5 px-1 bg-red-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center">
                            {{ $unreadCount }}
                        </span>
                    @endif

                </a>

                <!-- CART -->
                <a href="{{ route('landing.cart') }}"
                   class="relative w-11 h-11 rounded-full
                          hover:bg-gray-100 transition
                          flex items-center justify-center">

                    <img src="{{ asset('images/cart.png') }}"
                         class="w-7">

                </a>


                <!-- PROFILE -->
                <div class="relative">

                    <button id="profileBtn"
                            class="w-10 h-10 rounded-full
                                   bg-[#F59A40]
                                   text-white font-semibold">


                        {{ strtoupper(substr(auth()->user()->name,0,1)) }}

                    </button>

                    <!-- PROFILE DROPDOWN -->
                    <div id="profileDropdown"
                         class="hidden absolute right-0 top-full mt-3
                                w-52 bg-white border border-gray-100
                                rounded-2xl shadow-xl overflow-hidden">

                        <a href="{{ route('landing.profil') }}"
                           class="block px-4 py-3 hover:bg-gray-50">

                            👤 Akun Saya

                        </a>

                        <form method="POST"
                              action="{{ route('logout') }}">

                            @csrf

                            <button type="submit"
                                    class="w-full text-left px-4 py-3
                                           text-red-500 hover:bg-red-50">

                                🚪 Logout

                            </button>

                        </form>

                    </div>

                </div>

            @else

                <!-- LOGIN -->
                <a href="{{ route('login') }}"
                   class="px-5 h-11 rounded-full
                          bg-[#F59A40]
                          text-white text-sm font-medium
                          flex items-center">

                    Masuk

                </a>

                @endauth

            </div>

        </div>

    </div>


   <!-- ================= MOBILE MENU ================= -->
<div id="mobileMenu"
     class="hidden md:hidden bg-white border-t border-gray-100">

    <div class="px-4 py-4 space-y-2">

        <!-- HOME -->
        <a href="{{ route('home') }}"
           class="block px-4 py-3 rounded-2xl hover:bg-gray-100">

            Home

        </a>

        <!-- SEMUA MENU -->
        <a href="{{ route('menu') }}"
           class="block px-4 py-3 rounded-2xl hover:bg-orange-50">

            Semua Menu

        </a>

        <!-- ================= KUE ================= -->
        <div class="border border-gray-100 rounded-2xl overflow-hidden">

            <button type="button"
                    class="mobile-category-btn w-full flex items-center justify-between px-4 py-3 bg-white"
                    data-mobile-cat="kue">

                <span class="font-medium text-gray-800">
                    🍰 Kue & Snack
                </span>

                <span>+</span>

            </button>

            <div class="hidden p-2 grid grid-cols-2 gap-1"
                 data-mobile-submenu="kue">

                <a href="{{ route('menu',['kategori'=>'kue']) }}"
                   class="submenu-item">
                    Kue
                </a>

                <a href="{{ route('menu',['kategori'=>'kue basah']) }}"
                   class="submenu-item">
                    Kue Basah
                </a>

                <a href="{{ route('menu',['kategori'=>'kue kering']) }}"
                   class="submenu-item">
                    Kue Kering
                </a>

                <a href="{{ route('menu',['kategori'=>'dessert']) }}"
                   class="submenu-item">
                    Dessert
                </a>

                <a href="{{ route('menu',['kategori'=>'pudding']) }}"
                   class="submenu-item">
                    Pudding
                </a>

                <a href="{{ route('menu',['kategori'=>'snack kecil']) }}"
                   class="submenu-item">
                    Snack
                </a>

            </div>

        </div>

        <!-- ================= MASAKAN ================= -->
        <div class="border border-gray-100 rounded-2xl overflow-hidden">

            <button type="button"
                    class="mobile-category-btn w-full flex items-center justify-between px-4 py-3 bg-white"
                    data-mobile-cat="masakan">

                <span class="font-medium text-gray-800">
                    🍛 Masakan
                </span>

                <span>+</span>

            </button>

            <div class="hidden p-2 grid grid-cols-2 gap-1"
                 data-mobile-submenu="masakan">

                <a href="{{ route('menu',['kategori'=>'ayam']) }}"
                   class="submenu-item">
                    Ayam
                </a>

                <a href="{{ route('menu',['kategori'=>'ikan']) }}"
                   class="submenu-item">
                    Ikan
                </a>

                <a href="{{ route('menu',['kategori'=>'daging']) }}"
                   class="submenu-item">
                    Daging
                </a>

                <a href="{{ route('menu',['kategori'=>'nasi']) }}"
                   class="submenu-item">
                    Nasi
                </a>

                <a href="{{ route('menu',['kategori'=>'mie']) }}"
                   class="submenu-item">
                    Mie
                </a>

                <a href="{{ route('menu',['kategori'=>'tumisan']) }}"
                   class="submenu-item">
                    Tumisan
                </a>

                <a href="{{ route('menu',['kategori'=>'sup / kuah']) }}"
                   class="submenu-item">
                    Sup
                </a>

                <a href="{{ route('menu',['kategori'=>'sambal']) }}"
                   class="submenu-item">
                    Sambal
                </a>

            </div>

        </div>

        <!-- ================= GORENGAN ================= -->
        <div class="border border-gray-100 rounded-2xl overflow-hidden">

            <button type="button"
                    class="mobile-category-btn w-full flex items-center justify-between px-4 py-3 bg-white"
                    data-mobile-cat="gorengan">

                <span class="font-medium text-gray-800">
                    🥟 Gorengan
                </span>

                <span>+</span>

            </button>

            <div class="hidden p-2 grid grid-cols-2 gap-1"
                 data-mobile-submenu="gorengan">

                <a href="{{ route('menu',['kategori'=>'gorengan']) }}"
                   class="submenu-item">
                    Gorengan
                </a>

                <a href="{{ route('menu',['kategori'=>'snack kecil']) }}"
                   class="submenu-item">
                    Snack Kecil
                </a>

            </div>

        </div>

        <!-- ================= MINUMAN ================= -->
        <div class="border border-gray-100 rounded-2xl overflow-hidden">

            <button type="button"
                    class="mobile-category-btn w-full flex items-center justify-between px-4 py-3 bg-white"
                    data-mobile-cat="minuman">

                <span class="font-medium text-gray-800">
                    🥤 Minuman & Fresh
                </span>

                <span>+</span>

            </button>

            <div class="hidden p-2 grid grid-cols-2 gap-1"
                 data-mobile-submenu="minuman">

                <a href="{{ route('menu',['kategori'=>'minuman']) }}"
                   class="submenu-item">
                    Minuman
                </a>

                <a href="{{ route('menu',['kategori'=>'buah']) }}"
                   class="submenu-item">
                    Buah
                </a>

                <a href="{{ route('menu',['kategori'=>'dessert']) }}"
                   class="submenu-item">
                    Dessert
                </a>

                <a href="{{ route('menu',['kategori'=>'pudding']) }}"
                   class="submenu-item">
                    Pudding
                </a>

                <a href="{{ route('menu',['kategori'=>'manis']) }}"
                   class="submenu-item">
                    Manis
                </a>

                <a href="{{ route('menu',['kategori'=>'pondoka']) }}"
                   class="submenu-item">
                    Pondoka
                </a>

            </div>

        </div>

        <!-- PESANAN -->
        <a href="{{ route('pesanan') }}"
           class="block px-4 py-3 rounded-2xl hover:bg-gray-100">

            Pesanan Saya

        </a>

        <!-- BANTUAN -->
        <a href="{{ route('contact') }}"
           class="block px-4 py-3 rounded-2xl hover:bg-gray-100">

            Bantuan

        </a>

    </div>

</div>
</header>

<!-- ================= SCRIPT ================= -->
<script>

const menuBtn = document.getElementById('menuBtn');
const mobileMenu = document.getElementById('mobileMenu');

if(menuBtn){

    menuBtn.addEventListener('click', function(){

        mobileMenu.classList.toggle('hidden');

    });

}

// DESKTOP DROPDOWN
const menuDropdownBtn = document.getElementById('menuDropdownBtn');
const menuDropdown = document.getElementById('menuDropdown');
const menuDropdownArrow = document.getElementById('menuDropdownArrow');

if(menuDropdownBtn){

    menuDropdownBtn.addEventListener('click', function(e){

        e.stopPropagation();

        menuDropdown.classList.toggle('hidden');
        menuDropdownArrow.classList.toggle('rotate-180');

    });

    document.addEventListener('click', function(e){

        if(
            !menuDropdown.contains(e.target) &&
            !menuDropdownBtn.contains(e.target)
        ){

            menuDropdown.classList.add('hidden');
            menuDropdownArrow.classList.remove('rotate-180');

        }

    });

}

// SUBMENU
// Perilaku yang diinginkan: saat klik kategori (mis. "Kue & Snack"), tampilkan grup submenu yang sesuai.
// Grup lain ditutup agar tidak bercampur.
document.querySelectorAll('[data-cat]').forEach(btn => {

    btn.addEventListener('click', function (e) {

        e.stopPropagation();

        const cat = this.dataset.cat;

        // Saat pencet kategori (Kue & Snack), tampilkan SEMUA item di grupnya sekaligus.
        // Jadi tidak perlu pilih satu-satu: buka grup yang sesuai, tutup grup lain.
        document.querySelectorAll('[data-submenu]').forEach(el => {
            if (el.dataset.submenu === cat) {
                el.classList.remove('hidden');
            } else {
                el.classList.add('hidden');
            }
        });

    });

});
// ================= MOBILE SUBMENU =================
document.querySelectorAll('[data-mobile-cat]').forEach(btn => {

    btn.addEventListener('click', function () {

        const cat = this.dataset.mobileCat;

        document.querySelectorAll('[data-mobile-submenu]').forEach(el => {

            if(el.dataset.mobileSubmenu === cat){

                el.classList.toggle('hidden');

            }else{

                el.classList.add('hidden');

            }

        });

    });

});
// PROFILE
const profileBtn = document.getElementById('profileBtn');
const profileDropdown = document.getElementById('profileDropdown');

if(profileBtn){

    profileBtn.addEventListener('click', function(e){

        e.stopPropagation();

        profileDropdown.classList.toggle('hidden');

    });

    document.addEventListener('click', function(){

        profileDropdown.classList.add('hidden');

    });

}

</script>