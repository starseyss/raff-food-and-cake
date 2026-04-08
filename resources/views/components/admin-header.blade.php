<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - RAFF</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-[#F4F1EE] min-h-screen">

<div class="w-full min-h-screen flex px-10 py-8">

    <!-- ================= SIDEBAR ================= -->
    <div class="w-[95px] bg-[#EDEAE7] rounded-[50px] py-8 flex flex-col items-center justify-between">

        <!-- TOP MENU -->
        <div class="flex flex-col items-center space-y-10">

            <!-- ACTIVE MENU -->
<div class="w-14 h-14 bg-[#F59A40] rounded-full flex items-center justify-center shadow-md">
    
    <div class="grid grid-cols-2 gap-1">
        <div class="w-2.5 h-2.5 bg-white rounded-sm"></div>
        <div class="w-2.5 h-2.5 bg-white rounded-sm"></div>
        <div class="w-2.5 h-2.5 bg-white rounded-sm"></div>
        <div class="w-2.5 h-2.5 bg-white rounded-sm"></div>
    </div>

</div>

            <img src="{{ asset('images/yellow-cart.png') }}" 
                 class="w-8 h-8 cursor-pointer">

            <img src="{{ asset('images/box.png') }}" 
                 class="w-15 h-15 cursor-pointer">

            <img src="{{ asset('images/dompet.png') }}" 
                 class="w-8 h-6 cursor-pointer">

            <img src="{{ asset('images/truck.png') }}" 
                 class="w-8 h-6 cursor-pointer">

            <img src="{{ asset('images/analisis.png') }}" 
                 class="w-6 h-6 cursor-pointer">

        </div>
       <!-- LOGOUT -->
<form method="POST" action="{{ route('admin.logout') }}">
    @csrf
    <button type="submit"
        class="w-full text-left px-4 py-3 hover:bg-red-50
               text-red-500 transition">
        <img src="{{ asset('images/logout.png') }}" 
             class="w-8 h-6 cursor-pointer">
    </button>
</form>
 

    </div>



    <!-- ================= RIGHT SIDE ================= -->
    <div class="flex-1 ml-12">

        <!-- ===== TOP NAV ===== -->
        <div class="flex justify-between items-center">

            <!-- LOGO + SEARCH -->
            <div class="flex items-center gap-12">

                <!-- LOGO IMAGE -->
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo-raff.png') }}" 
                         class="w-12 h-12 object-contain">

                    <div>
                        <h1 class="text-2xl font-bold text-[#F59A40] leading-none">RAFF</h1>
                        <p class="text-xs tracking-widest text-gray-500">FOOD & CAKE</p>
                    </div>
                </div>

                <!-- SEARCH -->
                <input type="text"
                       class="w-[420px] h-[42px] bg-[#EDEAE7] rounded-full px-6 outline-none"
                       placeholder="">
            </div>

            <div class="flex items-center gap-6">

        <!-- NOTIF -->
        <button class="relative">
            🔔
        </button>

    <!-- PROFILE -->
    <div class="relative">
        <button id="adminProfileBtn"
            class="w-9 h-9 bg-[#F59A40] text-white rounded-full
                   flex items-center justify-center text-sm font-semibold
                   hover:scale-105 transition">
            {{ strtoupper(substr(auth()->user()->name ?? 'A',0,1)) }}
        </button>

        <!-- DROPDOWN -->
        <div id="adminProfileDropdown"
            class="hidden absolute right-0 top-full mt-3 w-44 bg-white
                   border border-gray-200 rounded-xl shadow-xl
                   overflow-hidden text-sm z-50">

            <a href="#"
               class="block px-4 py-3 hover:bg-gray-50 transition">
                👤 Akun Saya
            </a>
        </div>
    </div>

</div>

            </div>

        </div>