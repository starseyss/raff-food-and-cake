<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verifikasi Akun • OTP</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-[#F4F6F8] flex items-center justify-center p-6">
    <div class="w-full max-w-2xl bg-white rounded-[28px] shadow-sm ring-1 ring-gray-200 p-10">
        <div class="flex flex-col items-center">
<div class="mb-5">
    <img src="{{ asset('images/otp.png') }}"
         alt="OTP Illustration"
         class="w-24 object-contain mx-auto">
</div>
            <h1 class="text-xl font-semibold text-gray-800">Verifikasi akun</h1>
            <p class="text-sm text-gray-500 mt-2 text-center max-w-md">Masukkan 4 digit kode verifikasi yang dikirim ke alamat email kamu. Setelah memverifikasi akun, kamu bisa lanjut pesan aneka kue dan catering.</p>
        </div>
        <div class="mt-8">
            <form class="flex flex-col items-center gap-6" onsubmit="return false;">
                <div class="flex gap-3">
                    <input maxlength="1" inputmode="numeric" class="w-14 h-14 rounded-2xl border border-gray-300 text-center text-lg focus:outline-none focus:ring-2 focus:ring-orange-400" />
                    <input maxlength="1" inputmode="numeric" class="w-14 h-14 rounded-2xl border border-gray-300 text-center text-lg focus:outline-none focus:ring-2 focus:ring-orange-400" />
                    <input maxlength="1" inputmode="numeric" class="w-14 h-14 rounded-2xl border border-gray-300 text-center text-lg focus:outline-none focus:ring-2 focus:ring-orange-400" />
                    <input maxlength="1" inputmode="numeric" class="w-14 h-14 rounded-2xl border border-gray-300 text-center text-lg focus:outline-none focus:ring-2 focus:ring-orange-400" />
                </div>
                <button type="button" class="w-full sm:w-80 rounded-full bg-orange-500 hover:bg-orange-600 text-white py-3 font-medium transition">Verifikasi akun</button>
            </form>
            <p class="text-center text-sm text-gray-600 mt-4">Gak nerima kode? <a class="text-orange-600 hover:underline" href="#">Kirim lagi</a></p>
        </div>
    </div>
    <script>
        const inputs = document.querySelectorAll('input[inputmode="numeric"]');
        inputs.forEach((el, idx) => {
            el.addEventListener('input', () => {
                if (el.value.length === 1 && idx < inputs.length - 1) inputs[idx + 1].focus();
            });
            el.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !el.value && idx > 0) inputs[idx - 1].focus();
            });
        });
    </script>
</body>
</html>

