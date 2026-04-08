<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk • RAFF Food & Cake</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-[#F4F6F8] flex items-center justify-center p-4">

<div class="w-full max-w-6xl grid grid-cols-1 md:grid-cols-2 bg-white rounded-[30px] shadow-sm overflow-hidden">

    <!-- ================= LEFT SIDE ================= -->
    <section class="px-10 sm:px-14 py-14 flex flex-col items-center text-center">

        <!-- BRAND HEADER (SAMA SEPERTI FIGMA) -->
        <div class="flex items-center gap-3 mb-10">

            <!-- Logo -->
            <img src="{{ asset('images/logo-raff.png') }}"
                 alt="RC Logo"
                 class="w-12">

            <!-- Text -->
            <div class="text-left leading-tight">
                <h2 class="text-2xl font-bold text-[#F59A40] tracking-wide">
                    RAFF
                </h2>
                <p class="text-[11px] tracking-[4px] text-gray-500">
                    FOOD & CAKE
                </p>
            </div>

        </div>

        <!-- TITLE -->
        <h1 class="text-2xl sm:text-[28px] font-semibold text-gray-800 mb-3">
            Selamat datang kembali!!!
        </h1>

        <p class="text-sm text-gray-500 mb-10 max-w-sm">
            Yuk, login dulu. Biar kamu bisa pesen aneka kue dan catering tanpa ribet disini.
        </p>

        <!-- FORM -->
        <form class="space-y-4 w-full max-w-md"
              action="{{ route('login.store') }}"
              method="POST">
            @csrf

            <input id="email"
                   name="email"
                   value="{{ old('email') }}"
                   type="email"
                   placeholder="email"
                   class="w-full rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400 px-5 py-3 text-sm" />

            @error('email')
            <p class="text-xs text-red-600 -mt-2">{{ $message }}</p>
            @enderror

            <input id="password"
                   name="password"
                   type="password"
                   placeholder="password"
                   class="w-full rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400 px-5 py-3 text-sm" />

            @error('password')
            <p class="text-xs text-red-600 -mt-2">{{ $message }}</p>
            @enderror

            <div class="flex items-center text-sm text-gray-600">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="remember" class="rounded border-gray-300">
                    Ingat saya
                </label>
            </div>

            <button type="submit"
                    class="w-full rounded-full bg-orange-500 hover:bg-orange-600 text-white font-medium py-3 transition duration-200">
                Masuk
            </button>
        </form>

        <!-- Divider -->
        <div class="flex items-center gap-4 my-8 w-full max-w-md">
            <div class="flex-1 h-px bg-gray-200"></div>
            <span class="text-xs text-gray-400 whitespace-nowrap">atau masuk dengan</span>
            <div class="flex-1 h-px bg-gray-200"></div>
        </div>

        <!-- Social -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 w-full max-w-md">

    <!-- Google -->
    <a href="{{ url('auth/google') }}"
   class="flex items-center justify-center gap-3 border rounded-full py-3 bg-white hover:bg-gray-50 transition">
        <svg class="w-5 h-5" viewBox="0 0 48 48">
            <path fill="#EA4335" d="M24 9.5c3.15 0 5.94 1.08 8.16 3.2l6.1-6.1C34.63 2.6 29.74 0 24 0 14.82 0 6.73 5.3 2.69 13l7.98 6.2C12.42 13.08 17.74 9.5 24 9.5z"/>
            <path fill="#4285F4" d="M46.5 24.5c0-1.7-.15-3.33-.44-4.9H24v9.3h12.7c-.55 2.9-2.2 5.36-4.7 7.04l7.3 5.67C43.9 37.6 46.5 31.6 46.5 24.5z"/>
            <path fill="#FBBC05" d="M10.67 28.2a14.6 14.6 0 010-8.4L2.69 13a23.98 23.98 0 000 22l7.98-6.8z"/>
            <path fill="#34A853" d="M24 48c6.48 0 11.92-2.14 15.9-5.83l-7.3-5.67c-2.03 1.36-4.62 2.17-8.6 2.17-6.26 0-11.58-3.58-13.33-8.7L2.69 35C6.73 42.7 14.82 48 24 48z"/>
        </svg>
        <span class="font-medium text-sm">Google</span>
</a>

    <!-- Apple -->
    <button class="opacity-50 cursor-not-allowed flex items-center justify-center gap-3 border rounded-full py-3 bg-white hover:bg-gray-50 transition">
        <svg class="w-5 h-5 fill-black" viewBox="0 0 24 24">
            <path d="M16.365 1.43c0 1.14-.45 2.18-1.18 2.95-.77.81-2.02 1.43-3.08 1.35-.14-1.11.41-2.25 1.16-3.01.83-.83 2.17-1.47 3.1-1.29zM20.5 17.5c-.41.95-.91 1.83-1.51 2.64-.82 1.1-1.68 2.2-3.04 2.23-1.32.03-1.74-.78-3.24-.78s-1.97.75-3.2.81c-1.32.05-2.32-1.25-3.15-2.34C3.5 18.37 2 14.5 3.93 11.5c.96-1.48 2.67-2.42 4.52-2.45 1.28-.02 2.48.85 3.24.85.75 0 2.15-1.05 3.63-.9.62.02 2.35.25 3.47 1.9-.09.06-2.07 1.2-2.05 3.6.02 2.86 2.5 3.8 2.53 3.82z"/>
        </svg>
        <span class="font-medium text-sm">Apple</span>
    </button>

    <!-- X -->
    <button class="opacity-50 cursor-not-allowed flex items-center justify-center gap-3 border rounded-full py-3 bg-white hover:bg-gray-50 transition">
        <svg class="w-5 h-5 fill-black" viewBox="0 0 24 24">
            <path d="M18.244 2H21.5l-7.6 8.7L22 22h-6.8l-5.3-7-6.1 7H.5l8.1-9.3L1 2h7l4.8 6.3L18.244 2z"/>
        </svg>
        <span class="font-medium text-sm">X</span>
</button>

    <!-- Facebook -->
<a href="{{ url('auth/facebook') }}"
   class="flex items-center justify-center gap-3 border rounded-full py-3 bg-white hover:bg-gray-50 transition">
        <svg class="w-5 h-5 fill-[#1877F2]" viewBox="0 0 24 24">
            <path d="M22 12a10 10 0 10-11.5 9.87v-6.99H8v-2.88h2.5V9.41c0-2.47 1.47-3.84 3.72-3.84 1.08 0 2.21.19 2.21.19v2.43h-1.25c-1.23 0-1.61.76-1.61 1.54v1.85H16.4l-.4 2.88h-2.43v6.99A10 10 0 0022 12z"/>
        </svg>
        <span class="font-medium text-sm">Facebook</span>
</a>

</div>

    </section>


<!-- ================= RIGHT SIDE ================= -->
<section class="relative hidden md:flex items-center justify-center p-2"> <!-- p-2 memberi jarak tipis -->
    <div class="relative w-full h-full rounded-[20px] overflow-hidden">
        
        <!-- Background -->
        <img src="{{ asset('images/login-image.png') }}"
             class="absolute inset-0 w-full h-full object-cover"
             alt="Background">

        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/10"></div>

        <!-- LOGO TENGAH -->
        <div class="absolute inset-0 flex items-center justify-center">
            <img src="{{ asset('images/rc-login.png') }}"
                 alt="Logo Tengah"
                 class="w-44 drop-shadow-2xl opacity-95">
        </div>

        <!-- Glass Box -->
        <div class="absolute left-1/2 -translate-x-1/2 bottom-6 w-[379px] h-[105px]
                    bg-white/10 rounded-[23px] backdrop-blur-md
                    border border-white/20 p-4 grid place-content-center">
            <div class="text-center">
                <p class="text-white font-bold drop-shadow text-[19px] leading-[28px] mb-2">
                    Belum punya akun buat pesen?
                </p>

                <a href="{{ route('register') }}"
                   class="inline-flex items-center justify-center gap-2
                          w-[334px] h-[38px] bg-white
                          rounded-full font-bold text-[#F59A40]
                          hover:scale-105 transition duration-200">
                    Daftar Sekarang
                    <span class="text-xl">»»</span>
                </a>
            </div>
        </div>

    </div>
</section>

</div>

</body>
</html>