<x-header />

<!-- ================= HERO ================= -->
<section class="max-w-[1320px] mx-auto mt-8 px-6">
    <div class="relative h-[360px] rounded-[30px] overflow-hidden">
        <img src="{{ asset('images/banner-menu.png') }}"
             class="absolute inset-0 w-full h-full object-cover">

        <div class="relative z-10 h-full flex flex-col items-center justify-center text-center px-6">
            <img src="{{ asset('images/rc-login.png') }}"
                 class="w-[75px] mb-4 object-contain mt-6">

            <h1 class="text-white text-5xl font-extrabold">Temukan Aneka Kue</h1>
            <p class="text-white/90 text-sm mt-4">Cari menu favoritmu sekarang</p>
        </div>
    </div>
</section>

<!-- ================= FILTER ================= -->
<!-- ================= FILTER ================= -->
<section class="max-w-[1320px] mx-auto px-4 md:px-6 mt-8 md:mt-10 relative z-20">

    <div class="flex flex-col gap-4">

        <!-- TOGGLE -->
        <div class="flex items-center">

            <button id="filterToggle" type="button"
                class="
                    px-4 md:px-5
                    py-2.5
                    bg-[#F59A40]
                    text-white
                    rounded-full
                    flex items-center gap-2
                    transition hover:opacity-90
                    text-sm md:text-base
                ">

                <span>Filter</span>

                <svg id="filterArrow"
                    class="w-4 h-4 transition-transform duration-300"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 5l7 7-7 7" />
                </svg>

            </button>

        </div>

        <!-- PANEL -->
        <div id="filterPanel"
             class="
                transition-all duration-300 ease-out
                max-h-0 opacity-0 overflow-hidden
                pointer-events-none
             ">

            <form method="GET"
                  action="{{ route('menu') }}"
                  class="
                    flex flex-wrap
                    items-center
                    gap-3
                    bg-white
                    border border-gray-200
                    rounded-2xl
                    p-4
                    shadow-sm
                  ">

                <!-- ================= DROPDOWN ================= -->
                <div class="relative w-full sm:w-auto min-w-[220px]" id="kategoriDropdownWrapper">

                    <button type="button"
                        id="kategoriDropdownBtn"
                        class="
                            w-full
                            px-5 py-2.5
                            rounded-full
                            bg-gray-100
                            text-sm
                            flex items-center justify-between
                            gap-2
                            hover:bg-gray-200
                            transition
                        ">

                        <span id="kategoriSelectedText"
                            class="truncate">
                            {{ request('kategori') ? ucfirst(request('kategori')) : 'Semua kategori' }}
                        </span>

                        <svg class="w-4 h-4 transition-transform duration-200 shrink-0"
                            id="kategoriArrow"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>

                    </button>

                    <!-- MENU -->
                    <div id="kategoriDropdownMenu"
                        class="
                            absolute left-0 top-full mt-2
                            w-full sm:w-64
                            bg-white
                            border border-gray-200
                            rounded-2xl
                            shadow-xl
                            z-50
                            hidden
                            max-h-[240px]
                            overflow-y-auto
                        ">

                        <div class="py-1">

                            <button type="button"
                                class="kategori-option w-full text-left px-4 py-2 text-sm hover:bg-gray-50 transition {{ request('kategori') == '' ? 'bg-[#FFF3E8] text-[#F59A40] font-medium' : '' }}"
                                data-value="">
                                Semua kategori
                            </button>

                            @php
                                $kategoriList = [
                                    'masakan','kue','kue kering','kue basah',
                                    'gorengan','snack kecil','lauk','ayam',
                                    'ikan','daging','nasi','mie',
                                    'sayuran & sup','tumisan','sup / kuah',
                                    'kerupuk','sambal','dessert','buah',
                                    'pudding','manis','minuman','pondoka'
                                ];
                            @endphp

                            @foreach($kategoriList as $kat)
                                <button type="button"
                                    class="kategori-option w-full text-left px-4 py-2 text-sm hover:bg-gray-50 transition {{ request('kategori') == $kat ? 'bg-[#FFF3E8] text-[#F59A40] font-medium' : '' }}"
                                    data-value="{{ $kat }}">

                                    {{ ucfirst($kat) }}

                                </button>
                            @endforeach

                        </div>

                    </div>

                    <input type="hidden"
                        name="kategori"
                        id="kategoriInput"
                        value="{{ request('kategori') }}">

                </div>

                <!-- ================= FILTER BUTTONS ================= -->

                <button name="filter"
                    value="promo"
                    class="
                        px-4 py-2.5
                        bg-gray-100
                        rounded-full
                        text-sm
                        hover:bg-gray-200
                        transition
                    ">
                    Promo
                </button>

                <button name="filter"
                    value="termurah"
                    class="
                        px-4 py-2.5
                        bg-gray-100
                        rounded-full
                        text-sm
                        hover:bg-gray-200
                        transition
                    ">
                    Termurah
                </button>

                <button name="filter"
                    value="terlaris"
                    class="
                        px-4 py-2.5
                        bg-gray-100
                        rounded-full
                        text-sm
                        hover:bg-gray-200
                        transition
                    ">
                    Terlaris
                </button>

                <!-- APPLY -->
                <button type="submit"
                    class="
                        w-full sm:w-auto
                        px-5 py-2.5
                        bg-[#F59A40]
                        text-white
                        rounded-full
                        text-sm
                        hover:opacity-90
                        transition
                    ">
                    Terapkan
                </button>

            </form>

        </div>

    </div>

</section>

<script>
const filterToggle = document.getElementById('filterToggle');
const filterPanel = document.getElementById('filterPanel');
const filterArrow = document.getElementById('filterArrow');

let isOpen = false;

filterToggle.addEventListener('click', function(e) {
    e.stopPropagation();

    isOpen = !isOpen;

    if (isOpen) {
        filterPanel.classList.remove(
            'max-h-0',
            'opacity-0',
            'pointer-events-none'
        );

        filterPanel.classList.add(
            'max-h-[600px]',
            'opacity-100'
        );

        filterArrow.classList.add('rotate-90');

    } else {

        filterPanel.classList.add(
            'max-h-0',
            'opacity-0',
            'pointer-events-none'
        );

        filterPanel.classList.remove(
            'max-h-[600px]',
            'opacity-100'
        );

        filterArrow.classList.remove('rotate-90');
    }
});

// klik luar
document.addEventListener('click', function(e) {

    if (
        !filterPanel.contains(e.target) &&
        !filterToggle.contains(e.target)
    ) {

        isOpen = false;

        filterPanel.classList.add(
            'max-h-0',
            'opacity-0',
            'pointer-events-none'
        );

        filterPanel.classList.remove(
            'max-h-[600px]',
            'opacity-100'
        );

        filterArrow.classList.remove('rotate-90');
    }
});
</script>
<script>
    // KATEGORI CUSTOM DROPDOWN
    const kategoriDropdownBtn = document.getElementById('kategoriDropdownBtn');
    const kategoriDropdownMenu = document.getElementById('kategoriDropdownMenu');
    const kategoriArrow = document.getElementById('kategoriArrow');
    const kategoriSelectedText = document.getElementById('kategoriSelectedText');
    const kategoriInput = document.getElementById('kategoriInput');
    const kategoriOptions = document.querySelectorAll('.kategori-option');
    let kategoriOpen = false;

    kategoriDropdownBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        kategoriOpen = !kategoriOpen;
        if (kategoriOpen) {
            kategoriDropdownMenu.classList.remove('hidden');
            kategoriArrow.classList.add('rotate-180');
        } else {
            kategoriDropdownMenu.classList.add('hidden');
            kategoriArrow.classList.remove('rotate-180');
        }
    });

    kategoriOptions.forEach(function(option) {
        option.addEventListener('click', function(e) {
            e.stopPropagation();
            const value = this.dataset.value;
            const text = this.textContent;

            kategoriInput.value = value;
            kategoriSelectedText.textContent = text;

            // Update active state
            kategoriOptions.forEach(opt => {
                opt.classList.remove('bg-[#FFF3E8]', 'text-[#F59A40]', 'font-medium');
            });
            this.classList.add('bg-[#FFF3E8]', 'text-[#F59A40]', 'font-medium');

            // Close dropdown
            kategoriOpen = false;
            kategoriDropdownMenu.classList.add('hidden');
            kategoriArrow.classList.remove('rotate-180');
        });
    });

    // Klik luar dropdown = tutup
    document.addEventListener('click', function(e) {
        if (!kategoriDropdownMenu.contains(e.target) && !kategoriDropdownBtn.contains(e.target)) {
            kategoriOpen = false;
            kategoriDropdownMenu.classList.add('hidden');
            kategoriArrow.classList.remove('rotate-180');
        }
    });
</script>

<!-- ================= PRODUK GRID ================= -->
<section class="max-w-[1320px] mx-auto px-6 mt-12 mb-20">
    <div class="grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">

        @forelse($produk as $item)
<div class="block bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-2xl p-4
            hover:shadow-lg hover:-translate-y-1
            transition duration-300 h-full flex flex-col">

            <!-- CARD -->
            <a href="{{ route('landing.details', $item->id) }}" class="flex-1">

                <div class="h-[220px] rounded-xl overflow-hidden bg-gray-100">
                    <img src="{{ $item->foto_url }}"
                         class="w-full h-full object-cover">
                </div>

                <div class="mt-4">
                    <h3 class="text-lg font-bold text-gray-800">
                        {{ $item->nama_produk }}
                    </h3>

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
                </div>
<p class="text-xs text-gray-500 mt-1">
    🔥 {{ $item->total_terjual ?? 0 }} terjual
</p>
            </a>

            <!-- BUTTON -->
            <div class="mt-4 flex justify-end">
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
        @empty
        <div class="col-span-full text-center py-20">
            <h3 class="text-lg font-semibold">Belum ada produk tersedia</h3>
        </div>
        @endforelse

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
let modalQty = 1;
let selectedVariant = '-';

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

    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    const product = {
        id: modalProductId.value,
        name: modalProductName.textContent,
        price: Number(addToCartBtn.dataset.price), // ✅ harga sudah diskon
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
    showSuccessPopup(product);

    if (typeof updateCartCount === 'function') {
        updateCartCount();
    }
});

// ================= SUCCESS POPUP =================
closeSuccessPopupBtn.addEventListener('click', () => {
    successPopup.classList.add('hidden');
});

window.addEventListener('click', function (e) {
    if (e.target === successPopup) {
        successPopup.classList.add('hidden');
    }
});
</script>
<script>
const promos = [
    {
        image: "{{ asset('images/promo-catering-murah.jpg') }}",
        title: "Diskon 20% Semua Cake 🎂",
        desc: "Nikmati promo spesial hari ini",
        link: "#"
    },
    {
        image: "{{ asset('images/promo2.jpg') }}",
        title: "Paket Catering Hemat 🍱",
        desc: "Cocok untuk acara keluarga",
        link: "#"
    },
    {
        image: "{{ asset('images/promo3.jpg') }}",
        title: "Gratis Ongkir 🚚",
        desc: "Minimal belanja 100rb",
        link: "#"
    },
    {
        image: "{{ asset('images/promo4.jpg') }}",
        title: "Menu Favorit 🔥",
        desc: "Pilihan terbaik hari ini",
        link: "#"
    }
];

let currentPromo = 0;

function updatePromo() {
    document.getElementById('promoImage').src = promos[currentPromo].image;
    document.getElementById('promoTitle').textContent = promos[currentPromo].title;
    document.getElementById('promoDesc').textContent = promos[currentPromo].desc;
    document.getElementById('promoLink').href = promos[currentPromo].link;
}

function nextPromo() {
    currentPromo = (currentPromo + 1) % promos.length;
    updatePromo();
}

function prevPromo() {
    currentPromo = (currentPromo - 1 + promos.length) % promos.length;
    updatePromo();
}
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
</script>
<x-scripts />
