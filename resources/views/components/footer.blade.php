<!-- ================= PIXEL PERFECT FOOTER ================= -->
<footer class="bg-[#F59A40] text-white pt-[70px] pb-[40px]">

    <div class="max-w-[1320px] mx-auto px-6">

        <!-- TOP GRID -->
        <div class="grid md:grid-cols-2 gap-[120px]">

            <!-- ================= LEFT ================= -->
<!-- ================= LEFT ================= -->
<div class="max-w-[560px]">

    <!-- Logo -->
    <div class="flex items-center gap-4 mb-10">
        <img src="{{ asset('images/rc-login.png') }}"
             class="w-[48px] object-contain">

        <div class="leading-tight">
            <h2 class="text-[24px] font-bold tracking-wide">
                RAFF
            </h2>
            <p class="text-[11px] tracking-[0.35em] font-medium">
                FOOD & CAKE
            </p>
        </div>
    </div>


    <!-- Heading Besar -->
    <h3 class="text-[30px] font-semibold leading-[42px] mb-6">
        Gak perlu lagi langsung dateng ke tempat,
        tinggal buka hp kamu aja. Pesanan siap dianter
    </h3>


    <!-- Deskripsi -->
    <p class="text-[14px] text-white/90 mb-10 max-w-[520px]">
        Nikmatin banyaknya aneka kue dan catering dengan harga
        ekonomis di RAFF
    </p>


    <!-- Language Dropdown -->
<div class="relative w-[300px]">

    <!-- Icon Translate -->
    <img src="{{ asset('images/translate.png') }}"
         class="w-5 absolute left-5 top-1/2 -translate-y-1/2 pointer-events-none">

    <!-- Select -->
    <select class="w-full bg-white text-black text-[14px]
                   pl-12 pr-6 py-4 rounded-full
                   outline-none font-medium shadow-md
                   appearance-none">
        <option>Bahasa Indonesia</option>
        <option>English</option>
    </select>

    <!-- Arrow Custom -->
    <svg class="w-4 absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none"
         fill="none" stroke="currentColor" stroke-width="2"
         viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M19 9l-7 7-7-7"/>
    </svg>

</div>

</div>


            <!-- ================= RIGHT ================= -->
            <div class="grid grid-cols-2 gap-16">

                <!-- SHOP -->
                <div>
                    <h4 class="font-semibold mb-5 text-[15px]">Shop</h4>
                    <ul class="space-y-3 text-[13px] text-white/90">
                        <li>Menu</li>
                        <li>Cake</li>
                        <li>Catering</li>
                        <li>New Item</li>
                        <li>Terlaris</li>
                    </ul>
                </div>

                <!-- ABOUT -->
                <div>
                    <h4 class="font-semibold mb-5 text-[15px]">About</h4>
                    <ul class="space-y-3 text-[13px] text-white/90">
                        <li>Contact</li>
                        <li>Service</li>
                        <li>Outlet</li>
                        <li>Testimony</li>
                        <li>Contacts</li>
                    </ul>
                </div>

<!-- PAYMENT + SHIPPING -->
<div class="col-span-2 mt-12">

    <div class="flex gap-20 items-start">

        <!-- ================= PEMBAYARAN ================= -->
        <div>
            <p class="text-[14px] font-medium mb-4">
                Pembayaran
            </p>

            <div class="flex flex-wrap gap-3 max-w-[300px]">

                <img src="{{ asset('images/bca.png') }}"
                     class="h-[28px] bg-white rounded px-2 py-1 object-contain">

                <img src="{{ asset('images/bni.png') }}"
                     class="h-[28px] bg-white rounded px-2 py-1 object-contain">

                <img src="{{ asset('images/bri.png') }}"
                     class="h-[28px] bg-white rounded px-2 py-1 object-contain">

                <img src="{{ asset('images/mandiri.png') }}"
                     class="h-[28px] bg-white rounded px-2 py-1 object-contain">

                <img src="{{ asset('images/dana.png') }}"
                     class="h-[28px] bg-white rounded px-2 py-1 object-contain">

                <img src="{{ asset('images/gopay.png') }}"
                     class="h-[28px] bg-white rounded px-2 py-1 object-contain">

                <img src="{{ asset('images/permata.png') }}"
                     class="h-[28px] bg-white rounded px-2 py-1 object-contain">

                <img src="{{ asset('images/visa.png') }}"
                     class="h-[28px] bg-white rounded px-2 py-1 object-contain">

                <img src="{{ asset('images/seabank.png') }}"
                     class="h-[28px] bg-white rounded px-2 py-1 object-contain">

                <img src="{{ asset('images/qris.png') }}"
                     class="h-[28px] bg-white rounded px-2 py-1 object-contain">

            </div>
        </div>


        <!-- ================= PENGIRIMAN ================= -->
        <div>
            <p class="text-[14px] font-medium mb-4">
                Pengiriman
            </p>

            <div class="flex gap-3">

                <img src="{{ asset('images/gosend.png') }}"
                     class="h-[28px] bg-white rounded px-3 py-1 object-contain">

                <img src="{{ asset('images/logo-raff.png') }}"
                     class="h-[28px] bg-white rounded px-3 py-1 object-contain">
                     
            </div>
        </div>

    </div>

</div>

            </div>

        </div>


        <!-- ================= BOTTOM ================= -->
        <div class="mt-[60px]">

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 text-[12px] text-white/90">

                <div class="flex gap-10">
                    <a href="#">Kebijakan Privasi</a>
                    <a href="#">Syarat dan ketentuan</a>
                    <a href="#">Ikuti kami</a>
                </div>

                <p class="text-[11px]">
                    © 2026 RAFF | RAFF adalah merk milik UMKM pemasaran kue dan catering RAFF Food & Catering.
                </p>

            </div>

        </div>

    </div>

</footer>