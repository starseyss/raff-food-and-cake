    <x-header/>
    <main class="max-w-[1320px] mx-auto px-6 mt-10 mb-24">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

            <!-- ================= SIDEBAR ================= -->
            <aside class="md:col-span-1">
    <a href="{{ route('home') }}"
       class="text-sm text-gray-500 hover:text-[#F59A40] transition whitespace-nowrap">
        ← Kembali
    </a>
    <div class="bg-white rounded-3xl p-6 border border-gray-200">
        <!-- Profile Header -->
        <div class="flex items-center gap-4">

            <div class="w-14 h-14 bg-[#F59A40]/20 
                        text-[#F59A40] rounded-full 
                        flex items-center justify-center 
                        text-xl font-bold">
                {{ strtoupper(substr(auth()->user()->name,0,1)) }}
            </div>

            <div>
                <h2 class="font-semibold text-gray-900">
                    {{ auth()->user()->name }}
                </h2>
                <p class="text-xs text-gray-500">
                    {{ auth()->user()->email }}
                </p>
            </div>

        </div>

        <!-- Garis seperti di Figma -->
        <div class="border-t border-gray-200 my-6"></div>

        <!-- Menu -->
    <!-- Menu -->
    <ul class="space-y-4 text-sm">

        <li>
            <a href="{{ route('landing.profil') }}"
            class="flex items-center gap-3 text-gray-700 hover:text-[#F59A40] transition">
                
                <img src="{{ asset('images/profil.png') }}"
                    class="w-5 h-5 object-contain">

                <span>Profilku</span>
            </a>
        </li>

        <li>
            <a href="{{ route('pesanan') }}"
            class="flex items-center gap-3 text-gray-700 hover:text-[#F59A40] transition">
                
                <img src="{{ asset('images/order.png') }}"
                    class="w-5 h-5 object-contain">

                <span>Pesanan ku</span>
            </a>
        </li>

    </ul>

    </div>

            </aside>

            <!-- ================= CONTENT ================= -->
            <section class="md:col-span-3">

                <div class="bg-white rounded-3xl border border-gray-200 p-8 min-h-[500px]">

                    <h2 class="text-xl font-semibold mb-8">
                        Informasi Akun
                    </h2>

                    <div class="grid sm:grid-cols-2 gap-6">

                        <div>
                            <label class="text-xs text-gray-500">
                                Nama
                            </label>
                            <div class="mt-1 p-3 bg-gray-100 rounded-xl">
                                {{ auth()->user()->name }}
                            </div>
                        </div>

                        <div>
                            <label class="text-xs text-gray-500">
                                Email
                            </label>
                            <div class="mt-1 p-3 bg-gray-100 rounded-xl">
                                {{ auth()->user()->email }}
                            </div>
                        </div>



                        <div>
                            <label class="text-xs text-gray-500">
                                Bergabung Sejak
                            </label>
                            <div class="mt-1 p-3 bg-gray-100 rounded-xl">
                                {{ auth()->user()->created_at->format('d M Y') }}
                            </div>
                        </div>

                    </div>

                </div>

            </section>

        </div>

    </main>
    <x-footer />
    <x-scripts />
    </body>
    </html>

