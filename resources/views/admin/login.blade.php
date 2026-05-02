<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin • RAFF</title>
    <link rel="icon" href="/images/logo-raff.png?v=<?= time(); ?>" type="image/png">
<link rel="shortcut icon" href="/images/logo-raff.png?v=<?= time(); ?>">
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-[#F4F1EE] flex items-center justify-center p-4">

<div class="w-full max-w-md bg-white/80 backdrop-blur-sm rounded-[30px] shadow-sm p-10">

    <!-- LOGO -->
    <div class="flex items-center gap-3 mb-10 justify-center">
        <img src="{{ asset('images/rafflogo.png') }}" class="h-[60px] w-auto object-contain">
    </div>

<h1 class="text-xl font-semibold text-center mb-6">
    <span id="secretTrigger" class="cursor-pointer">Masuk</span> sebagai Admin
</h1>

    <!-- ERROR GLOBAL -->
    @if ($errors->any())
        <div class="mb-4 text-sm text-red-600 text-center">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login.store') }}" class="space-y-4">
        @csrf

        <!-- EMAIL -->
        <div>
            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   placeholder="Email admin"
                   class="w-full rounded-full border border-gray-300 px-5 py-3 text-sm
                          focus:outline-none focus:ring-2 focus:ring-[#F59A40]">
        </div>

       <!-- PASSWORD -->
<div class="relative">
    
    <input type="password"
           id="passwordInput"
           name="password"
           placeholder="Password"
           class="w-full rounded-full border border-gray-300 px-5 py-3 pr-14 text-sm
                  focus:outline-none focus:ring-2 focus:ring-[#F59A40]">

    <!-- EYE BUTTON -->
    <button type="button"
            onclick="togglePassword()"
            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition">

        <!-- EYE OPEN -->
        <svg id="eyeOpen"
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
                  d="M2.458 12C3.732 7.943 7.523 5 12 5
                     c4.478 0 8.268 2.943 9.542 7
                     -1.274 4.057-5.064 7-9.542 7
                     -4.477 0-8.268-2.943-9.542-7z" />
        </svg>

        <!-- EYE CLOSED -->
        <svg id="eyeClosed"
             xmlns="http://www.w3.org/2000/svg"
             class="h-5 w-5 hidden"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M13.875 18.825A10.05 10.05 0 0112 19
                     c-4.478 0-8.268-2.943-9.542-7
                     a9.956 9.956 0 012.293-3.95M6.223 6.223
                     A9.953 9.953 0 0112 5c4.478 0 8.268 2.943
                     9.542 7a9.97 9.97 0 01-4.132 5.411M15 12
                     a3 3 0 11-6 0 3 3 0 016 0zm6 6L3 3" />
        </svg>

    </button>

</div>

        <!-- BUTTON -->
        <button type="submit"
                class="w-full rounded-full bg-[#F59A40] text-white py-3 font-medium
                       hover:bg-orange-600 transition duration-200">
            Login Admin
        </button>
    </form>

</div>
<!-- Hidden Admin Register -->
<a href="{{ route('admin.register') }}"
   id="adminRegisterBtn"
   class="hidden fixed bottom-5 right-5 bg-orange-500 text-white px-4 py-2 rounded-full shadow-lg z-50">
    Register Admin
</a>

<script>
let clickCount = 0;
let clickTimer;

document.getElementById("secretTrigger").addEventListener("click", function() {
    clickCount++;

    clearTimeout(clickTimer);

    clickTimer = setTimeout(() => {
        clickCount = 0;
    }, 2000);

    // 10x klik kata "Masuk"
    if (clickCount >= 10) {
        document.getElementById("adminRegisterBtn").classList.remove("hidden");
        clickCount = 0;
    }
});
</script>
<script>
function togglePassword() {

    const passwordInput = document.getElementById('passwordInput');
    const eyeOpen = document.getElementById('eyeOpen');
    const eyeClosed = document.getElementById('eyeClosed');

    if (passwordInput.type === 'password') {

        passwordInput.type = 'text';

        eyeOpen.classList.add('hidden');
        eyeClosed.classList.remove('hidden');

    } else {

        passwordInput.type = 'password';

        eyeOpen.classList.remove('hidden');
        eyeClosed.classList.add('hidden');
    }
}
</script>
</body>
</html>