<!-- ================= PIXEL PERFECT FOOTER ================= -->
<footer class="bg-[#F59A40] text-white pt-12 md:pt-[70px] pb-8 md:pb-[40px]">

    <div class="max-w-[1320px] mx-auto px-4 md:px-6">

        <!-- TOP GRID -->
        <div class="grid md:grid-cols-2 gap-8 md:gap-12 lg:gap-[120px]">

            <!-- ================= LEFT ================= -->
            <div class="max-w-full md:max-w-[560px]">

                <!-- Logo -->
                <div class="flex items-center gap-3 md:gap-4 mb-6 md:mb-10">
                    <img src="{{ asset('images/rc-login.png') }}"
                         class="w-10 md:w-12 lg:w-[48px] object-contain">

                    <div class="leading-tight">
                        <h2 class="text-xl md:text-2xl font-bold tracking-wide">
                            RAFF
                        </h2>
                        <p class="text-[10px] md:text-[11px] tracking-[0.35em] font-medium">
                            FOOD & CAKE
                        </p>
                    </div>
                </div>

                <!-- Heading Besar -->
                <h3 class="text-lg md:text-xl lg:text-[30px] font-semibold leading-tight md:leading-[42px] mb-4 md:mb-6">
                    Gak perlu lagi langsung dateng ke tempat,
                    tinggal buka hp kamu aja. Pesanan siap dianter
                </h3>

                <!-- Deskripsi -->
                <p class="text-sm md:text-[14px] text-white/90 mb-6 md:mb-10 max-w-full md:max-w-[520px]">
                    Nikmatin banyaknya Aneka Kue dan catering dengan harga
                    ekonomis di RAFF
                </p>

                <!-- Language Dropdown -->
                <div class="relative w-full max-w-[300px]">

                    <!-- Icon Translate -->
                    <img src="{{ asset('images/translate.png') }}"
                         class="w-5 absolute left-4 md:left-5 top-1/2 -translate-y-1/2 pointer-events-none">

                    <!-- Select -->
                    <select class="w-full bg-white text-black text-sm
                                   pl-10 md:pl-12 pr-6 py-3 md:py-4 rounded-full
                                   outline-none font-medium shadow-md
                                   appearance-none">
                        <option>Bahasa Indonesia</option>
                        <option>English</option>
                    </select>

                    <!-- Arrow Custom -->
                    <svg class="w-4 absolute right-4 md:right-5 top-1/2 -translate-y-1/2 pointer-events-none"
                         fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
            </div>

            <!-- ================= RIGHT ================= -->
            <div class="grid grid-cols-2 gap-6 md:gap-8 lg:gap-16">

                <!-- SHOP -->
                <div>
                    <h4 class="font-semibold mb-4 md:mb-5 text-sm md:text-[15px]">Shop</h4>
                    <ul class="space-y-2 md:space-y-3 text-xs md:text-[13px] text-white/90">
                        <li>Menu</li>
                        <li>Cake</li>
                        <li>Catering</li>
                        <li>New Item</li>
                        <li>Terlaris</li>
                    </ul>
                </div>

                <!-- ABOUT -->
                <div>
                    <h4 class="font-semibold mb-4 md:mb-5 text-sm md:text-[15px]">About</h4>
                    <ul class="space-y-2 md:space-y-3 text-xs md:text-[13px] text-white/90">
                        <li>Service</li>
                        <li>Outlet</li>
                        <li>Testimony</li>
                        <li>Contacts</li>
                    </ul>
                </div>

                <!-- PAYMENT + SHIPPING -->
                <div class="col-span-2 mt-8 md:mt-12">

                    <div class="flex flex-col md:flex-row gap-6 md:gap-20 items-start">

                        <!-- ================= PEMBAYARAN ================= -->
                        <div>
                            <p class="text-sm md:text-[14px] font-medium mb-3 md:mb-4">
                                Pembayaran
                            </p>

                            <div class="flex flex-wrap gap-2 md:gap-3 max-w-[280px] md:max-w-[300px]">

                                <img src="{{ asset('images/bca.png') }}"
                                     class="h-6 md:h-7 bg-white rounded px-1 md:px-2 py-0.5 md:py-1 object-contain">

                                <img src="{{ asset('images/bni.png') }}"
                                     class="h-6 md:h-7 bg-white rounded px-1 md:px-2 py-0.5 md:py-1 object-contain">

                                <img src="{{ asset('images/bri.png') }}"
                                     class="h-6 md:h-7 bg-white rounded px-1 md:px-2 py-0.5 md:py-1 object-contain">

                                <img src="{{ asset('images/mandiri.png') }}"
                                     class="h-6 md:h-7 bg-white rounded px-1 md:px-2 py-0.5 md:py-1 object-contain">

                                <img src="{{ asset('images/dana.png') }}"
                                     class="h-6 md:h-7 bg-white rounded px-1 md:px-2 py-0.5 md:py-1 object-contain">

                                <img src="{{ asset('images/gopay.png') }}"
                                     class="h-6 md:h-7 bg-white rounded px-1 md:px-2 py-0.5 md:py-1 object-contain">

                                <img src="{{ asset('images/permata.png') }}"
                                     class="h-6 md:h-7 bg-white rounded px-1 md:px-2 py-0.5 md:py-1 object-contain">

                                <img src="{{ asset('images/visa.png') }}"
                                     class="h-6 md:h-7 bg-white rounded px-1 md:px-2 py-0.5 md:py-1 object-contain">

                                <img src="{{ asset('images/seabank.png') }}"
                                     class="h-6 md:h-7 bg-white rounded px-1 md:px-2 py-0.5 md:py-1 object-contain">

                                <img src="{{ asset('images/qris.png') }}"
                                     class="h-6 md:h-7 bg-white rounded px-1 md:px-2 py-0.5 md:py-1 object-contain">
                            </div>
                        </div>

                        <!-- ================= PENGIRIMAN ================= -->
                        <div>
                            <p class="text-sm md:text-[14px] font-medium mb-3 md:mb-4">
                                Pengiriman
                            </p>

                            <div class="flex gap-2 md:gap-3">

                                <img src="{{ asset('images/gosend.png') }}"
                                     class="h-6 md:h-7 bg-white rounded px-2 md:px-3 py-0.5 md:py-1 object-contain">

                                <img src="{{ asset('images/rafflogo.png') }}"
                                     class="h-6 md:h-7 bg-white rounded px-2 md:px-3 py-0.5 md:py-1 object-contain">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================= BOTTOM ================= -->
        <div class="mt-10 md:mt-[60px]">

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 md:gap-6 text-xs md:text-[12px] text-white/90">

                <div class="flex flex-wrap gap-4 md:gap-10">
                    <a href="{{ route('kebijakan.privasi') }}" class="hover:underline">Kebijakan Privasi</a>
                    <a href="{{ route('syarat.ketentuan') }}" class="hover:underline">Syarat dan ketentuan</a>
                    <a href="{{ route('contact') }}" class="hover:underline">Contact</a>
                </div>

                <p class="text-[10px] md:text-[11px]">
                    © 2026 RAFF | RAFF adalah merk milik UMKM pemasaran kue dan catering RAFF Food & Catering.
                </p>
            </div>
        </div>
    </div>
</footer>
