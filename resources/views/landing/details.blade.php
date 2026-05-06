<x-header />

<!-- ================= DETAIL PRODUCT SECTION ================= -->
<!--
    CATATAN: Mulai dari section ini, tambahkan komentar agar mudah ditelusuri.
    Tujuan: Menampilkan semua bagian (struktur blade/html/js) dengan jelas.
-->
<section class="max-w-[1320px] mx-auto px-6 mt-12">
    <div class="grid md:grid-cols-2 gap-16 items-start">

        <!-- ================= LEFT (IMAGE) ================= -->
        <div>
            <div class="w-full max-w-[420px] h-[420px] bg-[#F4F1EE] rounded-[40px] overflow-hidden border border-[#E7E0D8]">
                <img src="{{ $produk->foto_url }}"
                     alt="{{ $produk->nama_produk }}"
                     class="w-full h-full object-cover">
            </div>
        </div>

        <!-- ================= RIGHT (DETAIL) ================= -->
        <div class="pt-6">

            <!-- Title -->
            <h1 class="text-[28px] font-semibold leading-[40px] text-gray-800">
                {{ $produk->nama_produk }}
            </h1>

<!-- Kategori & Rating -->
            <div class="flex items-center gap-4 mt-3">
                @if($produk->kategori)
                <span class="text-[14px] px-3 py-1 bg-[#FFF3E8] text-[#F59A40] rounded-full border border-[#F59A40]/20">
                    {{ $produk->kategori }}
                </span>
                @endif

                @php
                    $rating = $produk->rating ?? 0;
                    $fullStars = floor($rating);
                    $hasHalfStar = ($rating - $fullStars) >= 0.5;
                @endphp

                <div class="flex items-center gap-1">
                    <div class="flex text-yellow-400 text-sm">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $fullStars)
                                ★
                            @elseif($i == $fullStars + 1 && $hasHalfStar)
                                ★
                            @else
                                <span class="text-gray-300">★</span>
                            @endif
                        @endfor
                    </div>
                    @if($rating > 0)
                    <span class="text-[14px] text-gray-500">
                        ({{ number_format($rating, 1) }})
                    </span>
                    @endif
                </div>
            </div>

            <!-- Price -->
@php
    $hargaAsli = $produk->harga;
    $diskon = $produk->diskon ?? 0;
    $isPromo = $produk->is_promo ?? 0;

    $hargaDiskon = $hargaAsli;

    if ($isPromo && $diskon > 0) {
        $hargaDiskon = $hargaAsli - ($hargaAsli * $diskon / 100);
    }
@endphp

<h2 class="text-[28px] font-bold text-[#F59A40] mt-4">

    @if($isPromo && $diskon > 0)
        <span class="text-gray-400 line-through text-lg">
            Rp {{ number_format($hargaAsli, 0, ',', '.') }}
        </span>

        <br>

        <span class="text-[#F59A40] text-2xl font-bold">
            Rp {{ number_format($hargaDiskon, 0, ',', '.') }}
        </span>

        <span class="text-red-500 text-sm ml-2 font-semibold">
            -{{ $diskon }}%
        </span>
    @else
        <span>
            Rp {{ number_format($hargaAsli, 0, ',', '.') }}
        </span>
    @endif

    <span class="text-gray-400 text-sm font-normal">
        /item
    </span>
</h2>
<p class="text-xs text-gray-500 mt-1">
    🔥 {{ $produk->total_terjual ?? 0 }} terjual
</p>
            <!-- Variant -->
@if(!empty($produk->varian_array) && count($produk->varian_array) > 0)
    <div class="mt-8">
        <p class="text-[14px] mb-3 font-medium">Varian</p>

        <div class="flex flex-wrap gap-3 max-w-[500px]" id="variantContainer">
            @foreach($produk->varian_array as $index => $varian)
                <button type="button"
                        class="variant-btn px-6 py-2 rounded-full border text-sm transition
                               {{ $index == 0 ? 'border-[#F59A40] bg-[#FFF3E8] text-[#F59A40]' : 'border-gray-300 text-gray-700 hover:border-[#F59A40] hover:text-[#F59A40]' }}"
                        data-variant="{{ $varian }}">
                    {{ $varian }}
                </button>
            @endforeach
        </div>

        <p class="text-sm text-gray-500 mt-3">
            Varian dipilih:
            <span id="selectedVariantText" class="font-medium text-[#F59A40]">
                {{ $produk->varian_array[0] ?? '-' }}
            </span>
        </p>
    </div>
@endif

            <!-- Deskripsi -->
            <div class="mt-8">
                <p class="text-[14px] mb-3 font-medium">Deskripsi</p>
                <p class="text-gray-600 leading-7 text-sm max-w-[560px]">
                    {{ $produk->deskripsi ?: 'Produk ini tersedia untuk pemesanan. Silakan tambahkan ke keranjang jika ingin memesan.' }}
                </p>
            </div>

            <!-- Quantity -->
            <div class="mt-8 flex items-center gap-6">
                <span class="text-[14px] font-medium">Kuantitas</span>

                <div class="flex items-center gap-4">
                    <button id="minusQty"
                            type="button"
                            class="w-8 h-8 bg-[#F59A40] text-white rounded-full">
                        -
                    </button>

                    <span id="qtyValue">1</span>

                    <button id="plusQty"
                            type="button"
                            class="w-8 h-8 bg-[#F59A40] text-white rounded-full">
                        +
                    </button>
                </div>
            </div>

<div class="mt-10 flex gap-4">

    <!-- Tambah ke Keranjang -->
    <button type="button"
            data-id="{{ $produk->id }}"
            data-name="{{ $produk->nama_produk }}"
            data-price="{{ $produk->harga }}"
            data-is-promo="{{ $produk->is_promo ?? 0 }}"
            data-diskon="{{ $produk->diskon ?? 0 }}"
            data-image="{{ $produk->foto_url }}"
            data-description="{{ $produk->deskripsi }}"
            data-variant="{{ implode(',', $produk->varian_array ?? []) }}"
            class="w-1/2 py-4 border-2 border-[#F59A40]
                   text-[#F59A40] rounded-full
                   hover:bg-[#F59A40] hover:text-white transition open-product-modal">
        Tambahkan ke keranjang
    </button>

    <!-- Checkout -->
    <button type="button"
            onclick="checkoutNow()"
            data-id="{{ $produk->id }}"
            data-name="{{ $produk->nama_produk }}"
            data-price="{{ $produk->harga }}"
            data-is-promo="{{ $produk->is_promo ?? 0 }}"
            data-diskon="{{ $produk->diskon ?? 0 }}"
            data-image="{{ $produk->foto_url }}"
            class="w-1/2 py-4 text-center bg-[#F59A40]
                   text-white rounded-full font-medium
                   hover:bg-orange-600 transition">
        Checkout
    </button>

</div>

        </div>
    </div>

    <!-- Divider -->
    <div class="mt-16 border-b border-gray-200"></div>
</section>

<!-- ================= PRODUK LAIN ================= -->
<!--
    CATATAN TAMBAHAN:
    Di bawah ini adalah bagian rating/comment (dimunculkan sebelum produk lain) supaya semua bagian bisa terlihat jelas.
    Silakan sesuaikan teks rating bila model/atribut yang dipakai berbeda.
-->
<!-- ================= RATING COMMENT (DITAMPILKAN SEBELUM PRODUK LAIN) ================= -->
<section class="max-w-[1320px] mx-auto px-6 mt-8">
    <div class="bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-2xl p-6">
        <h2 class="text-2xl font-bold text-gray-800">Rating & Komentar</h2>
        <p class="text-sm text-gray-500 mt-1">
            Rating saat ini: {{ $produk->rating ?? 0 }}
        </p>

        <div class="mt-4 text-gray-700 text-sm leading-7">
            <!-- Jika ada relasi comments/ulasan, tampilkan di sini -->
@if(isset($produk->comments) && !empty($produk->comments))
                <div class="space-y-4">
                    @foreach($produk->comments as $c)
                        <div class="border border-gray-200 rounded-xl p-4 bg-gray-50">
                            <div class="text-gray-600 text-xs mt-1">{{ $c->created_at ?? '' }}</div>
                            <div class="mt-2">{{ $c->comment ?? '' }}</div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">Belum ada komentar untuk produk ini.</p>
            @endif
        </div>
    </div>
</section>

<section class="max-w-[1320px] mx-auto px-6 mt-12 mb-20">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Produk Lainnya</h2>
            <p class="text-sm text-gray-500 mt-1">Coba lihat produk lain yang tersedia</p>
        </div>
    </div>

<div class="grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">

@forelse($produkLain as $item)
    <div class="bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-2xl p-4
                hover:shadow-lg hover:-translate-y-1
                transition duration-300 flex flex-col justify-between">

        <!-- ================= AREA CLICK (DETAIL) ================= -->
        <a href="{{ route('landing.details', $item->id) }}" class="block">

            <div class="h-[180px] rounded-xl overflow-hidden bg-gray-100">
                <img src="{{ $item->foto_url }}"
                     alt="{{ $item->nama_produk }}"
                     class="w-full h-full object-cover">
            </div>

            <div class="mt-4">
                <h3 class="text-lg font-bold text-gray-800 line-clamp-1">
                    {{ $item->nama_produk }}
                </h3>

                <p class="text-sm text-gray-500 mt-1 line-clamp-2 min-h-[40px]">
                    {{ $item->deskripsi ?: 'Produk tersedia untuk dipesan.' }}
                </p>

                <p class="text-[#F59A40] font-bold text-lg mt-3">
                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                </p>
<p class="text-xs text-gray-500 mt-1">
    🔥 {{ $item->total_terjual ?? 0 }} terjual
</p>

                @if(!empty($item->varian_array) && count($item->varian_array) > 0)
                    <div class="flex flex-wrap gap-2 mt-3">
                        @foreach(array_slice($item->varian_array, 0, 2) as $v)
                            <span class="text-xs px-3 py-1 rounded-full bg-[#FFF3E8] text-[#F59A40] border border-[#F59A40]/20">
                                {{ $v }}
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>

        </a>

        <!-- ================= BUTTON (AMAN) ================= -->
        <div class="mt-4">
            <button type="button"
                data-id="{{ $item->id }}"
                data-name="{{ $item->nama_produk }}"
                data-price="{{ $item->harga }}"
                data-image="{{ $item->foto_url }}"
                data-description="{{ $item->deskripsi }}"
                data-variant="{{ implode(',', $item->varian_array ?? []) }}"
                data-is-promo="{{ $item->is_promo ?? 0 }}"
                data-diskon="{{ $item->diskon ?? 0 }}"
                class="w-full py-2 border-2 border-[#F59A40]
                       text-[#F59A40] rounded-full
                       hover:bg-[#F59A40] hover:text-white transition
                       open-product-modal">

                Tambahkan ke keranjang
            </button>
        </div>

    </div>
@empty
    <div class="col-span-full text-center py-16">
        <p class="text-gray-400">Belum ada produk lainnya.</p>
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

                <p id="modalProductPrice" class="text-gray-600 mt-2"></p>

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
// ================= GLOBAL =================
let qty = 1;
let modalQty = 1;
let selectedVariant = '{{ $produk->varian_array[0] ?? '' }}';
let selectedModalVariant = '-';

// ================= ELEMENT =================
const qtyValue = document.getElementById('qtyValue');
const minusQty = document.getElementById('minusQty');
const plusQty = document.getElementById('plusQty');

const productModal = document.getElementById('productModal');
const closeProductModalBtn = document.getElementById('closeProductModal');





const modalProductId = document.getElementById('modalProductId');
const modalProductName = document.getElementById('modalProductName');
const modalProductPrice = document.getElementById('modalProductPrice');
const modalProductDescription = document.getElementById('modalProductDescription');
const modalProductImage = document.getElementById('modalProductImage');
const modalSelectedVariant = document.getElementById('modalSelectedVariant');

const modalQtyValue = document.getElementById('modalQtyValue');
const modalMinusQty = document.getElementById('modalMinusQty');
const modalPlusQty = document.getElementById('modalPlusQty');

const addToCartBtn = document.getElementById('addToCartBtn');
const successPopup = document.getElementById('successPopup');
const closeSuccessPopup = document.getElementById('closeSuccessPopup');

function getImagePath(src) {
    try {
        return new URL(src).pathname;
    } catch (e) {
        return src;
    }
}

// ================= QUANTITY DETAIL =================
minusQty?.addEventListener('click', () => {
    if (qty > 1) {
        qty--;
        qtyValue.textContent = qty;
    }
});

plusQty?.addEventListener('click', () => {
    qty++;
    qtyValue.textContent = qty;
});

// ================= VARIANT DETAIL =================
const variantButtons = document.querySelectorAll('.variant-btn');
const selectedVariantText = document.getElementById('selectedVariantText');

variantButtons.forEach(btn => {
    btn.addEventListener('click', function () {
        selectedVariant = this.dataset.variant;

        selectedVariantText.textContent = selectedVariant;

        variantButtons.forEach(b => {
            b.classList.remove('border-[#F59A40]', 'bg-[#FFF3E8]', 'text-[#F59A40]');
            b.classList.add('border-gray-300', 'text-gray-700');
        });

        this.classList.add('border-[#F59A40]', 'bg-[#FFF3E8]', 'text-[#F59A40]');
    });
});

// ================= OPEN MODAL =================
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
    modalProductDescription.textContent = description || '-';
    modalProductImage.src = image;

    modalQty = qty;
    modalQtyValue.textContent = modalQty;

    // ================= HARGA FIX 🔥 =================
    let hargaAsli = Number(price) || 0;
    let hargaFinal = hargaAsli;

    if (isPromo == 1 && diskon > 0) {
        hargaFinal = hargaAsli - (hargaAsli * diskon / 100);
    }

    // simpan harga final ke tombol (INI KUNCI 🔥)
    addToCartBtn.dataset.price = Math.round(hargaFinal);

    // tampilkan harga
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

    modalProductPrice.innerHTML = htmlHarga;

    // ================= VARIAN =================
    const variantContainer = document.getElementById('modalVariantContainer');
    variantContainer.innerHTML = '';

    let variantArray = variants ? variants.split(',') : [];

    selectedModalVariant = variantArray.length ? variantArray[0].trim() : '-';
    modalSelectedVariant.textContent = selectedModalVariant;

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
            selectedModalVariant = v.trim();
            modalSelectedVariant.textContent = selectedModalVariant;

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

closeProductModalBtn?.addEventListener('click', closeProductModal);

window.addEventListener('click', function (e) {
    if (e.target === productModal) {
        closeProductModal();
    }
});

// ================= QTY MODAL =================
modalMinusQty?.addEventListener('click', () => {
    if (modalQty > 1) {
        modalQty--;
        modalQtyValue.textContent = modalQty;
    }
});

modalPlusQty?.addEventListener('click', () => {
    modalQty++;
    modalQtyValue.textContent = modalQty;
});

// ================= OPEN MODAL BUTTON =================
document.querySelectorAll('.open-product-modal').forEach(button => {
    button.addEventListener('click', function (e) {

        e.preventDefault();      // ⛔ stop link
        e.stopPropagation();     // ⛔ stop bubbling

        openProductModal(
            this.dataset.id,
            this.dataset.name,
            this.dataset.price,
            this.dataset.image,
            this.dataset.description,
            this.dataset.variant,
            this.dataset.isPromo,
            this.dataset.diskon
        );
    });
});

// ================= ADD TO CART (FIX TOTAL 🔥) =================
addToCartBtn?.addEventListener('click', () => {

    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    const product = {
        id: modalProductId.value,
        name: modalProductName.textContent,
        price: Number(addToCartBtn.dataset.price), // ✅ harga sudah diskon
        image: getImagePath(modalProductImage.src),
        qty: modalQty,
        variant: selectedModalVariant
    };

    const index = cart.findIndex(item =>
        item.id === product.id && item.variant === product.variant
    );

    if (index !== -1) {
        cart[index].qty += product.qty;
    } else {
        cart.push(product);
    }

    localStorage.setItem('cart', JSON.stringify(cart));

    closeProductModal();
    showSuccessPopup(product);

    updateCartBadge();
});

// ================= CLOSE SUCCESS =================
closeSuccessPopup?.addEventListener('click', () => {
    successPopup.classList.add('hidden');
});

window.addEventListener('click', function (e) {
    if (e.target === successPopup) {
        successPopup.classList.add('hidden');
    }
});

// ================= UPDATE BADGE =================
function updateCartBadge() {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let total = cart.reduce((sum, item) => sum + item.qty, 0);

    const badge = document.getElementById('cartCount');
    if (badge) {
        badge.textContent = total;
    }
}

// INIT
updateCartBadge();

function checkoutNow() {
    const btn = document.querySelector('button[onclick="checkoutNow()"]');

    let hargaAsli = Number(btn.dataset.price) || 0;
    let isPromo = Number(btn.dataset.isPromo) || 0;
    let diskon = Number(btn.dataset.diskon) || 0;
    let hargaFinal = hargaAsli;

    if (isPromo === 1 && diskon > 0) {
        hargaFinal = hargaAsli - (hargaAsli * diskon / 100);
    }

    const product = {
        id: btn.dataset.id,
        name: btn.dataset.name,
        price: Math.round(hargaFinal),
        image: getImagePath(btn.dataset.image),
        qty: qty,
        variant: selectedVariant || '-'
    };

    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    const index = cart.findIndex(item => item.id === product.id && item.variant === product.variant);

    if (index !== -1) {
        cart[index].qty += product.qty;
    } else {
        cart.push(product);
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    localStorage.setItem('checkoutCart', JSON.stringify([product]));

    window.location.href = "{{ route('landing.checkout') }}";
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
