<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk • RAFF Food & Cake</title>
        <link rel="icon" href="/images/rafflogo.png?v=<?= time(); ?>" type="image/png">
<link rel="shortcut icon" href="/images/rafflogo.png?v=<?= time(); ?>">
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-[#F4F6F8] flex items-center justify-center p-3 sm:p-4">

<div class="w-full max-w-6xl grid grid-cols-1 lg:grid-cols-2 bg-white/80 backdrop-blur-sm rounded-[24px] sm:rounded-[30px] shadow-sm overflow-hidden">

    <!-- ================= LEFT SIDE ================= -->
    <section class="px-5 sm:px-10 lg:px-14 py-10 sm:py-14 flex flex-col items-center text-center">

        <!-- BRAND HEADER -->
        <div class="flex items-center justify-center gap-3 mb-8 sm:mb-10">

            <!-- Logo -->
            <img src="{{ asset('images/rafflogo.png') }}"
                 id="logoTrigger"
                 class="h-[50px] sm:h-[60px] w-auto object-contain">

        </div>

        <!-- TITLE -->
        <h1 class="text-[24px] sm:text-[28px] font-semibold text-gray-800 mb-3 leading-tight">
            Selamat datang kembali!!!
        </h1>

        <p class="text-sm text-gray-500 mb-8 sm:mb-10 max-w-sm leading-relaxed">
            Yuk, login dulu. Biar kamu bisa pesen aneka kue dan catering tanpa ribet disini.
        </p>

        <!-- FORM -->
        <form class="space-y-4 w-full max-w-md"
              action="{{ route('login.store') }}"
              method="POST">
            @csrf

            <!-- EMAIL -->
            <input id="email"
                   name="email"
                   value="{{ old('email') }}"
                   type="email"
                   placeholder="email"
                   class="w-full rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400 px-5 py-3 text-sm" />

            @error('email')
            <p class="text-xs text-red-600 -mt-2 text-left">{{ $message }}</p>
            @enderror

            <!-- PASSWORD -->
            <div class="relative">
                <input id="password"
                       name="password"
                       type="password"
                       placeholder="password"
                       class="w-full rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400 px-5 py-3 pr-12 text-sm" />

                <!-- ICON MATA -->
                <button type="button"
                        id="togglePassword"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">

                    <svg id="eyeIcon"
                         xmlns="http://www.w3.org/2000/svg"
                         class="h-5 w-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 
                              9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 
                              0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>

            @error('password')
            <p class="text-xs text-red-600 -mt-2 text-left">{{ $message }}</p>
            @enderror

            <!-- BUTTON -->
            <button type="submit"
                    class="w-full rounded-full bg-orange-500 hover:bg-orange-600 text-white font-medium py-3 transition duration-200">
                Masuk
            </button>
            <!-- ================= MOBILE REGISTER ================= -->
<div class="md:hidden w-full max-w-md mx-auto mt-5 text-center">

    <a href="{{ route('register') }}"
       class="text-sm font-semibold text-[#F59A40] hover:text-orange-600 transition">
        Belum punya akun? Daftar Sekarang
    </a>

</div>
        </form>

        <!-- Divider -->
        <div class="flex items-center gap-4 my-8 w-full max-w-md">
            <div class="flex-1 h-px bg-gray-200"></div>
            <span class="text-[11px] sm:text-xs text-gray-400 whitespace-nowrap">
                atau masuk dengan
            </span>
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
            <button class="opacity-50 cursor-not-allowed flex items-center justify-center gap-3 border rounded-full py-3 bg-white">
                <svg class="w-5 h-5 fill-black" viewBox="0 0 24 24">
                    <path d="M16.365 1.43c0 1.14-.45 2.18-1.18 2.95-.77.81-2.02 1.43-3.08 1.35-.14-1.11.41-2.25 1.16-3.01.83-.83 2.17-1.47 3.1-1.29z"/>
                </svg>

                <span class="font-medium text-sm">Apple</span>
            </button>

            <!-- X -->
            <button class="opacity-50 cursor-not-allowed flex items-center justify-center gap-3 border rounded-full py-3 bg-white">
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
<section class="relative hidden md:flex items-center justify-center p-2">
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


<!-- Hidden Admin Button -->
<a href="{{ route('admin.login') }}"
   id="adminBtn"
   class="hidden fixed bottom-5 right-5 bg-black text-white px-4 py-2 rounded-full shadow-lg z-50">
    Admin
</a>

<script>
let clickCount = 0;
let clickTimer;

document.getElementById("logoTrigger").addEventListener("click", function() {
    clickCount++;

    clearTimeout(clickTimer);

    // reset kalau jeda terlalu lama
    clickTimer = setTimeout(() => {
        clickCount = 0;
    }, 2000);

    if (clickCount >= 5) {
        document.getElementById("adminBtn").classList.remove("hidden");
        clickCount = 0;
    }
});
</script>
<script>
const togglePassword = document.getElementById('togglePassword');
const passwordInput = document.getElementById('password');
const eyeIcon = document.getElementById('eyeIcon');

togglePassword.addEventListener('click', function () {
    const isPassword = passwordInput.type === 'password';

    passwordInput.type = isPassword ? 'text' : 'password';

    // Ganti icon (optional)
    eyeIcon.innerHTML = isPassword 
        ? `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                 d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 
                    0-8.268-2.943-9.542-7a9.956 9.956 0 012.223-3.592M6.18 
                    6.18A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 
                    9.542 7a9.956 9.956 0 01-4.132 5.411M15 
                    12a3 3 0 11-6 0 3 3 0 016 0zm6 6L3 3" />`
        : `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                 d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                 d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 
                    2.943 9.542 7-1.274 4.057-5.065 7-9.542 
                    7-4.477 0-8.268-2.943-9.542-7z" />`;
});
</script>
</body>
</html>