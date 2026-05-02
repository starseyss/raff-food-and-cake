<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Admin • RAFF</title>
        <link rel="icon" href="/images/rafflogo.png?v=<?= time(); ?>" type="image/png">
<link rel="shortcut icon" href="/images/rafflogo.png?v=<?= time(); ?>">
    @vite('resources/css/app.css')

    <!-- ICON -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
</head>

<body class="min-h-screen bg-[#F4F1EE] flex items-center justify-center p-4">

<div class="w-full max-w-md bg-white/80 backdrop-blur-sm rounded-[30px] shadow-sm p-10">

    <div class="flex items-center gap-3 mb-8 justify-center">
        <img src="{{ asset('images/rafflogo.png') }}" class="h-[60px] w-auto object-contain">
    </div>

    <h1 class="text-xl font-semibold text-center mb-6">
        Buat Akun Admin
    </h1>

    @if(session('success'))
        <div class="text-green-600 text-sm text-center mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="text-red-600 text-sm text-center mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.register.store') }}" class="space-y-4">
        @csrf

        <!-- NAMA -->
        <input type="text"
               name="name"
               placeholder="Nama Admin"
               class="w-full rounded-full border px-5 py-3 text-sm focus:ring-2 focus:ring-[#F59A40] focus:outline-none">

        <!-- EMAIL -->
        <input type="email"
               name="email"
               placeholder="Email Admin"
               class="w-full rounded-full border px-5 py-3 text-sm focus:ring-2 focus:ring-[#F59A40] focus:outline-none">

        <!-- PASSWORD -->
        <div class="relative">
            <input type="password"
                   id="password"
                   name="password"
                   placeholder="Password"
                   class="w-full rounded-full border px-5 py-3 pr-12 text-sm focus:ring-2 focus:ring-[#F59A40] focus:outline-none">

            <button type="button"
                    onclick="togglePassword('password', 'eyeIcon1')"
                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                <i id="eyeIcon1" class="fa-solid fa-eye"></i>
            </button>
        </div>

        <!-- KONFIRMASI PASSWORD -->
        <div class="relative">
            <input type="password"
                   id="confirmPassword"
                   name="password_confirmation"
                   placeholder="Konfirmasi Password"
                   class="w-full rounded-full border px-5 py-3 pr-12 text-sm focus:ring-2 focus:ring-[#F59A40] focus:outline-none">

            <button type="button"
                    onclick="togglePassword('confirmPassword', 'eyeIcon2')"
                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                <i id="eyeIcon2" class="fa-solid fa-eye"></i>
            </button>
        </div>

        <!-- BUTTON -->
        <button type="submit"
                class="w-full rounded-full bg-[#F59A40] text-white py-3 font-medium hover:bg-orange-600 transition">
            Daftar Admin
        </button>
    </form>

    <p class="text-center text-sm text-gray-500 mt-6">
        Sudah punya akun?
    </p>

    <a href="/admin/login"
       class="mt-3 block w-full text-center rounded-full border border-gray-300 
              hover:bg-gray-100 text-gray-700 font-medium py-3 transition duration-200">
        Masuk ke Login Admin
    </a>

</div>

<script>
function togglePassword(inputId, iconId) {

    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
</script>

</body>
</html>