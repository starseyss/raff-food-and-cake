<x-header />
<!-- ================= DETAIL PRODUCT SECTION ================= -->
<section class="max-w-[1320px] mx-auto px-6 mt-12">

    <div class="grid md:grid-cols-2 gap-16 items-start">

        <!-- ================= LEFT (IMAGE) ================= -->
        <div>
            <div class="w-[420px] h-[420px] bg-gray-300 rounded-[40px]">
                <!-- nanti ganti dengan image produk -->
            </div>
        </div>

        <!-- ================= RIGHT (DETAIL) ================= -->
        <div class="pt-6">

            <!-- Title -->
            <h1 class="text-[28px] font-semibold leading-[40px]">
                Title/fcc Name exc batagor ayam suramadu raksasa kalimantan
            </h1>

            <!-- Rating -->
            <div class="flex items-center gap-2 mt-3">
                <span class="text-[14px] text-gray-500">
                    Terjual 10 rb+
                </span>

                <div class="flex text-yellow-400 text-sm">
                    ★★★★★
                </div>
            </div>

            <!-- Price -->
            <h2 class="text-[28px] font-bold text-[#F59A40] mt-4">
                Rp X.XXX.XXX
                <span class="text-gray-400 text-sm font-normal">
                    /pax
                </span>
            </h2>

            <!-- Variant -->
            <div class="mt-8">
                <p class="text-[14px] mb-3">Varian</p>

                <div class="flex flex-wrap gap-3 max-w-[400px]">

                    <button class="px-6 py-2 rounded-full border border-gray-300 text-sm">
                        exp
                    </button>

                    <button class="px-6 py-2 rounded-full border border-gray-300 text-sm">
                        exp
                    </button>

                    <button class="px-6 py-2 rounded-full border border-gray-300 text-sm">
                        exp
                    </button>

                    <button class="px-6 py-2 rounded-full border border-gray-300 text-sm">
                        exp
                    </button>

                </div>
            </div>

            <!-- Quantity -->
            <div class="mt-8 flex items-center gap-6">

                <span class="text-[14px]">Kuantitas</span>

                <div class="flex items-center gap-4">

                    <button class="w-8 h-8 bg-[#F59A40] text-white rounded-full">
                        -
                    </button>

                    <span>0</span>

                    <button class="w-8 h-8 bg-[#F59A40] text-white rounded-full">
                        +
                    </button>

                </div>
            </div>

            <!-- Button -->
            <button class="mt-10 w-full py-4 border-2 border-[#F59A40]
                           text-[#F59A40] rounded-full
                           hover:bg-[#F59A40] hover:text-white transition openProductModal">
                Tambahkan ke keranjang
            </button>

        </div>

    </div>

    <!-- Divider -->
    <div class="mt-16 border-b border-gray-200"></div>

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