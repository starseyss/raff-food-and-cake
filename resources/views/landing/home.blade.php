<x-header />

<!-- Login status for JavaScript -->
<input type="hidden" id="loginStatus" value="{{ auth()->check() ? '1' : '0' }}" />

<!-- ================= HERO ================= -->
<section class="max-w-[1320px] mx-auto mt-6 md:mt-8 px-3 md:px-6">
    <div class="relative h-[280px] md:h-[320px] lg:h-[360px] rounded-[20px] md:rounded-[30px] overflow-hidden">

        <img src="{{ asset('images/banner.png') }}"
             class="absolute inset-0 w-full h-full object-cover">

<div class="relative z-10 h-full flex flex-col items-center justify-center text-center px-4 md:px-6">
            <!-- LOGO DI ATAS JUDUL -->
            <img src="{{ asset('images/rc-login.png') }}"
                 class="w-14 md:w-16 lg:w-[75px] mb-3 md:mb-4 object-contain mt-4 md:mt-6">
            
            <h1 class="text-white text-2xl md:text-4xl lg:text-5xl font-extrabold">
                Butuh Aneka Kue & Catering?
            </h1>     
            <h1 class="text-white text-2xl md:text-4xl lg:text-5xl font-extrabold">
                Pesan di sini aja !
            </h1>

            <p class="text-white/90 text-xs md:text-sm mt-3 md:mt-4 max-w-xs md:max-w-xl">
                Dari kue harian sampai catering acara,
                semua bisa dipesan dengan gampang, pilihan lengkap, proses cepat, rasa jelas bikin puas
            </p>

            <div class="mt-4 md:mt-6 w-full max-w-[400px] md:max-w-[620px] relative">
                <input type="text"
                       placeholder="Cari paket catering atau kue..."
                       class="w-full h-10 md:h-12 lg:h-[55px] rounded-full px-4 md:px-6 pr-12 md:pr-16 outline-none text-xs md:text-sm shadow">

                <button class="absolute right-1.5 md:right-2 top-1/2 -translate-y-1/2
                               w-9 md:w-10 lg:w-11 h-9 md:h-10 lg:h-11 rounded-full bg-[#F59A40]
                               flex items-center justify-center text-white text-base md:text-lg">
                    🔍
                </button>
            </div>

        </div>
    </div>
</section>

<!-- ================= GARIS + JUDUL ================= -->
<section class="max-w-[1320px] mx-auto px-3 md:px-6 mt-10 md:mt-14 text-center">
    <div class="border-t border-gray-300 pt-8 md:pt-10">
        <h2 class="text-lg md:text-2xl font-semibold">
            Lagi cari kue atau catering di Bogor?
        </h2>

        <p class="text-gray-500 text-xs md:text-sm mt-2 md:mt-3 max-w-xs md:max-w-xl mx-auto">
            Intip berbagai pilihan Aneka Kue dan Catering andalan,
            favorit banyak orang dan siap buat segala acara.
        </p>
    </div>
</section>

<!-- ================= PRODUK GRID ================= -->
<section class="max-w-[1320px] mx-auto px-3 md:px-6 mt-8 md:mt-12 mb-12 md:mb-20">
    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-3 md:gap-6">

@foreach($produk as $index => $item)
<div class="product-card block bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl md:rounded-2xl p-2 md:p-4
            hover:shadow-lg hover:-translate-y-1
            transition duration-300 h-full flex flex-col {{ $index >= 12 ? 'hidden' : '' }}">

    <!-- Klik card ke detail -->
    <a href="{{ route('landing.details', $item->id) }}" class="flex-1">

        <!-- Gambar -->
        <div class="h-[150px] md:h-[180px] lg:h-[220px] rounded-lg md:rounded-xl overflow-hidden bg-gray-100">
            <img src="{{ $item->foto_url }}"
                 alt="{{ $item->nama_produk }}"
                 class="w-full h-full object-cover">
        </div>

        <!-- Info -->
        <div class="mt-2 md:mt-4">
            <h3 class="text-sm md:text-lg font-bold text-gray-800">
                {{ $item->nama_produk }}
            </h3>

@if($item->is_promo && $item->diskon > 0)
    <p class="text-gray-400 line-through text-xs md:text-sm">
        Rp {{ number_format($item->harga, 0, ',', '.') }}
    </p>

    <p class="text-[#F59A40] font-bold text-sm md:text-lg">
        Rp {{ number_format($item->harga_diskon, 0, ',', '.') }}
    </p>

    <span class="text-[10px] md:text-xs text-red-500 font-semibold">
        -{{ $item->diskon }}%
    </span>
@else
    <p class="text-[#F59A40] font-bold text-sm md:text-lg">
        Rp {{ number_format($item->harga, 0, ',', '.') }}
    </p>
@endif
        </div>
<p class="text-[10px] md:text-xs text-gray-500 mt-1">
    🔥 {{ $item->total_terjual ?? 0 }} terjual
</p>
<!-- ================= RATING BINTANG ================= -->
<div class="flex items-center gap-1 mt-1 text-yellow-400 text-xs md:text-sm">

    @php
        $rating = $item->rating ?? 0;
    @endphp

    @for($i = 1; $i <= 5; $i++)
        @if($i <= floor($rating))
            ★
        @else
            <span class="text-gray-300">★</span>
        @endif
    @endfor

    <span class="text-gray-500 text-[10px] md:text-xs ml-1">
        ({{ $rating }})
    </span>

</div>
    </a>

    <!-- 🔥 Tombol di luar link -->
    <div class="mt-2 md:mt-4 flex justify-end">
<button
    type="button"
    data-id="{{ $item->id }}"
    data-name="{{ $item->nama_produk }}"
    data-price="{{ $item->harga }}"
    data-image="{{ $item->foto_url }}"
    data-description="{{ $item->deskripsi }}"
    data-variant="{{ implode(',', $item->varian_array ?? []) }}"
    data-is-promo="{{ $item->is_promo ?? 0 }}"
    data-diskon="{{ $item->diskon ?? 0 }}"
    onclick="openProductModalFromButton(this)"
    class="px-3 md:px-4 py-1.5 md:py-2 text-xs md:text-sm border border-[#F59A40]
           text-[#F59A40] rounded-full
           hover:bg-[#F59A40] hover:text-white transition">
    Tambah
</button>
    </div>

</div>
        @endforeach

        @if($produk->isEmpty())
        <div class="col-span-full text-center py-20">
            <img src="{{ asset('images/box.png') }}" class="w-20 mx-auto opacity-30 mb-4">
            <h3 class="text-lg font-semibold text-gray-700">Belum ada produk tersedia</h3>
            <p class="text-sm text-gray-500 mt-2">
                Produk yang ditambahkan dari admin akan muncul di sini.
            </p>
        </div>
        @endif

    </div>
</section>

<!-- ================= TAMPILKAN SEMUA ================= -->
<section class="max-w-[1320px] mx-auto px-3 md:px-6 text-center mb-8 md:mb-12 flex justify-center gap-3 md:gap-4">
    <button id="showLessBtn" class="px-4 md:px-6 py-2 bg-gray-200 text-gray-600 text-xs md:text-sm font-medium rounded-full hover:bg-gray-300 transition hidden">
        Tampilkan sedikitkan
    </button>
    <button id="loadMoreBtn" class="px-4 md:px-6 py-2 bg-[#F59A40]/20 text-[#F59A40] text-xs md:text-sm font-medium rounded-full hover:bg-[#F59A40] hover:text-white transition {{ $produk->count() <= 12 ? 'hidden' : '' }}">
        Tampilkan selengkapnya
    </button>
</section>

<!-- ================= MASKOT + PROMO ================= -->
<!-- ================= MASKOT + PROMO ================= -->
<section class="max-w-[1320px] mx-auto px-4 md:px-6 mb-16 md:mb-24 overflow-hidden">

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-center">

        <!-- ================= MASKOT ================= -->
        <div class="lg:col-span-4 flex justify-center lg:justify-start order-2 lg:order-1">

            <img src="{{ asset('images/orang-landing.png') }}"
                 class="
                    w-[220px]
                    sm:w-[280px]
                    md:w-[340px]
                    lg:w-[420px]
                    xl:w-[500px]
                    object-contain
                    drop-shadow-xl
                 ">

        </div>

        <!-- ================= PROMO ================= -->
        <div class="lg:col-span-8 order-1 lg:order-2">

            <div class="relative select-none">

                <!-- CONTAINER -->
                <div id="promoContainer"
                     class="
                        relative
                        overflow-hidden
                        rounded-[20px]
                        md:rounded-[30px]
                        aspect-[16/10]
                        md:aspect-[16/8]
                        lg:aspect-[16/7]
                        cursor-grab
                        active:cursor-grabbing
                        shadow-xl
                     ">

                    <!-- SLIDER TRACK -->
                    <div id="promoSlider"
                         class="flex transition-transform duration-500 ease-in-out h-full">

                        <!-- ITEM 1 -->
                        <div class="min-w-full bg-[#F59A40] flex items-center justify-center">

                            <div class="text-center px-4 md:px-8">

                                <h2 class="text-white text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold leading-tight">
                                    Diskon 20% Semua Cake 🎂
                                </h2>

                                <p class="text-white/90 mt-2 text-xs sm:text-sm md:text-base">
                                    Nikmati promo spesial hari ini
                                </p>

                            </div>

                        </div>

                        <!-- ITEM 2 -->
                        <div class="min-w-full bg-orange-500 flex items-center justify-center">

                            <div class="text-center px-4 md:px-8">

                                <h2 class="text-white text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold leading-tight">
                                    Paket Catering Hemat 🍱
                                </h2>

                                <p class="text-white/90 mt-2 text-xs sm:text-sm md:text-base">
                                    Cocok untuk acara keluarga
                                </p>

                            </div>

                        </div>

                        <!-- ITEM 3 -->
                        <div class="min-w-full bg-orange-600 flex items-center justify-center">

                            <div class="text-center px-4 md:px-8">

                                <h2 class="text-white text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold leading-tight">
                                    Gratis Ongkir 🚚
                                </h2>

                                <p class="text-white/90 mt-2 text-xs sm:text-sm md:text-base">
                                    Minimal belanja 100rb
                                </p>

                            </div>

                        </div>

                        <!-- ITEM 4 -->
                        <div class="min-w-full bg-orange-700 flex items-center justify-center">

                            <div class="text-center px-4 md:px-8">

                                <h2 class="text-white text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold leading-tight">
                                    Menu Favorit 🔥
                                </h2>

                                <p class="text-white/90 mt-2 text-xs sm:text-sm md:text-base">
                                    Pilihan terbaik hari ini
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- ================= NAVIGATION ================= -->
                <div class="mt-4 md:mt-6 flex flex-col items-center gap-3">

                    <!-- BUTTONS -->
                    <div class="flex items-center gap-3 md:gap-4">

                        <button onclick="prevPromo()"
                            class="
                                w-9 h-9
                                md:w-11 md:h-11
                                rounded-full
                                bg-white
                                text-[#F59A40]
                                shadow-md
                                border border-gray-100
                                flex items-center justify-center
                                hover:bg-[#F59A40]
                                hover:text-white
                                transition
                            ">
                            ←
                        </button>

                        <button onclick="nextPromo()"
                            class="
                                w-9 h-9
                                md:w-11 md:h-11
                                rounded-full
                                bg-white
                                text-[#F59A40]
                                shadow-md
                                border border-gray-100
                                flex items-center justify-center
                                hover:bg-[#F59A40]
                                hover:text-white
                                transition
                            ">
                            →
                        </button>

                    </div>

                    <!-- DOTS -->
                    <div id="promoDots" class="flex items-center gap-2">

                        <button onclick="goToPromo(0)"
                            class="w-2.5 h-2.5 md:w-3 md:h-3 rounded-full bg-[#F59A40] transition"></button>

                        <button onclick="goToPromo(1)"
                            class="w-2.5 h-2.5 md:w-3 md:h-3 rounded-full bg-gray-300 transition"></button>

                        <button onclick="goToPromo(2)"
                            class="w-2.5 h-2.5 md:w-3 md:h-3 rounded-full bg-gray-300 transition"></button>

                        <button onclick="goToPromo(3)"
                            class="w-2.5 h-2.5 md:w-3 md:h-3 rounded-full bg-gray-300 transition"></button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- ================= 4 CARD PRODUK SEBELUM FOOTER ================= -->
<section class="max-w-[1320px] mx-auto px-6 mb-24">
    <div class="grid md:grid-cols-4 gap-6">

        @foreach($produk->take(4) as $item)
        <div class="bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-2xl p-4 flex flex-col h-full">

            <!-- Image -->
            <div class="h-[180px] rounded-xl overflow-hidden bg-gray-100">
                <img src="{{ $item->foto_url }}"
                     alt="{{ $item->nama_produk }}"
                     class="w-full h-full object-cover">
            </div>

            <!-- Text -->
            <div class="mt-4 flex-1">

@if($item->is_promo && $item->diskon > 0)
    <p class="text-gray-400 line-through text-sm">
        Rp {{ number_format($item->harga, 0, ',', '.') }}
    </p>

    <p class="text-[#F59A40] font-bold text-lg">
        Rp {{ number_format($item->harga_diskon, 0, ',', '.') }}
    </p>

    <span class="text-xs text-red-500 font-semibold">
        -{{ $item->diskon }}%
    </span>
@else
    <p class="text-[#F59A40] font-bold text-lg">
        Rp {{ number_format($item->harga, 0, ',', '.') }}
    </p>
@endif
<!-- ================= RATING ================= -->
<div class="flex items-center gap-1 mt-2 text-yellow-400 text-sm">

    @php
        $rating = $item->rating ?? 0;
    @endphp

    @for($i = 1; $i <= 5; $i++)
        @if($i <= floor($rating))
            ★
        @else
            <span class="text-gray-300">★</span>
        @endif
    @endfor

    <span class="text-gray-500 text-xs ml-1">
        ({{ $rating }})
    </span>

</div>
            </div>

            <!-- Button -->
            <div class="mt-4 mt-auto flex justify-end">
<button
    type="button"
    data-id="{{ $item->id }}"
    data-name="{{ $item->nama_produk }}"
    data-price="{{ $item->harga }}"
    data-image="{{ $item->foto_url }}"
    data-description="{{ $item->deskripsi }}"
    data-variant="{{ implode(',', $item->varian_array ?? []) }}"
    data-is-promo="{{ $item->is_promo ?? 0 }}"
    data-diskon="{{ $item->diskon ?? 0 }}"
    onclick="openProductModalFromButton(this)"
    class="px-4 py-2 text-sm border border-[#F59A40]
           text-[#F59A40] rounded-full
           hover:bg-[#F59A40] hover:text-white transition">
    Tambah
</button>
            </div>

        </div>
        @endforeach

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
                type="button"
                class="absolute top-5 right-5 text-xl font-bold">
            ✕
        </button>

        <input type="hidden" id="modalProductId">

        <div class="grid md:grid-cols-2 gap-8">

            <!-- LEFT -->
            <div>
                <h2 id="modalProductName" class="text-xl font-bold"></h2>

                <div id="modalPriceContainer"></div>

                <p id="modalProductDescription"
                   class="text-sm text-gray-500 mt-3 leading-relaxed"></p>

                <!-- ===== VARIAN ===== -->
                <div class="mt-5">
                    <p class="text-sm font-medium mb-2">Pilih Varian</p>

                    <div id="modalVariantContainer" class="flex flex-wrap gap-2"></div>

                    <p class="text-sm text-gray-500 mt-2">
                        Dipilih:
                        <span id="modalSelectedVariant" class="text-[#F59A40] font-semibold">-</span>
                    </p>
                </div>

                <!-- NOTE -->
                <div class="mt-6">
                    <h3 class="font-semibold mb-3">Custom Pesanan</h3>

                    <textarea
                        class="w-full p-3 rounded-xl border"
                        placeholder="Catatan (Opsional)"></textarea>
                </div>
            </div>

            <!-- RIGHT -->
            <div>
                <div class="h-[250px] rounded-2xl overflow-hidden bg-gray-300">
                    <img id="modalProductImage"
                         src=""
                         alt="Produk"
                         class="w-full h-full object-cover">
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <span class="text-sm">Mau berapa?</span>

                    <div class="flex items-center gap-4">
                        <button id="modalMinusQty"
                                type="button"
                                class="w-8 h-8 bg-[#F59A40] text-white rounded-full">
                            -
                        </button>

                        <span id="modalQtyValue">1</span>

                        <button id="modalPlusQty"
                                type="button"
                                class="w-8 h-8 bg-[#F59A40] text-white rounded-full">
                            +
                        </button>
                    </div>
                </div>

                <button id="addToCartBtn"
                        type="button"
                        class="mt-6 w-full py-3 bg-[#F59A40]
                               text-white rounded-full font-medium hover:opacity-90 transition">
                    Tambah ke Keranjang
                </button>
            </div>

        </div>
    </div>
</div>
<!-- ================= LOGIN REQUIRED POPUP ================= -->
<div id="loginRequiredPopup"
     class="fixed inset-0 bg-black/60 backdrop-blur-sm
            flex items-center justify-center
            z-[9999] hidden">

    <div class="bg-[#F2F2F2] w-[900px] max-w-[95%]
                rounded-[30px] p-10 relative">

        <!-- ❌ BUTTON CLOSE -->
        <button id="closeLoginRequiredPopup"
                class="absolute top-5 right-5 text-xl font-bold">
            ✕
        </button>

        <div class="grid md:grid-cols-2 gap-8 items-center">

            <!-- LEFT -->
            <div class="flex justify-center">
                <img src="{{ asset('images/keranjang.png') }}"
                     class="w-[220px] object-contain opacity-50">
            </div>

            <!-- RIGHT -->
            <div>
                <h2 class="text-xl font-semibold mb-4">
                    Login dulu ya! 👋
                </h2>

                <p class="text-sm text-gray-600 mb-6">
                    Untuk menambahkan produk ke keranjang, kamu perlu login terlebih dahulu.
                </p>

                <a href="{{ route('login') }}"
                   class="inline-block w-full text-center py-3
                          bg-[#F59A40] text-white
                          rounded-full font-medium
                          hover:opacity-90 transition">
                    Masuk / Login
                </a>

                <p class="text-xs text-gray-500 mt-4 text-center">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-[#F59A40] font-medium">
                        Daftar sekarang
                    </a>
                </p>
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

        <!-- ❌ BUTTON CLOSE -->
        <button id="closeSuccessPopup"
                class="absolute top-5 right-5 text-xl font-bold">
            ✕
        </button>

        <div class="grid md:grid-cols-2 gap-8 items-center">

            <!-- LEFT -->
            <div class="flex justify-center">
                <img src="{{ asset('images/keranjang.png') }}"
                     class="w-[220px] object-contain">
            </div>

            <!-- RIGHT -->
            <div>
                <h2 class="text-xl font-semibold mb-6">
                    Pesanan kamu berhasil dimasukkan ke keranjang.
                </h2>

                <div id="productPreview"
     class="bg-white border rounded-2xl p-4 mb-6 flex items-center gap-4">

    <!-- IMAGE -->
    <img id="previewImage"
         src=""
         class="w-20 h-20 rounded-xl object-cover">

    <!-- INFO -->
    <div class="flex-1">
        <h3 id="previewName" class="font-semibold text-gray-800">
            Nama Produk
        </h3>

        <p id="previewVariant" class="text-sm text-gray-500">
            Varian: -
        </p>

        <p id="previewPrice" class="text-[#F59A40] font-bold mt-1">
            Rp 0
        </p>
    </div>

</div>

                <a href="{{ route('landing.cart') }}"
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
<script>
// Get login status from hidden input
var isLoggedIn = document.getElementById('loginStatus').value === '1';

var modalQty = 1;
var selectedVariant = '-';

const productModal = document.getElementById('productModal');
const closeProductModalBtn = document.getElementById('closeProductModal');

const modalProductId = document.getElementById('modalProductId');
const modalProductName = document.getElementById('modalProductName');
const modalProductDescription = document.getElementById('modalProductDescription');
const modalProductImage = document.getElementById('modalProductImage');

const modalQtyValue = document.getElementById('modalQtyValue');
const modalMinusQty = document.getElementById('modalMinusQty');
const modalPlusQty = document.getElementById('modalPlusQty');

const variantContainer = document.getElementById('modalVariantContainer');
const selectedVariantText = document.getElementById('modalSelectedVariant');

const priceContainer = document.getElementById('modalPriceContainer');

const addToCartBtn = document.getElementById('addToCartBtn');
const successPopup = document.getElementById('successPopup');
const closeSuccessPopupBtn = document.getElementById('closeSuccessPopup');

function getImagePath(src) {
    try {
        return new URL(src).pathname;
    } catch (e) {
        return src;
    }
}

// ================= OPEN MODAL =================
function openProductModalFromButton(btn) {
    openProductModal(
        btn.dataset.id,
        btn.dataset.name,
        btn.dataset.price,
        btn.dataset.image,
        btn.dataset.description,
        btn.dataset.variant,
        btn.dataset.isPromo,
        btn.dataset.diskon
    );
}

function openProductModal(
    id,
    name,
    price,
    image,
    description,
    variants = '',
    isPromo = 0,
    diskon = 0
) {

    modalProductId.value = id;
    modalProductName.textContent = name;
    modalProductDescription.textContent = description || 'Produk tersedia untuk dipesan.';
    modalProductImage.src = image;

    modalQty = 1;
    modalQtyValue.textContent = modalQty;

    // ================= HARGA =================
    let hargaAsli = Number(price) || 0;
    let hargaFinal = hargaAsli;

    if (isPromo == 1 && diskon > 0) {
        hargaFinal = hargaAsli - (hargaAsli * diskon / 100);
    }

    // simpan harga final ke tombol (INI KUNCI UTAMA 🔥)
    addToCartBtn.dataset.price = Math.round(hargaFinal);

    // tampilan harga
    let htmlHarga = '';

    if (isPromo == 1 && diskon > 0) {
        htmlHarga = `
            <p class="text-gray-400 line-through text-sm">
                Rp ${hargaAsli.toLocaleString('id-ID')}
            </p>

            <p class="text-[#F59A40] font-bold text-xl">
                Rp ${Math.round(hargaFinal).toLocaleString('id-ID')}
            </p>

            <p class="text-red-500 text-sm font-semibold">
                Diskon ${diskon}%
            </p>
        `;
    } else {
        htmlHarga = `
            <p class="text-[#F59A40] font-bold text-xl">
                Rp ${hargaAsli.toLocaleString('id-ID')}
            </p>
        `;
    }

    priceContainer.innerHTML = htmlHarga;

    // ================= VARIAN =================
    variantContainer.innerHTML = '';

    let variantArray = variants ? variants.split(',') : [];

    selectedVariant = variantArray.length ? variantArray[0].trim() : '-';
    selectedVariantText.textContent = selectedVariant;

    variantArray.forEach((v, index) => {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.textContent = v.trim();

        btn.className = `px-4 py-1 rounded-full border text-sm transition ${
            index === 0
                ? 'border-[#F59A40] bg-[#FFF3E8] text-[#F59A40]'
                : 'border-gray-300 text-gray-700 hover:border-[#F59A40] hover:text-[#F59A40]'
        }`;

        btn.onclick = () => {
            selectedVariant = v.trim();
            selectedVariantText.textContent = selectedVariant;

            variantContainer.querySelectorAll('button').forEach(b => {
                b.classList.remove('border-[#F59A40]', 'bg-[#FFF3E8]', 'text-[#F59A40]');
                b.classList.add('border-gray-300', 'text-gray-700');
            });

            btn.classList.add('border-[#F59A40]', 'bg-[#FFF3E8]', 'text-[#F59A40]');
        };

        variantContainer.appendChild(btn);
    });

    productModal.classList.remove('hidden');
}

// ================= CLOSE MODAL =================
function closeProductModal() {
    productModal.classList.add('hidden');
}

closeProductModalBtn.addEventListener('click', closeProductModal);

productModal.addEventListener('click', function (e) {
    if (e.target === productModal) {
        closeProductModal();
    }
});

// ================= QTY =================
modalMinusQty.addEventListener('click', () => {
    if (modalQty > 1) {
        modalQty--;
        modalQtyValue.textContent = modalQty;
    }
});

modalPlusQty.addEventListener('click', () => {
    modalQty++;
    modalQtyValue.textContent = modalQty;
});

// ================= ADD TO CART (FIXED 🔥) =================
addToCartBtn.addEventListener('click', () => {
    // Check if user is logged in
    if (!isLoggedIn) {
        showLoginRequiredPopup();
        return;
    }

    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    const product = {
        id: modalProductId.value,
        name: modalProductName.textContent,
        price: Number(addToCartBtn.dataset.price),
        image: getImagePath(modalProductImage.src),
        qty: modalQty,
        variant: selectedVariant
    };

    const existingIndex = cart.findIndex(item =>
        item.id === product.id && item.variant === product.variant
    );

    if (existingIndex !== -1) {
        cart[existingIndex].qty += product.qty;
    } else {
        cart.push(product);
    }

    localStorage.setItem('cart', JSON.stringify(cart));

    closeProductModal();

    // 🔥 INI KUNCI NYA
    showSuccessPopup(product);

    if (typeof updateCartCount === 'function') {
        updateCartCount();
    }
});
</script>
<script>
let currentSlide = 0;
let autoPlayTimer;

function getTotalSlides() {
    return document.querySelectorAll('#promoSlider > div').length;
}

function updateSlider() {
    const slider = document.getElementById('promoSlider');
    slider.style.transform = `translateX(-${currentSlide * 100}%)`;
    updateDots();
}

function updateDots() {
    const dots = document.querySelectorAll('#promoDots > button');
    dots.forEach((dot, index) => {
        if (index === currentSlide) {
            dot.classList.remove('bg-gray-300');
            dot.classList.add('bg-[#F59A40]');
        } else {
            dot.classList.remove('bg-[#F59A40]');
            dot.classList.add('bg-gray-300');
        }
    });
}

function goToPromo(index) {
    const total = getTotalSlides();
    currentSlide = (index + total) % total;
    updateSlider();
    resetAutoPlay();
}

function nextPromo() {
    const total = getTotalSlides();
    currentSlide = (currentSlide + 1) % total;
    updateSlider();
    resetAutoPlay();
}

function prevPromo() {
    const total = getTotalSlides();
    currentSlide = (currentSlide - 1 + total) % total;
    updateSlider();
    resetAutoPlay();
}

function startAutoPlay() {
    autoPlayTimer = setInterval(() => {
        const total = getTotalSlides();
        currentSlide = (currentSlide + 1) % total;
        updateSlider();
    }, 4000);
}

function resetAutoPlay() {
    clearInterval(autoPlayTimer);
    startAutoPlay();
}

// ================= DRAG / SWIPE =================
(function () {
    const container = document.getElementById('promoContainer');
    if (!container) return;

    let startX = 0;
    let isDragging = false;
    let dragThreshold = 50;

    function handleStart(x) {
        startX = x;
        isDragging = true;
        container.classList.add('cursor-grabbing');
        container.classList.remove('cursor-grab');
    }

    function handleEnd(x) {
        if (!isDragging) return;
        isDragging = false;
        container.classList.remove('cursor-grabbing');
        container.classList.add('cursor-grab');

        const diff = startX - x;
        if (Math.abs(diff) > dragThreshold) {
            if (diff > 0) {
                nextPromo();
            } else {
                prevPromo();
            }
        }
    }

    container.addEventListener('mousedown', (e) => {
        handleStart(e.clientX);
    });

    container.addEventListener('touchstart', (e) => {
        handleStart(e.touches[0].clientX);
    }, { passive: true });

    container.addEventListener('mouseup', (e) => {
        handleEnd(e.clientX);
    });

    container.addEventListener('mouseleave', () => {
        isDragging = false;
        container.classList.remove('cursor-grabbing');
        container.classList.add('cursor-grab');
    });

    container.addEventListener('touchend', (e) => {
        handleEnd(e.changedTouches[0].clientX);
    }, { passive: true });
})();

startAutoPlay();
</script>
<script>
function showSuccessPopup(product) {
    // isi data
    document.getElementById('previewImage').src = product.image;
    document.getElementById('previewName').innerText = product.name;
    document.getElementById('previewVariant').innerText = "Varian: " + (product.variant || '-');
    document.getElementById('previewPrice').innerText = "Rp " + product.price.toLocaleString('id-ID');

    // tampilkan popup
    document.getElementById('successPopup').classList.remove('hidden');
}

// close popup
document.getElementById('closeSuccessPopup').addEventListener('click', function () {
    document.getElementById('successPopup').classList.add('hidden');
});

// ================= LOGIN CHECK =================
function showLoginRequiredPopup() {
    document.getElementById('loginRequiredPopup').classList.remove('hidden');
}

function hideLoginRequiredPopup() {
    document.getElementById('loginRequiredPopup').classList.add('hidden');
}

// Close login required popup
const loginRequiredPopup = document.getElementById('loginRequiredPopup');
const closeLoginRequiredBtn = document.getElementById('closeLoginRequiredPopup');

if (closeLoginRequiredBtn) {
    closeLoginRequiredBtn.addEventListener('click', hideLoginRequiredPopup);
}

if (loginRequiredPopup) {
    loginRequiredPopup.addEventListener('click', function (e) {
        if (e.target === loginRequiredPopup) {
            hideLoginRequiredPopup();
        }
    });
}
</script>

<script>
// ================= LOAD MORE / SHOW LESS PRODUCTS =================
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.product-card');
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    const showLessBtn = document.getElementById('showLessBtn');

    if (cards.length <= 12) {
        if (loadMoreBtn) loadMoreBtn.classList.add('hidden');
        if (showLessBtn) showLessBtn.classList.add('hidden');
        return;
    }

    let visibleCount = 12;
    const perPage = 12;
    const initialCount = 12;

    function updateButtons() {
        if (visibleCount >= cards.length) {
            loadMoreBtn.classList.add('hidden');
        } else {
            loadMoreBtn.classList.remove('hidden');
        }

        if (visibleCount > initialCount) {
            showLessBtn.classList.remove('hidden');
        } else {
            showLessBtn.classList.add('hidden');
        }
    }

    loadMoreBtn.addEventListener('click', function() {
        const nextLimit = Math.min(visibleCount + perPage, cards.length);

        for (let i = visibleCount; i < nextLimit; i++) {
            if (cards[i]) {
                cards[i].classList.remove('hidden');
            }
        }

        visibleCount = nextLimit;
        updateButtons();
    });

    showLessBtn.addEventListener('click', function() {
        const prevLimit = Math.max(visibleCount - perPage, initialCount);

        for (let i = prevLimit; i < visibleCount; i++) {
            if (cards[i]) {
                cards[i].classList.add('hidden');
            }
        }

        visibleCount = prevLimit;
        updateButtons();
    });
});
</script>

<x-scripts />
