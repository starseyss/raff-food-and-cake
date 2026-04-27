<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Admin • RAFF</title>
    @vite('resources/css/app.css')
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

        <input type="text"
               name="name"
               placeholder="Nama Admin"
               class="w-full rounded-full border px-5 py-3 text-sm focus:ring-2 focus:ring-[#F59A40]">

        <input type="email"
               name="email"
               placeholder="Email Admin"
               class="w-full rounded-full border px-5 py-3 text-sm focus:ring-2 focus:ring-[#F59A40]">

        <input type="password"
               name="password"
               placeholder="Password"
               class="w-full rounded-full border px-5 py-3 text-sm focus:ring-2 focus:ring-[#F59A40]">

        <input type="password"
               name="password_confirmation"
               placeholder="Konfirmasi Password"
               class="w-full rounded-full border px-5 py-3 text-sm focus:ring-2 focus:ring-[#F59A40]">

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

</body>
</html>