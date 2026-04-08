<x-header />
<form action="{{ route('landing.payment') }}" method="GET">
<!-- ================= CHECKOUT WRAPPER ================= -->
<section class="max-w-[1200px] mx-auto mt-16 mb-20 px-6">

    <div class="bg-white rounded-[30px] shadow-sm border border-gray-200 p-10">

        <!-- ================= FORM ATAS ================= -->
        <div class="grid grid-cols-2 gap-10 mb-10">

            <!-- LEFT FORM -->
            <div class="space-y-4">

                <input type="text"
                       placeholder="Nama Pemesan (default : nama akun)"
                       class="w-full h-[45px] px-5 rounded-xl border border-gray-200 outline-none focus:border-[#F59A40] text-sm">

                <input type="text"
                       placeholder="Nama Penerima"
                       class="w-full h-[45px] px-5 rounded-xl border border-gray-200 outline-none focus:border-[#F59A40] text-sm">

                <input type="text"
                       placeholder="Tanggal penerimaan"
                       class="w-full h-[45px] px-5 rounded-xl border border-gray-200 outline-none focus:border-[#F59A40] text-sm">

                <input type="text"
                       placeholder="No.Telp Aktif / Whatsapp"
                       class="w-full h-[45px] px-5 rounded-xl border border-gray-200 outline-none focus:border-[#F59A40] text-sm">

            </div>

            <!-- RIGHT ADDRESS -->
            <div>
                <textarea
                    placeholder="Alamat"
                    class="w-full h-[200px] p-5 rounded-xl border border-gray-200 outline-none focus:border-[#F59A40] text-sm resize-none">
                </textarea>
            </div>

        </div>

        <!-- ================= TABLE HEADER ================= -->
        <div class="grid grid-cols-4 text-sm text-gray-500 pb-4 border-b">
            <div>Pesanan</div>
            <div class="text-center">Harga per pax</div>
            <div class="text-center">Jumlah</div>
            <div class="text-right">Subtotal</div>
        </div>

        <!-- ================= PRODUCT LIST ================= -->
        @for($i=1; $i<=4; $i++)
        <div class="grid grid-cols-4 items-center py-5 border-b">

            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-gray-200 rounded-xl"></div>
                <p class="text-sm">FCC Name</p>
            </div>

            <div class="text-center text-sm">Rp.xxx.xxx</div>

            <div class="text-center text-sm">-</div>

            <div class="text-right text-sm">Rp.xxx.xxx</div>

        </div>
        @endfor

        <!-- ================= CATATAN + PENGIRIMAN ================= -->
        <div class="grid grid-cols-2 gap-10 mt-10">

            <!-- CATATAN -->
            <div>
                <textarea
                    placeholder="(Opsional) Tinggalkan pesan disini"
                    class="w-full h-[120px] p-5 rounded-xl border border-gray-200 outline-none focus:border-[#F59A40] text-sm resize-none">
                </textarea>
            </div>

            <!-- ================= PENGIRIMAN ================= -->
<div>

    <p class="text-sm font-medium mb-4">
        Opsi Pengiriman :
    </p>

    <div class="space-y-4">

        <!-- GOSEND -->
        <label class="cursor-pointer block">
            <input type="radio"
                   name="shipping_method"
                   value="gosend"
                   class="hidden peer">

            <div class="border rounded-xl p-4 flex items-center justify-between
                        peer-checked:border-[#F59A40]
                        peer-checked:ring-2 peer-checked:ring-[#F59A40]
                        transition">

                <div class="flex items-center gap-4">
                    <img src="{{ asset('images/gosend.png') }}"
                         class="h-8 object-contain">
                    <span class="text-sm">GoSend Instant</span>
                </div>

                <span class="text-[#F59A40] font-semibold text-sm">
                    Rp15.000
                </span>

            </div>
        </label>

        <!-- AMBIL SENDIRI -->
        <label class="cursor-pointer block">
            <input type="radio"
                   name="shipping_method"
                   value="pickup"
                   class="hidden peer">

            <div class="border rounded-xl p-4 flex items-center justify-between
                        peer-checked:border-[#F59A40]
                        peer-checked:ring-2 peer-checked:ring-[#F59A40]
                        transition">

                <div class="flex items-center gap-4">
                    <img src="{{ asset('images/logo-raff.png') }}"
                         class="h-8 object-contain">
                    <span class="text-sm">Ambil Sendiri</span>
                </div>

                <span class="text-[#F59A40] font-semibold text-sm">
                    Gratis
                </span>

            </div>
        </label>

    </div>

    <!-- TOTAL -->
    <div class="mt-6 text-right text-sm">
        Total pesanan (- Produk) :
        <span class="text-[#F59A40] font-semibold">
            Rpx.xxx.xxx
        </span>
    </div>

</div>

        </div>

<!-- ================= VOUCHER ================= -->
<div class="mt-10 border-t pt-6">

    <div class="flex justify-between items-center">

        <!-- LEFT -->
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/voucher.png') }}"
                 class="h-6 object-contain">

            <p class="font-medium text-[#F59A40]">
                Voucher RAFF
            </p>
        </div>

        <!-- RIGHT -->
        <a href="#"
           class="text-blue-500 text-xs hover:underline">
            Pilih Voucher
        </a>

    </div>

</div>

<!-- ================= METODE PEMBAYARAN ================= -->
<div class="mt-8 border-t pt-6">

    <p class="font-medium mb-4">Metode Pembayaran</p>

    <div class="grid grid-cols-4 gap-4">

        <!-- QRIS -->
        <label class="cursor-pointer">
            <input type="radio" name="payment_method" value="qris" class="hidden peer">

            <div class="border rounded-xl p-4 flex items-center justify-center
                        peer-checked:border-[#F59A40]
                        peer-checked:ring-2 peer-checked:ring-[#F59A40]
                        transition">
                <img src="{{ asset('images/qris.png') }}" class="h-8 object-contain">
            </div>
        </label>

        <!-- BCA -->
        <label class="cursor-pointer">
            <input type="radio" name="payment_method" value="bca" class="hidden peer">

            <div class="border rounded-xl p-4 flex items-center justify-center
                        peer-checked:border-[#F59A40]
                        peer-checked:ring-2 peer-checked:ring-[#F59A40]
                        transition">
                <img src="{{ asset('images/bca.png') }}" class="h-8 object-contain">
            </div>
        </label>

        <!-- BRI -->
        <label class="cursor-pointer">
            <input type="radio" name="payment_method" value="bri" class="hidden peer">

            <div class="border rounded-xl p-4 flex items-center justify-center
                        peer-checked:border-[#F59A40]
                        peer-checked:ring-2 peer-checked:ring-[#F59A40]
                        transition">
                <img src="{{ asset('images/bri.png') }}" class="h-8 object-contain">
            </div>
        </label>

        <!-- Mandiri -->
        <label class="cursor-pointer">
            <input type="radio" name="payment_method" value="mandiri" class="hidden peer">

            <div class="border rounded-xl p-4 flex items-center justify-center
                        peer-checked:border-[#F59A40]
                        peer-checked:ring-2 peer-checked:ring-[#F59A40]
                        transition">
                <img src="{{ asset('images/mandiri.png') }}" class="h-8 object-contain">
            </div>
        </label>

                <!-- SEABANK -->
        <label class="cursor-pointer">
            <input type="radio" name="payment_method" value="seabank" class="hidden peer">

            <div class="border rounded-xl p-4 flex items-center justify-center
                        peer-checked:border-[#F59A40]
                        peer-checked:ring-2 peer-checked:ring-[#F59A40]
                        transition">
                <img src="{{ asset('images/seabank.png') }}" class="h-8 object-contain">
            </div>
        </label>

        <!-- DANA -->
        <label class="cursor-pointer">
            <input type="radio" name="payment_method" value="dana" class="hidden peer">

            <div class="border rounded-xl p-4 flex items-center justify-center
                        peer-checked:border-[#F59A40]
                        peer-checked:ring-2 peer-checked:ring-[#F59A40]
                        transition">
                <img src="{{ asset('images/dana.png') }}" class="h-8 object-contain">
            </div>
        </label>

        <!-- GOPAY -->
        <label class="cursor-pointer">
            <input type="radio" name="payment_method" value="gopay" class="hidden peer">

            <div class="border rounded-xl p-4 flex items-center justify-center
                        peer-checked:border-[#F59A40]
                        peer-checked:ring-2 peer-checked:ring-[#F59A40]
                        transition">
                <img src="{{ asset('images/gopay.png') }}" class="h-8 object-contain">
            </div>
        </label>

        <!-- PERMATA BANK -->
        <label class="cursor-pointer">
            <input type="radio" name="payment_method" value="permata" class="hidden peer">

            <div class="border rounded-xl p-4 flex items-center justify-center
                        peer-checked:border-[#F59A40]
                        peer-checked:ring-2 peer-checked:ring-[#F59A40]
                        transition">
                <img src="{{ asset('images/permata.png') }}" class="h-8 object-contain">
            </div>
        </label>

                <!-- VISA -->
        <label class="cursor-pointer">
            <input type="radio" name="payment_method" value="visa" class="hidden peer">

            <div class="border rounded-xl p-4 flex items-center justify-center
                        peer-checked:border-[#F59A40]
                        peer-checked:ring-2 peer-checked:ring-[#F59A40]
                        transition">
                <img src="{{ asset('images/visa.png') }}" class="h-8 object-contain">
            </div>
        </label>

        <!-- BNI -->
        <label class="cursor-pointer">
            <input type="radio" name="payment_method" value="bni" class="hidden peer">

            <div class="border rounded-xl p-4 flex items-center justify-center
                        peer-checked:border-[#F59A40]
                        peer-checked:ring-2 peer-checked:ring-[#F59A40]
                        transition">
                <img src="{{ asset('images/BNI.png') }}" class="h-8 object-contain">
            </div>
        </label>

    </div>

</div>

        <!-- ================= TOTAL SECTION ================= -->
        <div class="mt-8 flex justify-end">

            <div class="w-[350px] space-y-2 text-sm">

                <div class="flex justify-between">
                    <span>Subtotal Pemesanan</span>
                    <span>Rpx.xxx.xxx</span>
                </div>

                <div class="flex justify-between">
                    <span>Subtotal Pengiriman</span>
                    <span>Rpx.xxx</span>
                </div>

                <div class="flex justify-between">
                    <span>Voucher</span>
                    <span>-Rpx.xxx</span>
                </div>

                <div class="flex justify-between text-lg font-semibold text-[#F59A40] pt-3">
                    <span>Total Pembayaran</span>
                    <span>Rpx.xxx.xxx</span>
                </div>

    <button type="submit"
            class="mt-6 w-full py-3 border border-[#F59A40]
                   text-[#F59A40] rounded-full
                   hover:bg-[#F59A40] hover:text-white transition">
        Buat Pesanan
    </button>

            </div>

        </div>

    </div>

</section>
</form>
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