<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - RAFF</title>
<link rel="icon" href="/images/rafflogo.png?v=<?= time(); ?>" type="image/png">
<link rel="shortcut icon" href="/images/rafflogo.png?v=<?= time(); ?>">
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

<div class="w-full min-h-screen flex gap-4 md:gap-6 px-4 md:px-6 xl:px-8 py-2">

<div class="fixed left-6 top-26 z-50">
    <div class="w-[85px] h-[850px] 
                bg-white 
                border border-gray-100 
                shadow-xl 
                rounded-[40px] 
                pt-5 pb-8 flex flex-col items-center">

        <div class="flex flex-col items-center gap-0 relative">
            
            <a href="{{ route('admin.dashboard') }}"
               class="group relative w-16 h-16 flex items-center justify-center transition-all duration-300
               {{ request()->routeIs('admin.dashboard') ? 'my-4' : 'my-0' }}">
                
                <span class="absolute left-16 scale-0 transition-all duration-300 origin-left
                             rounded-full bg-[#F59A40] px-4 py-1.5 text-xs text-white 
                             group-hover:scale-100 group-hover:translate-x-2 z-50 font-semibold shadow-lg shadow-orange-200">
                    Dashboard
                </span>

                <div class="absolute inset-0 rounded-full transition-all duration-300 transform 
                    {{ request()->routeIs('admin.dashboard') ? 'bg-[#F59A40] scale-100 shadow-md' : 'bg-transparent scale-0 group-hover:scale-75 group-hover:bg-orange-50' }}">
                </div>
                <img src="{{ asset('images/dashboard.png') }}"
                     class="z-10 transition-all duration-300 
                     {{ request()->routeIs('admin.dashboard') ? 'w-8 brightness-0 invert' : 'w-7 icon-orange' }}">
            </a>

            <a href="{{ route('admin.list-order') }}"
               class="group relative w-16 h-16 flex items-center justify-center transition-all duration-300
               {{ request()->routeIs('admin.list-order') ? 'my-4' : 'my-0' }}">
                
                <span class="absolute left-16 scale-0 transition-all duration-300 origin-left
                             rounded-full bg-[#F59A40] px-4 py-1.5 text-xs text-white 
                             group-hover:scale-100 group-hover:translate-x-2 z-50 font-semibold shadow-lg shadow-orange-200">
                    Orders
                </span>

                <div class="absolute inset-0 rounded-full transition-all duration-300 transform 
                    {{ request()->routeIs('admin.list-order') ? 'bg-[#F59A40] scale-100 shadow-md' : 'bg-transparent scale-0 group-hover:scale-75 group-hover:bg-orange-50' }}">
                </div>
                <img src="{{ asset('images/yellow-cart.png') }}"
                     class="z-10 transition-all duration-300 
                     {{ request()->routeIs('admin.list-order') ? 'w-8 brightness-0 invert' : 'w-7 icon-orange' }}">
            </a>

            <a href="{{ route('admin.product') }}"
               class="group relative w-16 h-16 flex items-center justify-center transition-all duration-300
               {{ request()->routeIs('admin.product') ? 'my-4' : 'my-0' }}">
                
                <span class="absolute left-16 scale-0 transition-all duration-300 origin-left
                             rounded-full bg-[#F59A40] px-4 py-1.5 text-xs text-white 
                             group-hover:scale-100 group-hover:translate-x-2 z-50 font-semibold shadow-lg shadow-orange-200">
                    Products
                </span>

                <div class="absolute inset-0 rounded-full transition-all duration-300 transform 
                    {{ request()->routeIs('admin.product') ? 'bg-[#F59A40] scale-100 shadow-md' : 'bg-transparent scale-0 group-hover:scale-75 group-hover:bg-orange-50' }}">
                </div>
                <img src="{{ asset('images/box3.png') }}"
                     class="z-10 transition-all duration-300 
                     {{ request()->routeIs('admin.product') ? 'w-8 brightness-0 invert' : 'w-7 icon-orange' }}">
            </a>

            <a href="{{ route('admin.payment-list') }}"
               class="group relative w-16 h-16 flex items-center justify-center transition-all duration-300
               {{ request()->routeIs('admin.payment-list') ? 'my-4' : 'my-0' }}">
                
                <span class="absolute left-16 scale-0 transition-all duration-300 origin-left
                             rounded-full bg-[#F59A40] px-4 py-1.5 text-xs text-white 
                             group-hover:scale-100 group-hover:translate-x-2 z-50 font-semibold shadow-lg shadow-orange-200">
                    Payments
                </span>

                <div class="absolute inset-0 rounded-full transition-all duration-300 transform 
                    {{ request()->routeIs('admin.payment-list') ? 'bg-[#F59A40] scale-100 shadow-md' : 'bg-transparent scale-0 group-hover:scale-75 group-hover:bg-orange-50' }}">
                </div>
                <img src="{{ asset('images/dompet.png') }}"
                     class="z-10 transition-all duration-300 
                     {{ request()->routeIs('admin.payment-list') ? 'w-8 brightness-0 invert' : 'w-7 icon-orange' }}">
            </a>

            <a href="{{ route('admin.shipping') }}"
               class="group relative w-16 h-16 flex items-center justify-center transition-all duration-300
               {{ request()->routeIs('admin.shipping') ? 'my-4' : 'my-0' }}">
                
                <span class="absolute left-16 scale-0 transition-all duration-300 origin-left
                             rounded-full bg-[#F59A40] px-4 py-1.5 text-xs text-white 
                             group-hover:scale-100 group-hover:translate-x-2 z-50 font-semibold shadow-lg shadow-orange-200">
                    Shipping
                </span>

                <div class="absolute inset-0 rounded-full transition-all duration-300 transform 
                    {{ request()->routeIs('admin.shipping') ? 'bg-[#F59A40] scale-100 shadow-md' : 'bg-transparent scale-0 group-hover:scale-75 group-hover:bg-orange-50' }}">
                </div>
                <img src="{{ asset('images/truck.png') }}"
                     class="z-10 transition-all duration-300 
                     {{ request()->routeIs('admin.shipping') ? 'w-8 brightness-0 invert' : 'w-7 icon-orange' }}">
            </a>

            <a href="{{ route('admin.analisis') }}"
               class="group relative w-16 h-16 flex items-center justify-center transition-all duration-300
               {{ request()->routeIs('admin.analisis') ? 'my-4' : 'my-0' }}">
                
                <span class="absolute left-16 scale-0 transition-all duration-300 origin-left
                             rounded-full bg-[#F59A40] px-4 py-1.5 text-xs text-white 
                             group-hover:scale-100 group-hover:translate-x-2 z-50 font-semibold shadow-lg shadow-orange-200">
                    Analytics
                </span>

                <div class="absolute inset-0 rounded-full transition-all duration-300 transform 
                    {{ request()->routeIs('admin.analisis') ? 'bg-[#F59A40] scale-100 shadow-md' : 'bg-transparent scale-0 group-hover:scale-75 group-hover:bg-orange-50' }}">
                </div>
                <img src="{{ asset('images/analisis.png') }}"
                     class="z-10 transition-all duration-300 
                     {{ request()->routeIs('admin.analisis') ? 'w-7 brightness-0 invert' : 'w-6 icon-orange' }}">
            </a>
        </div>

        <div class="mt-auto">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit"
                        class="group relative w-14 h-14 flex items-center justify-center transition-all duration-300">
                    
                    <span class="absolute left-16 scale-0 transition-all duration-300 origin-left
                                 rounded-full bg-red-500 px-4 py-1.5 text-xs text-white 
                                 group-hover:scale-100 group-hover:translate-x-2 z-50 font-semibold shadow-lg shadow-red-100">
                        Logout
                    </span>

                    <div class="absolute inset-0 rounded-full transition-all duration-300 transform bg-transparent scale-0 group-hover:scale-100 group-hover:bg-red-500 group-hover:shadow-lg group-hover:shadow-red-200"></div>
                    
                    <img src="{{ asset('images/logout.png') }}" 
                         class="w-6 z-10 icon-orange transition-all duration-300 group-hover:brightness-0 group-hover:invert">
                </button>
            </form>
        </div>

    </div>
</div>

    <!-- ================= RIGHT SIDE ================= -->
    <div class="flex-1 min-w-0">

        <!-- ===== HEADER (FIX UTAMA) ===== -->
       <div class="relative flex items-center justify-between h-[70px] px-2">

    <!-- LOGO (KIRI) -->
    <img src="{{ asset('images/rafflogo.png') }}" 
         class="h-[70px] w-auto object-contain">

    <!-- SEARCH (CENTER ABSOLUTE) -->
    <input type="text"
        placeholder="Search..."
        class="absolute left-1/2 -translate-x-1/2
               w-[250px] md:w-[300px] lg:w-[600px]
               h-[45px]
               bg-[#EDEAE7] rounded-full px-5 outline-none">

    <!-- RIGHT -->
    <div class="flex items-center gap-4">

        <button class="text-lg">🔔</button>

        <div class="relative">
            <button id="adminProfileBtn"
                class="w-9 h-9 bg-[#F59A40] text-white rounded-full flex items-center justify-center cursor-pointer hover:ring-2 hover:ring-orange-300 transition">
                {{ strtoupper(substr(auth()->user()->name ?? 'A',0,1)) }}
            </button>

            <div id="adminProfileDropdown"
                 class="hidden absolute right-0 top-full mt-3 w-44 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden z-50">
                <div class="px-4 py-3 border-b border-gray-100">
                    <p class="text-sm font-semibold text-gray-800 truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-400 truncate">{{ auth()->user()->email }}</p>
                </div>
                <a href="{{ route('admin.profil') }}"
                   class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-orange-50 hover:text-[#F59A40] transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Profil
                </a>
                <form method="POST" action="{{ route('admin.logout') }}" class="border-t border-gray-100">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-500 hover:bg-red-50 transition text-left">
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

        <!-- SLOT CONTENT (ISI DASHBOARD MASUK SINI) -->
        <div class="mt-2">