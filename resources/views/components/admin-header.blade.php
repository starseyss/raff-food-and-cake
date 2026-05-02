<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - RAFF</title>
    <link rel="icon" href="/images/logo-raff.png?v=<?= time(); ?>" type="image/png">
<link rel="shortcut icon" href="/images/logo-raff.png?v=<?= time(); ?>">
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
}
.icon-orange {
    filter: brightness(0) saturate(100%) invert(59%) sepia(97%) saturate(1198%) hue-rotate(359deg) brightness(101%) contrast(106%);
}
</style>
</head>

<body class="bg-[#F6F6F6]">

<div class="w-full min-h-screen flex gap-4 md:gap-6 px-3 md:px-6 xl:px-8 py-2 overflow-x-hidden">

<!-- ================= MOBILE HAMBURGER ================= -->
<button id="adminMenuBtn"
    class="lg:hidden fixed top-4 left-4 z-[9999]
           w-11 h-11 bg-white rounded-full shadow-xl
           flex items-center justify-center
           border border-gray-200">

    <span class="text-xl leading-none">☰</span>
</button>

<!-- OVERLAY -->
<div id="adminOverlay"
     class="hidden fixed inset-0 bg-black/40 z-[998] lg:hidden">
</div>

<!-- ================= SIDEBAR ================= -->
<div id="adminSidebar"
     class="
        fixed top-0 left-0
        h-screen
        z-[999]
        transition-transform duration-300

        -translate-x-full
        lg:translate-x-0

        lg:left-3 md:lg:left-6 lg:top-4
     ">

    <div class="w-[78px] lg:w-[85px]
                h-full lg:h-[calc(100vh-32px)]
                bg-white
                border border-gray-100
                shadow-xl
                rounded-none lg:rounded-[40px]
                pt-20 lg:pt-5
                pb-6
                flex flex-col items-center">

        <!-- ISI SIDEBAR -->

        <div class="flex flex-col items-center gap-0 relative">
            
            <a href="{{ route('admin.dashboard') }}"
               class="group relative w-12 lg:w-16 h-12 lg:h-16 flex items-center justify-center transition-all duration-300
               {{ request()->routeIs('admin.dashboard') ? 'my-3 lg:my-4' : 'my-0' }}">
                
                <span class="absolute left-12 lg:left-16 scale-0 transition-all duration-300 origin-left
                             rounded-full bg-[#F59A40] px-3 lg:px-4 py-1 text-xs text-white 
                             group-hover:scale-100 group-hover:translate-x-2 z-50 font-semibold shadow-lg shadow-orange-200">
                    Dashboard
                </span>

                <div class="absolute inset-0 rounded-full transition-all duration-300 transform 
                    {{ request()->routeIs('admin.dashboard') ? 'bg-[#F59A40] scale-100 shadow-md' : 'bg-transparent scale-0 group-hover:scale-75 group-hover:bg-orange-50' }}">
                </div>
                <img src="{{ asset('images/dashboard.png') }}"
                     class="z-10 transition-all duration-300 w-6 lg:w-7
                     {{ request()->routeIs('admin.dashboard') ? 'w-7 lg:w-8 brightness-0 invert' : 'w-6 lg:w-7 icon-orange' }}">
            </a>

            <a href="{{ route('admin.list-order') }}"
               class="group relative w-12 lg:w-16 h-12 lg:h-16 flex items-center justify-center transition-all duration-300
               {{ request()->routeIs('admin.list-order') ? 'my-3 lg:my-4' : 'my-0' }}">
                
                <span class="absolute left-12 lg:left-16 scale-0 transition-all duration-300 origin-left
                             rounded-full bg-[#F59A40] px-3 lg:px-4 py-1 text-xs text-white 
                             group-hover:scale-100 group-hover:translate-x-2 z-50 font-semibold shadow-lg shadow-orange-200">
                    Orders
                </span>

                <div class="absolute inset-0 rounded-full transition-all duration-300 transform 
                    {{ request()->routeIs('admin.list-order') ? 'bg-[#F59A40] scale-100 shadow-md' : 'bg-transparent scale-0 group-hover:scale-75 group-hover:bg-orange-50' }}">
                </div>
                <img src="{{ asset('images/yellow-cart.png') }}"
                     class="z-10 transition-all duration-300 
                     {{ request()->routeIs('admin.list-order') ? 'w-7 lg:w-8 brightness-0 invert' : 'w-6 lg:w-7 icon-orange' }}">
            </a>

            <a href="{{ route('admin.product') }}"
               class="group relative w-12 lg:w-16 h-12 lg:h-16 flex items-center justify-center transition-all duration-300
               {{ request()->routeIs('admin.product') ? 'my-3 lg:my-4' : 'my-0' }}">
                
                <span class="absolute left-12 lg:left-16 scale-0 transition-all duration-300 origin-left
                             rounded-full bg-[#F59A40] px-3 lg:px-4 py-1 text-xs text-white 
                             group-hover:scale-100 group-hover:translate-x-2 z-50 font-semibold shadow-lg shadow-orange-200">
                    Products
                </span>

                <div class="absolute inset-0 rounded-full transition-all duration-300 transform 
                    {{ request()->routeIs('admin.product') ? 'bg-[#F59A40] scale-100 shadow-md' : 'bg-transparent scale-0 group-hover:scale-75 group-hover:bg-orange-50' }}">
                </div>
                <img src="{{ asset('images/box3.png') }}"
                     class="z-10 transition-all duration-300 
                     {{ request()->routeIs('admin.product') ? 'w-7 lg:w-8 brightness-0 invert' : 'w-6 lg:w-7 icon-orange' }}">
            </a>

            <a href="{{ route('admin.payment-list') }}"
               class="group relative w-12 lg:w-16 h-12 lg:h-16 flex items-center justify-center transition-all duration-300
               {{ request()->routeIs('admin.payment-list') ? 'my-3 lg:my-4' : 'my-0' }}">
                
                <span class="absolute left-12 lg:left-16 scale-0 transition-all duration-300 origin-left
                             rounded-full bg-[#F59A40] px-3 lg:px-4 py-1 text-xs text-white 
                             group-hover:scale-100 group-hover:translate-x-2 z-50 font-semibold shadow-lg shadow-orange-200">
                    Payments
                </span>

                <div class="absolute inset-0 rounded-full transition-all duration-300 transform 
                    {{ request()->routeIs('admin.payment-list') ? 'bg-[#F59A40] scale-100 shadow-md' : 'bg-transparent scale-0 group-hover:scale-75 group-hover:bg-orange-50' }}">
                </div>
                <img src="{{ asset('images/dompet.png') }}"
                     class="z-10 transition-all duration-300 
                     {{ request()->routeIs('admin.payment-list') ? 'w-7 lg:w-8 brightness-0 invert' : 'w-6 lg:w-7 icon-orange' }}">
            </a>

            <a href="{{ route('admin.shipping') }}"
               class="group relative w-12 lg:w-16 h-12 lg:h-16 flex items-center justify-center transition-all duration-300
               {{ request()->routeIs('admin.shipping') ? 'my-3 lg:my-4' : 'my-0' }}">
                
                <span class="absolute left-12 lg:left-16 scale-0 transition-all duration-300 origin-left
                             rounded-full bg-[#F59A40] px-3 lg:px-4 py-1 text-xs text-white 
                             group-hover:scale-100 group-hover:translate-x-2 z-50 font-semibold shadow-lg shadow-orange-200">
                    Shipping
                </span>

                <div class="absolute inset-0 rounded-full transition-all duration-300 transform 
                    {{ request()->routeIs('admin.shipping') ? 'bg-[#F59A40] scale-100 shadow-md' : 'bg-transparent scale-0 group-hover:scale-75 group-hover:bg-orange-50' }}">
                </div>
                <img src="{{ asset('images/truck.png') }}"
                     class="z-10 transition-all duration-300 
                     {{ request()->routeIs('admin.shipping') ? 'w-7 lg:w-8 brightness-0 invert' : 'w-6 lg:w-7 icon-orange' }}">
            </a>

            <a href="{{ route('admin.analisis') }}"
               class="group relative w-12 lg:w-16 h-12 lg:h-16 flex items-center justify-center transition-all duration-300
               {{ request()->routeIs('admin.analisis') ? 'my-3 lg:my-4' : 'my-0' }}">
                
                <span class="absolute left-12 lg:left-16 scale-0 transition-all duration-300 origin-left
                             rounded-full bg-[#F59A40] px-3 lg:px-4 py-1 text-xs text-white 
                             group-hover:scale-100 group-hover:translate-x-2 z-50 font-semibold shadow-lg shadow-orange-200">
                    Analytics
                </span>

                <div class="absolute inset-0 rounded-full transition-all duration-300 transform 
                    {{ request()->routeIs('admin.analisis') ? 'bg-[#F59A40] scale-100 shadow-md' : 'bg-transparent scale-0 group-hover:scale-75 group-hover:bg-orange-50' }}">
                </div>
                <img src="{{ asset('images/analisis.png') }}"
                     class="z-10 transition-all duration-300 
                     {{ request()->routeIs('admin.analisis') ? 'w-6 lg:w-7 brightness-0 invert' : 'w-5 lg:w-6 icon-orange' }}">
            </a>
            <!-- HOME -->
<a href="{{ url('/') }}"
   class="group relative w-12 lg:w-16 h-12 lg:h-16 flex items-center justify-center transition-all duration-300 mt-4">
    
    <span class="absolute left-12 lg:left-16 scale-0 transition-all duration-300 origin-left
                 rounded-full bg-[#F59A40] px-3 lg:px-4 py-1 text-xs text-white 
                 group-hover:scale-100 group-hover:translate-x-2 z-50 font-semibold shadow-lg shadow-orange-200">
        Home
    </span>

    <div class="absolute inset-0 rounded-full transition-all duration-300 transform 
         bg-transparent scale-0 group-hover:scale-75 group-hover:bg-orange-50">
    </div>

    <svg xmlns="http://www.w3.org/2000/svg"
         class="z-10 transition-all duration-300 w-6 lg:w-7 text-[#F59A40]"
         fill="none"
         viewBox="0 0 24 24"
         stroke="currentColor">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M3 10.5L12 3l9 7.5M5 9.5V20a1 1 0 001 1h4v-5h4v5h4a1 1 0 001-1V9.5"/>
    </svg>
</a>
        </div>

        <div class="mt-auto">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit"
                        class="group relative w-10 lg:w-14 h-10 lg:h-14 flex items-center justify-center transition-all duration-300">
                    
                    <span class="absolute left-12 lg:left-16 scale-0 transition-all duration-300 origin-left
                                 rounded-full bg-red-500 px-3 lg:px-4 py-1 text-xs text-white 
                                 group-hover:scale-100 group-hover:translate-x-2 z-50 font-semibold shadow-lg shadow-red-100">
                        Logout
                    </span>

                    <div class="absolute inset-0 rounded-full transition-all duration-300 transform bg-transparent scale-0 group-hover:scale-100 group-hover:bg-red-500 group-hover:shadow-lg group-hover:shadow-red-200"></div>
                    
                    <img src="{{ asset('images/logout.png') }}" 
                         class="w-5 lg:w-6 z-10 icon-orange transition-all duration-300 group-hover:brightness-0 group-hover:invert">
                </button>
            </form>
        </div>

    </div>
</div>

    <!-- ================= RIGHT SIDE ================= -->
<div class="flex-1 min-w-0 w-full lg:ml-[100px]">

        <!-- ===== HEADER (FIX UTAMA) ===== -->
       <div class="relative flex items-center justify-between h-14 lg:h-[70px] px-2 lg:px-2">

    <!-- LOGO (KIRI) - Show on mobile with hamburger space -->
    <div class="flex items-center pl-12 lg:pl-0">
        <img src="{{ asset('images/rafflogo.png') }}" 
             class="h-10 lg:h-14 xl:h-[70px] w-auto object-contain">
    </div>

    <!-- SEARCH (CENTER ABSOLUTE) - Hide on mobile -->
<!-- SEARCH -->
<div class="flex-1 px-3 lg:px-6">
    <input type="text"
        placeholder="Search..."
        class="w-full
               h-10 lg:h-[45px]
               bg-[#EDEAE7]
               rounded-full
               px-4 lg:px-5
               outline-none
               text-sm
               placeholder:text-gray-400">
</div>

    <!-- RIGHT -->
    <div class="flex items-center gap-2 lg:gap-4">

        <!-- NOTIFICATION BELL -->
<div class="relative">

    <a href="{{ route('admin.notifications') }}"
       class="group w-9 lg:w-11 h-9 lg:h-11 flex items-center justify-center rounded-full bg-white border border-gray-200 shadow-sm hover:bg-orange-50 hover:border-orange-200 transition-all duration-300">

        <!-- ICON -->
        <img src="{{ asset('images/notif.png') }}"
             class="w-4 lg:w-5 icon-orange transition-all duration-300 group-hover:scale-110">

        <!-- BADGE -->
        <span id="headerNotifBadge"
              class="absolute -top-1 -right-1 min-w-[16px] lg:min-w-[18px] h-4 lg:h-[18px] px-1 bg-red-500 text-white text-[9px] lg:text-[10px] font-bold rounded-full flex items-center justify-center hidden"
              data-notif-badge>
            0
        </span>

    </a>

</div>

        <div class="relative">
            <button id="adminProfileBtn"
                class="w-8 lg:w-9 h-8 lg:h-9 bg-[#F59A40] text-white rounded-full flex items-center justify-center cursor-pointer hover:ring-2 hover:ring-orange-300 transition text-sm lg:text-base">
                {{ strtoupper(substr(auth()->user()->name ?? 'A',0,1)) }}
            </button>

            <div id="adminProfileDropdown"
                 class="hidden absolute right-0 top-full mt-2 lg:mt-3 w-40 lg:w-44 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden z-50">
                <div class="px-3 lg:px-4 py-2 lg:py-3 border-b border-gray-100">
                    <p class="text-sm font-semibold text-gray-800 truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-400 truncate">{{ auth()->user()->email }}</p>
                </div>
                <a href="{{ route('admin.profil') }}"
                   class="flex items-center gap-2 lg:gap-3 px-3 lg:px-4 py-2 lg:py-3 text-sm text-gray-700 hover:bg-orange-50 hover:text-[#F59A40] transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Profil
                </a>
                <form method="POST" action="{{ route('admin.logout') }}" class="border-t border-gray-100">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center gap-2 lg:gap-3 px-3 lg:px-4 py-2 lg:py-3 text-sm text-red-500 hover:bg-red-50 transition text-left">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>

    </div>

</div>
<script>
const adminMenuBtn = document.getElementById('adminMenuBtn');
const adminSidebar = document.getElementById('adminSidebar');
const adminOverlay = document.getElementById('adminOverlay');

if (adminMenuBtn && adminSidebar) {

    adminMenuBtn.addEventListener('click', function () {

        adminSidebar.classList.toggle('-translate-x-full');

        adminOverlay.classList.toggle('hidden');
    });

    adminOverlay.addEventListener('click', function () {

        adminSidebar.classList.add('-translate-x-full');

        adminOverlay.classList.add('hidden');
    });

}
</script>
        <!-- SLOT CONTENT (ISI DASHBOARD MASUK SINI) -->
        <div class="mt-2">
