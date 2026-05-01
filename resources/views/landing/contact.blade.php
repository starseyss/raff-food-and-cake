<x-header />

<section class="max-w-[1320px] mx-auto px-6 mt-12 mb-20">

    <!-- Judul -->
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-gray-800">Butuh Bantuan?</h1>
        <p class="text-gray-500 text-sm mt-2 max-w-md mx-auto">
            Isi formulir di bawah ini dan tim RAFF akan segera membantu Anda.
        </p>
    </div>

    <!-- Card Form -->
    <div class="max-w-[600px] mx-auto bg-white rounded-[30px] p-8 shadow-lg border border-gray-100">

        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-2xl text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-2xl text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('contact.send') }}" method="POST">
            @csrf

            <!-- Nama -->
            <div class="mb-5">
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                <input
                    type="text"
                    id="nama"
                    name="nama"
                    value="{{ old('nama') }}"
                    placeholder="Masukkan nama Anda"
                    class="w-full h-[50px] rounded-full border border-gray-300 px-5 text-sm outline-none focus:border-[#F59A40] focus:ring-2 focus:ring-[#F59A40]/20 transition"
                    required
                >
            </div>

            <!-- Email -->
            <div class="mb-5">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email Anda"
                    class="w-full h-[50px] rounded-full border border-gray-300 px-5 text-sm outline-none focus:border-[#F59A40] focus:ring-2 focus:ring-[#F59A40]/20 transition"
                    required
                >
            </div>

            <!-- Pesan / Keluhan -->
            <div class="mb-6">
                <label for="pesan" class="block text-sm font-medium text-gray-700 mb-2">Pesan / Keluhan</label>
                <textarea
                    id="pesan"
                    name="pesan"
                    rows="5"
                    placeholder="Jelaskan pesan atau keluhan Anda..."
                    class="w-full rounded-2xl border border-gray-300 px-5 py-4 text-sm outline-none focus:border-[#F59A40] focus:ring-2 focus:ring-[#F59A40]/20 transition resize-none"
                    required
                >{{ old('pesan') }}</textarea>
            </div>

            <!-- Tombol Kirim -->
            <button
                type="submit"
                class="w-full h-[50px] bg-[#F59A40] text-white font-medium rounded-full hover:opacity-90 transition"
            >
                Kirim Pesan
            </button>
        </form>

    </div>

</section>

<x-scripts />