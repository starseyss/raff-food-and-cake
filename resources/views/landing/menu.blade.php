<x-header />

<!-- ================= HERO ================= -->
<section class="max-w-[1320px] mx-auto mt-8 px-6">
    <div class="relative h-[360px] rounded-[30px] overflow-hidden">

        <img src="{{ asset('images/banner-menu.png') }}"
             class="absolute inset-0 w-full h-full object-cover">

        <div class="relative z-10 h-full flex flex-col items-center justify-center text-center px-6">

            <!-- LOGO DI ATAS JUDUL -->
            <img src="{{ asset('images/rc-login.png') }}"
                 class="w-[75px] mb-4 object-contain mt-6">

            <!-- TITLE -->
            <h1 class="text-white text-5xl font-extrabold leading-tight">
                Temukan Aneka Kue &
            </h1>
            <h1 class="text-white text-5xl font-extrabold leading-tight">
                Catering Favoritmu
            </h1>

            <!-- DESC -->
            <p class="text-white/90 text-sm mt-4 max-w-xl">
                Dari kue harian sampai catering acara,
                cek semua pilihan
            </p>
            <p class="text-white/90 text-sm max-w-xl">
                yang bisa kamu pesan sekarang.
            </p>

            <!-- SEARCH -->
            <div class="mt-6 w-full max-w-[620px] relative">
                <input type="text"
                       placeholder="Cari paket catering atau kue..."
                       class="w-full h-[55px] rounded-full px-6 pr-16 outline-none text-sm shadow">

                <button class="absolute right-2 top-1/2 -translate-y-1/2
                               w-11 h-11 rounded-full bg-[#F59A40]
                               flex items-center justify-center text-white text-lg">
                    🔍
                </button>
            </div>

        </div>
    </div>
</section>

<!-- ================= SORT BAR - FIGMA FINAL ================= -->
<section class="max-w-[1320px] mx-auto px-6 mt-14 text-center">

<div class="mt-10 border-t border-gray-300 pt-6">

    <div class="flex flex-wrap items-center gap-3">

        <!-- FILTER ICON -->
        <button class="w-10 h-10 rounded-full
                       bg-[#F2F2F2] border border-gray-200
                       flex items-center justify-center
                       shadow-sm hover:bg-gray-200 transition">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5 text-gray-600"
                 fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 4h18M6 12h12M10 20h4"/>
            </svg>

        </button>

        <!-- DROPDOWN -->
        <div class="relative">
            <select class="appearance-none px-5 pr-10 py-2 rounded-full
                           bg-[#F2F2F2] border border-gray-200
                           text-sm text-gray-700
                           shadow-sm focus:outline-none
                           hover:bg-gray-200 transition">
                <option>Jenis menu</option>
                <option>Cake</option>
                <option>Catering</option>
                <option>Snack Box</option>
            </select>

            <svg class="w-4 absolute right-3 top-1/2 -translate-y-1/2
                        pointer-events-none text-gray-500"
                 fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19 9l-7 7-7-7"/>
            </svg>
        </div>

        <!-- FILTER TAGS -->
        <button class="filterBtn px-5 py-2 rounded-full
                       bg-[#F2F2F2] border border-gray-200
                       text-sm text-gray-700 shadow-sm
                       hover:bg-gray-200 transition">
            Promo
        </button>

        <button class="filterBtn px-5 py-2 rounded-full
                       bg-[#F2F2F2] border border-gray-200
                       text-sm text-gray-700 shadow-sm
                       hover:bg-gray-200 transition">
            Termurah
        </button>

        <button class="filterBtn px-5 py-2 rounded-full
                       bg-[#F2F2F2] border border-gray-200
                       text-sm text-gray-700 shadow-sm
                       hover:bg-gray-200 transition">
            Terlaris
        </button>

        <button class="filterBtn px-5 py-2 rounded-full
                       bg-[#F2F2F2] border border-gray-200
                       text-sm text-gray-700 shadow-sm
                       hover:bg-gray-200 transition">
            Cake
        </button>

        <button class="filterBtn px-5 py-2 rounded-full
                       bg-[#F2F2F2] border border-gray-200
                       text-sm text-gray-700 shadow-sm
                       hover:bg-gray-200 transition">
            Catering
        </button>

    </div>

</div>

</section>


<!-- ================= PRODUK GRID ================= -->
<section class="max-w-[1320px] mx-auto px-6 mt-12 mb-20">

    <div class="grid md:grid-cols-4 gap-6">

        @for($i=1; $i<=40; $i++)
        <a href="{{ route('landing.details', $i) }}"
           class="block bg-white border rounded-2xl p-4
                  hover:shadow-lg hover:-translate-y-1
                  transition duration-300">

            <div class="h-[150px] bg-gray-200 rounded-xl"></div>

            <div class="mt-4 space-y-2">
                <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                <div class="h-3 bg-gray-200 rounded w-1/2"></div>
                <div class="h-3 bg-gray-200 rounded w-1/3"></div>
            </div>

            <div class="mt-4 flex justify-end">
                <button type="button"
                        onclick="event.stopPropagation(); event.preventDefault();"
                        class="px-4 py-1 text-xs border border-[#F59A40]
                               text-[#F59A40] rounded-full
                               hover:bg-[#F59A40] hover:text-white
                               transition openProductModal">
                    Tambah
                </button>
            </div>

        </a>
        @endfor

    </div>

</section>

<x-footer />

<!-- ================= MODAL PRODUK ================= -->
<div id="productModal"
     class="fixed inset-0 bg-black/60 backdrop-blur-sm
            flex items-center justify-center
            z-[9999] hidden">

    <div class="bg-[#F2F2F2] w-[900px] max-w-[95%]
                rounded-[30px] p-8 relative">

        <!-- Close -->
        <button id="closeProductModal"
                class="absolute top-5 right-5 text-xl font-bold">
            ✕
        </button>

        <div class="grid md:grid-cols-2 gap-8">

            <!-- LEFT -->
            <div>
                <h2 id="modalProductName"
                    class="text-xl font-bold">
                </h2>

                <p id="modalProductPrice"
                   class="text-gray-600 mt-2">
                </p>

                <div class="mt-6">
                    <h3 class="font-semibold mb-3">
                        Custom Pesanan
                    </h3>

                    <textarea
                        class="w-full p-3 rounded-xl border"
                        placeholder="Catatan (Opsional)">
                    </textarea>
                </div>
            </div>

            <!-- RIGHT -->
            <div>
                <div class="bg-gray-300 h-[250px] rounded-2xl"></div>

                <div class="mt-6 flex items-center justify-between">
                    <span class="text-sm">Mau berapa?</span>

                    <div class="flex items-center gap-4">
                        <button id="minusQty"
                                class="w-8 h-8 bg-[#F59A40] text-white rounded-full">
                            -
                        </button>

                        <span id="qtyValue">1</span>

                        <button id="plusQty"
                                class="w-8 h-8 bg-[#F59A40] text-white rounded-full">
                            +
                        </button>
                    </div>
                </div>

<button id="addToCartBtn"
        class="mt-6 w-full py-3 bg-[#F59A40]
               text-white rounded-full font-medium hover:opacity-90 transition">
    Tambah ke Keranjang
</button>
            </div>

        </div>
    </div>
</div>
<!-- ================= SUCCESS POPUP ================= -->
<div id="successPopup"
     class="fixed inset-0 bg-black/60 backdrop-blur-sm
            flex items-center justify-center
            z-[9999] hidden">

    <div class="bg-[#F2F2F2] w-[900px] max-w-[95%]
                rounded-[30px] p-10 relative">

        <div class="grid md:grid-cols-2 gap-8 items-center">

            <!-- ================= LEFT (ICON IMAGE) ================= -->
            <div class="flex justify-center">
                <img src="{{ asset('images/keranjang.png') }}"
                     class="w-[220px] object-contain">
            </div>


            <!-- ================= RIGHT (DETAIL) ================= -->
            <div>

                <!-- Text -->
                <h2 class="text-xl font-semibold mb-6">
                    Pesanan kamu berhasil dimasukkan ke keranjang.
                </h2>

                <!-- Detail Pesanan (sementara abu-abu) -->
                <div class="bg-gray-300 h-[120px] rounded-2xl mb-6">
                </div>

                <!-- Button -->
                <a href="#"
                   class="inline-block w-full text-center py-3
                          bg-[#F59A40] text-white
                          rounded-full font-medium
                          hover:opacity-90 transition">
                    Lihat keranjang
                </a>

            </div>

        </div>

    </div>
</div>
<x-scripts />