<x-header />

<section class="max-w-[1320px] mx-auto px-6 mt-10 mb-20">

    <!-- ================= TABLE HEADER ================= -->
    <div class="grid grid-cols-12 text-sm text-gray-500 pb-4 border-b">

        <div class="col-span-5">Produk</div>
        <div class="col-span-2 text-center">Harga per pcs</div>
        <div class="col-span-2 text-center">Kuantitas</div>
        <div class="col-span-2 text-center">Total Harga</div>
        <div class="col-span-1 text-center">Aksi</div>

    </div>


    <!-- ================= PRODUCT LIST ================= -->
    @for($i=1; $i<=4; $i++)
    <div class="grid grid-cols-12 items-center py-6 border-b">

        <!-- Produk -->
        <div class="col-span-5 flex items-center gap-4">
            <input type="checkbox"
       class="productCheckbox w-4 h-4 accent-[#F59A40]">

            <div class="w-[70px] h-[70px] bg-gray-300 rounded-xl"></div>

            <div>
                <p class="font-medium">FCC Name</p>
            </div>
        </div>

        <!-- Harga -->
        <div class="col-span-2 text-center text-sm">
            Rp x.xxx.xxx
        </div>

        <!-- Quantity -->
        <div class="col-span-2 flex justify-center">
            <div class="flex items-center gap-3">

                <button class="w-7 h-7 bg-[#F59A40]
                               text-white rounded-full text-sm">
                    -
                </button>

                <span>1</span>

                <button class="w-7 h-7 bg-[#F59A40]
                               text-white rounded-full text-sm">
                    +
                </button>

            </div>
        </div>

        <!-- Total -->
        <div class="col-span-2 text-center text-sm">
            Rp x.xxx.xxx
        </div>

        <!-- Aksi -->
        <div class="col-span-1 text-center">
            <button class="text-red-500 text-sm hover:underline">
                Hapus
            </button>
        </div>

    </div>
    @endfor


    <!-- ================= VOUCHER & TOTAL ================= -->
    <div class="mt-10 bg-white rounded-2xl border p-6">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

            <!-- Left -->
            <div class="flex items-center gap-4">

<input type="checkbox"
       id="selectAll"
       class="w-4 h-4 accent-[#F59A40]">

                <span class="text-sm">
                    Pilih semua
                </span>

                <button class="text-red-500 text-sm hover:underline">
                    Hapus
                </button>

            </div>

            <!-- Voucher -->
            <div class="flex items-center gap-4 text-sm">

                <span class="font-medium text-[#F59A40]">
                    🎟 Voucher RAFF
                </span>

                <a href="#" class="text-blue-500 text-xs hover:underline">
                    Gunakan/masukkan kode
                </a>

            </div>

            <!-- Total & Checkout -->
            <div class="flex items-center gap-6">

                <div class="text-sm">
                    Total (x produk):
                    <span class="text-[#F59A40] font-semibold text-lg">
                        Rp x.xxx.xxx
                    </span>
                </div>

                <a href="{{ route('landing.checkout') }}"
                   class="px-8 py-2 border border-[#F59A40]
                          text-[#F59A40] rounded-full
                          hover:bg-[#F59A40] hover:text-white transition">
                    Checkout
                </a>

            </div>

        </div>

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