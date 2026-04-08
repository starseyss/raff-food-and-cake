<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin • RAFF</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-[#F4F1EE] flex items-center justify-center p-4">

<div class="w-full max-w-md bg-white rounded-[30px] shadow-sm p-10">

    <!-- LOGO -->
    <div class="flex items-center gap-3 mb-10 justify-center">
        <img src="{{ asset('images/logo-raff.png') }}" class="w-12">
        <div class="leading-tight">
            <h2 class="text-2xl font-bold text-[#F59A40]">RAFF</h2>
            <p class="text-[11px] tracking-[4px] text-gray-500">ADMIN PANEL</p>
        </div>
    </div>

    <h1 class="text-xl font-semibold text-center mb-6">
        Masuk sebagai Admin
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

</body>
</html>