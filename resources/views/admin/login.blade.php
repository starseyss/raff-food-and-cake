<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin • RAFF</title>
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
        <div>
            <input type="password"
                   name="password"
                   placeholder="Password"
                   class="w-full rounded-full border border-gray-300 px-5 py-3 text-sm
                          focus:outline-none focus:ring-2 focus:ring-[#F59A40]">
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
</body>
</html>