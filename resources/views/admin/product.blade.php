<x-admin-header />
<style>

/* =========================
   RESPONSIVE LAYOUT
========================= */

@media (max-width: 1024px){
    .dashboard-cards{
        grid-template-columns: repeat(2, minmax(0,1fr));
    }
}

@media (max-width: 768px){

    .main-wrapper{
        margin-left:0 !important;
        padding:16px !important;
    }

    .top-header{
        flex-direction:column;
        align-items:flex-start;
        gap:16px;
    }

    .top-header button{
        width:100%;
    }

    .filter-wrapper{
        flex-direction:column;
        align-items:stretch;
        gap:14px;
    }

    .filter-left{
        width:100%;
        overflow-x:auto;
        padding-bottom:4px;
    }

    .filter-left::-webkit-scrollbar{
        height:4px;
    }

    .filter-left select{
        min-width:170px;
        flex-shrink:0;
    }

    .search-box{
        width:100% !important;
    }

    .dashboard-cards{
        grid-template-columns:1fr;
    }

    .desktop-table{
        display:none;
    }

    .mobile-card{
        display:block !important;
    }

    .product-modal-content,
    .detail-modal-content{
        width:95% !important;
        border-radius:24px;
        padding:20px;
    }

    .action-menu{
        right:0 !important;
        top:110% !important;
        transform:none !important;
    }
}

/* =========================
   DESKTOP / MOBILE
========================= */

.mobile-card{
    display:none;
}

/* =========================
   ACTION MENU
========================= */

.action-menu {
    display: none;
    position: absolute;
    top: 50%;
    right: 70%;
    transform: translateY(-50%);
    z-index: 50;
    min-width: 120px;
}

@keyframes slideSide {
    from {
        opacity: 0;
        transform: translateX(-10px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.action-container:hover .action-menu,
.action-container:focus-within .action-menu {
    display: block;
    animation: slideSide 0.2s ease-out;
}

</style>

<div class="flex-1 p-6 ml-20 main-wrapper">

    <!-- ================= HEADER ================= -->
    <div class="flex justify-between items-center mb-6 top-header">

        <div>
            <h1 class="text-2xl font-bold">
                Product Management
            </h1>

            <p class="text-sm text-gray-500">
                Manage and add new product
            </p>
        </div>

        <button onclick="openModal()"
            class="bg-[#F59A40] text-white px-5 py-3 rounded-full shadow hover:scale-[1.02] transition">
            + Add Product
        </button>

    </div>

<!-- ================= CARDS ================= -->
    <div class="grid grid-cols-4 gap-4 mb-6 dashboard-cards">

        <div class="bg-white p-5 rounded-2xl shadow-sm border border-[#EEE]">
            <p class="text-gray-400 text-sm">Total Product</p>
            <h2 class="text-2xl font-bold">{{ count($produk) }}</h2>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border border-[#EEE]">
            <p class="text-gray-400 text-sm">Active Product</p>
            <h2 class="text-2xl font-bold">{{ $activeProduct }}</h2>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border border-[#EEE]">
            <p class="text-gray-400 text-sm">Unavailable Product</p>
            <h2 class="text-2xl font-bold">{{ $unavailableProduct }}</h2>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border border-[#EEE]">
            <p class="text-gray-400 text-sm">Best Seller</p>
            <h2 class="text-2xl font-bold text-[#F59A40]">{{ $bestSeller }}</h2>
        </div>

    </div>
 <!-- ================= FILTER ================= -->
    <div class="flex justify-between items-center mb-6 filter-wrapper">

        <div class="flex gap-3 filter-left">

            <select class="bg-[#F2D7BD]/60 px-4 py-3 rounded-full text-[#F59A40]">
                <option>All Category</option>
            </select>

            <select class="bg-[#F2D7BD]/60 px-4 py-3 rounded-full text-[#F59A40]">
                <option>Availability</option>
            </select>

            <select class="bg-[#F2D7BD]/60 px-4 py-3 rounded-full text-[#F59A40]">
                <option>Price Range</option>
            </select>

        </div>

        <div class="relative w-[250px] search-box">

            <img src="/icons/search.png"
                class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 opacity-60">

            <input type="text"
                placeholder="Search Product..."
                class="pl-10 pr-4 py-3 rounded-full bg-[#F2D7BD]/60 text-[#F59A40] w-full outline-none">

        </div>

    </div>
<!-- ================= TABLE / CARD ================= -->
    <div class="bg-white rounded-3xl p-4 md:p-6 shadow-sm border border-[#EEE]">

        <!-- TITLE -->
        <h2 class="font-bold mb-5 flex items-center gap-3 text-lg">

            <img src="/images/cart-yellow.png"
                class="w-10 h-10 object-contain">

            All Product

        </h2>

        <!-- ================= DESKTOP TABLE ================= -->
        <div class="overflow-x-auto desktop-table">

            <table class="w-full text-base">

                <thead>
                    <tr class="bg-[#F2D7BD] text-gray-700">
                        <th class="p-4 text-center rounded-l-full">Picture</th>
                        <th class="p-4 text-center">Product ID</th>
                        <th class="p-4 text-left">Product Name</th>
                        <th class="p-4 text-center">Category</th>
                        <th class="p-4 text-center">Price</th>
                        <th class="p-4 text-center">Status</th>
                        <th class="p-4 rounded-r-full text-center">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($produk as $item)

                    <tr class="border-b hover:bg-[#F9F7F5] transition">

                        <td class="p-4 text-center">
                            <img src="{{ asset('image-product/' . $item->foto) }}"
                                class="w-12 h-12 rounded-xl object-cover mx-auto">
                        </td>

                        <td class="p-4 text-[#F59A40] text-center font-medium">
                            #{{ $item->product_id }}
                        </td>

                        <td class="p-4 font-medium text-left">
                            {{ $item->nama_produk }}
                        </td>

                        <td class="p-4 text-center">
                            <span class="bg-gray-100 px-3 py-1 rounded-full text-xs">
                                {{ ucfirst($item->kategori) }}
                            </span>
                        </td>

                        <td class="p-4 text-[#F59A40] font-bold text-center">
                            Rp {{ number_format($item->harga,0,',','.') }}
                        </td>

                        <td class="p-4 text-center">

                            @if($item->is_available)

                            <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-medium">
                                Available
                            </span>

                            @else

                            <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-medium">
                                Unavailable
                            </span>

                            @endif

                        </td>

                        <!-- ACTION -->
                        <td class="p-4 text-center relative">

                            <div class="action-container inline-block">

                                <button class="p-2 text-gray-400 hover:text-orange-500 transition-colors">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />

                                    </svg>

                                </button>

                                <div class="action-menu">

                                    <div class="flex flex-row gap-2 p-2 bg-white shadow-2xl rounded-2xl border border-gray-100 items-center">

                                        <!-- DETAIL -->
                                        <button onclick="openDetailModal({{ $item->id }})"
                                            class="w-10 h-10 flex items-center justify-center bg-blue-500 text-white rounded-full">

                                            👁

                                        </button>

                                        <!-- EDIT -->
                                        <a href="?edit={{ $item->id }}"
                                            class="w-10 h-10 flex items-center justify-center bg-emerald-500 text-white rounded-full">

                                            ✏️

                                        </a>

                                        <!-- DELETE -->
                                        <form method="POST"
                                            action="{{ route('produk.destroy', $item->id) }}"
                                            class="inline">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="w-10 h-10 flex items-center justify-center bg-red-500 text-white rounded-full">

                                                🗑

                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        <!-- ================= MOBILE CARD ================= -->
        <div class="space-y-4 mobile-card">

            @foreach($produk as $item)

            <div class="border border-gray-100 rounded-3xl p-4 shadow-sm">

                <div class="flex items-start gap-4">

                    <img src="{{ asset('image-product/' . $item->foto) }}"
                        class="w-20 h-20 rounded-2xl object-cover">

                    <div class="flex-1 min-w-0">

                        <div class="flex justify-between gap-3">

                            <div>

                                <h3 class="font-bold text-gray-800 line-clamp-1">
                                    {{ $item->nama_produk }}
                                </h3>

                                <p class="text-sm text-[#F59A40] font-semibold mt-1">
                                    #{{ $item->product_id }}
                                </p>

                            </div>

                            @if($item->is_available)

                            <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-[10px] h-fit">
                                Available
                            </span>

                            @else

                            <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-[10px] h-fit">
                                Unavailable
                            </span>

                            @endif

                        </div>

                        <div class="mt-3 flex items-center justify-between">

                            <span class="bg-gray-100 px-3 py-1 rounded-full text-xs">
                                {{ ucfirst($item->kategori) }}
                            </span>

                            <p class="font-bold text-[#F59A40]">
                                Rp {{ number_format($item->harga,0,',','.') }}
                            </p>

                        </div>

                        <div class="flex gap-2 mt-4">

                            <button onclick="openDetailModal({{ $item->id }})"
                                class="flex-1 bg-blue-500 text-white py-2 rounded-xl text-sm">
                                Detail
                            </button>

                            <a href="?edit={{ $item->id }}"
                                class="flex-1 bg-emerald-500 text-white py-2 rounded-xl text-sm text-center">
                                Edit
                            </a>

                            <form method="POST"
                                action="{{ route('produk.destroy', $item->id) }}"
                                class="flex-1">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="w-full bg-red-500 text-white py-2 rounded-xl text-sm">

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</div>

<!-- ================= MODAL TAMBAH/EDIT PRODUK ================= -->
<div id="productModal"
    class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center hidden z-50 p-4">

    <div class="bg-white w-[500px] max-h-[90vh] overflow-y-auto rounded-3xl p-6 relative product-modal-content">

        <button onclick="closeModal()"
            class="absolute top-4 right-4 text-xl text-gray-400 hover:text-black">
            ✕
        </button>

    <h2 class="text-xl font-bold mb-6">{{ $editMode ? 'Edit Produk' : 'Tambah Produk' }}</h2>

        <form action="{{ $editMode ? route('produk.update', $editData->id) : route('produk.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-5">

            @csrf

            @if($editMode)
                @method('PUT')
            @endif

            {{-- NAMA --}}
            <input type="text"
                   name="nama_produk"
                   value="{{ $editData->nama_produk ?? '' }}"
                   class="w-full px-4 py-3 rounded-xl border"
                   placeholder="Nama Produk"
                   required>

            {{-- HARGA --}}
            <input type="number"
                   name="harga"
                   value="{{ $editData->harga ?? '' }}"
                   class="w-full px-4 py-3 rounded-xl border"
                   placeholder="Harga"
                   required>

            {{-- KATEGORI --}}
            <select name="kategori"
                    class="w-full px-4 py-3 rounded-xl border">

                <option value="">Pilih Kategori</option>

                <option value="masakan"
                    {{ (isset($editData) && $editData->kategori == 'masakan') ? 'selected' : '' }}>
                    Masakan
                </option>

                <option value="kue kering"
                    {{ (isset($editData) && $editData->kategori == 'kue kering') ? 'selected' : '' }}>
                    Kue Kering
                </option>

                <option value="kue basah"
                    {{ (isset($editData) && $editData->kategori == 'kue basah') ? 'selected' : '' }}>
                    Kue Basah
                </option>

                <option value="ayam"
                    {{ (isset($editData) && $editData->kategori == 'ayam') ? 'selected' : '' }}>
                    Ayam
                </option>

        <option value="ikan"
            {{ (isset($editData) && $editData->kategori == 'ikan') ? 'selected' : '' }}>
            Ikan
        </option>

        <option value="daging"
            {{ (isset($editData) && $editData->kategori == 'daging') ? 'selected' : '' }}>
            Daging
        </option>

        <option value="nasi"
            {{ (isset($editData) && $editData->kategori == 'nasi') ? 'selected' : '' }}>
            Nasi
        </option>

        <option value="mie"
            {{ (isset($editData) && $editData->kategori == 'mie') ? 'selected' : '' }}>
            Mie
        </option>

        <option value="sayuran & sup"
            {{ (isset($editData) && $editData->kategori == 'sayuran & sup') ? 'selected' : '' }}>
            Sayuran & Sup
        </option>

        <option value="tumisan"
            {{ (isset($editData) && $editData->kategori == 'tumisan') ? 'selected' : '' }}>
            Tumisan
        </option>

        <option value="sup / kuah"
            {{ (isset($editData) && $editData->kategori == 'sup / kuah') ? 'selected' : '' }}>
            Sup / Kuah
        </option>

        <option value="kerupuk"
            {{ (isset($editData) && $editData->kategori == 'kerupuk') ? 'selected' : '' }}>
            Kerupuk
        </option>

        <option value="sambal"
            {{ (isset($editData) && $editData->kategori == 'sambal') ? 'selected' : '' }}>
            Sambal
        </option>

        <option value="dessert"
            {{ (isset($editData) && $editData->kategori == 'dessert') ? 'selected' : '' }}>
            Dessert
        </option>

        <option value="buah"
            {{ (isset($editData) && $editData->kategori == 'buah') ? 'selected' : '' }}>
            Buah
        </option>

        <option value="pudding"
            {{ (isset($editData) && $editData->kategori == 'pudding') ? 'selected' : '' }}>
            Pudding
        </option>

        <option value="manis"
            {{ (isset($editData) && $editData->kategori == 'manis') ? 'selected' : '' }}>
            Manis
        </option>

        <option value="minuman"
            {{ (isset($editData) && $editData->kategori == 'minuman') ? 'selected' : '' }}>
            Minuman
        </option>

        <option value="pondokan"
            {{ (isset($editData) && $editData->kategori == 'pondokan') ? 'selected' : '' }}>
            Pondokan
        </option>
    </select>

    {{-- PROMO --}}
    <label class="flex items-center gap-2">
        <input type="checkbox"
               name="is_promo"
               value="1"
               {{ (isset($editData) && $editData->is_promo) ? 'checked' : '' }}>
        Jadikan Promo
    </label>

    {{-- AVAILABILITY --}}
    <label class="flex items-center gap-2">
        <input type="checkbox"
               name="is_available"
               value="1"
               {{ (isset($editData) && $editData->is_available) ? 'checked' : '' }}
               {{ (!isset($editData)) ? 'checked' : '' }}>
        Tersedia (Available)
    </label>

    {{-- DISKON --}}
    <input type="number"
           name="diskon"
           value="{{ $editData->diskon ?? 0 }}"
           class="w-full px-4 py-3 rounded-xl border"
           placeholder="Diskon %">

    {{-- VARIAN --}}
    <div id="varian-container" class="space-y-2">

        @php
            $varians = isset($editData) ? explode(',', $editData->varian) : [''];
        @endphp

        @foreach($varians as $v)
        <div class="flex gap-2 varian-item">
            <input type="text"
                   name="varian[]"
                   value="{{ $v }}"
                   class="w-full px-4 py-3 border rounded-xl">

            <button type="button"
                    onclick="hapusVarian(this)"
                    class="bg-red-500 text-white px-3 rounded-xl">
                ✕
            </button>
        </div>
        @endforeach

    </div>

    <button type="button"
            onclick="tambahVarian()"
            class="bg-blue-500 text-white px-4 py-2 rounded-xl">
        + Tambah Varian
    </button>

    {{-- FOTO --}}
    <input type="file" name="foto" class="w-full border p-3 rounded-xl">

    {{-- DESKRIPSI --}}
    <textarea name="deskripsi"
              class="w-full px-4 py-3 rounded-xl border"
              placeholder="Deskripsi">
        {{ $editData->deskripsi ?? '' }}
    </textarea>

    {{-- BUTTON --}}
    <button type="submit"
            class="w-full bg-[#F59A40] text-white py-3 rounded-xl font-bold">

        {{ $editMode ? 'Update Produk' : 'Simpan Produk' }}

    </button>

@if($editMode)
        <a href="{{ route('admin.product') }}"
           class="block text-center mt-3 text-blue-500">
            ❌ Batal Edit
        </a>
    @endif

</form>

    </div>

</div>

<!-- ================= MODAL DETAIL PRODUK ================= -->
<div id="detailModal"
    class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center hidden z-50 p-4">

    <div class="bg-white w-[480px] max-h-[90vh] overflow-y-auto rounded-3xl p-6 relative shadow-2xl detail-modal-content">

        <!-- CLOSE -->
        <button onclick="closeDetailModal()"
            class="absolute top-4 right-4 text-xl text-gray-400 hover:text-black z-10">
            ✕
        </button>

        <h2 class="text-xl font-bold mb-5 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#F59A40]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Detail Produk
        </h2>

        <!-- IMAGE -->
        <div class="mb-5">
            <img id="detailFoto" src="" alt="Product Image"
                 class="w-full h-56 object-cover rounded-2xl border border-gray-100">
        </div>

        <!-- INFO GRID -->
        <div class="space-y-4">

            <!-- NAME -->
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wide">Nama Produk</p>
                <h3 id="detailNama" class="text-lg font-bold text-gray-800"></h3>
            </div>

            <!-- ID & CATEGORY ROW -->
            <div class="flex gap-4">
                <div class="flex-1">
                    <p class="text-xs text-gray-400 uppercase tracking-wide">Product ID</p>
                    <p id="detailProductId" class="text-sm font-semibold text-[#F59A40]"></p>
                </div>
                <div class="flex-1">
                    <p class="text-xs text-gray-400 uppercase tracking-wide">Kategori</p>
                    <span id="detailKategori" class="inline-block bg-gray-100 px-3 py-1 rounded-full text-xs mt-1"></span>
                </div>
            </div>

            <!-- PRICE -->
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wide">Harga</p>
                <div class="flex items-center gap-3">
                    <p id="detailHarga" class="text-xl font-bold text-[#F59A40]"></p>
                    <span id="detailHargaDiskon" class="text-sm text-gray-400 line-through hidden"></span>
                </div>
            </div>

            <!-- STATUS ROW -->
            <div class="flex gap-4">
                <div class="flex-1">
                    <p class="text-xs text-gray-400 uppercase tracking-wide">Status</p>
                    <span id="detailStatus" class="inline-block px-3 py-1 rounded-full text-xs font-medium mt-1"></span>
                </div>
                <div class="flex-1">
                    <p class="text-xs text-gray-400 uppercase tracking-wide">Promo</p>
                    <span id="detailPromo" class="inline-block px-3 py-1 rounded-full text-xs font-medium mt-1"></span>
                </div>
            </div>

            <!-- DISKON -->
            <div id="detailDiskonContainer" class="hidden">
                <p class="text-xs text-gray-400 uppercase tracking-wide">Diskon</p>
                <p id="detailDiskon" class="text-sm font-semibold text-red-500"></p>
            </div>

            <!-- VARIAN -->
            <div id="detailVarianContainer">
                <p class="text-xs text-gray-400 uppercase tracking-wide mb-2">Varian</p>
                <div id="detailVarian" class="flex flex-wrap gap-2"></div>
            </div>

            <!-- DESKRIPSI -->
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wide">Deskripsi</p>
                <p id="detailDeskripsi" class="text-sm text-gray-600 mt-1 leading-relaxed"></p>
            </div>

        </div>

        <!-- BUTTON CLOSE -->
        <button onclick="closeDetailModal()"
            class="w-full mt-6 bg-[#F59A40] text-white py-3 rounded-xl font-bold hover:bg-[#e88b35] transition">
            Tutup
        </button>

    </div>
</div>

@php
$productsData = $produk->map(function($p) {
    return [
        'id' => $p->id,
        'nama_produk' => $p->nama_produk,
        'product_id' => $p->product_id,
        'kategori' => $p->kategori,
        'harga' => $p->harga,
        'harga_diskon' => $p->harga_diskon,
        'foto' => asset('image-product/' . $p->foto),
        'is_available' => $p->is_available,
        'is_promo' => $p->is_promo,
        'diskon' => $p->diskon,
        'varian' => $p->varian_array,
        'deskripsi' => $p->deskripsi ?? 'Tidak ada deskripsi'
    ];
});
@endphp

<script>
// Data produk dari server
const productsData = @json($productsData);

function openDetailModal(id) {
    const product = productsData.find(p => p.id === id);
    if (!product) return;

    // Populate data
    document.getElementById('detailFoto').src = product.foto;
    document.getElementById('detailNama').textContent = product.nama_produk;
    document.getElementById('detailProductId').textContent = '#' + product.product_id;
    document.getElementById('detailKategori').textContent = product.kategori.charAt(0).toUpperCase() + product.kategori.slice(1);

    // Harga
    const hargaFormatted = 'Rp ' + product.harga.toLocaleString('id-ID');
    document.getElementById('detailHarga').textContent = hargaFormatted;

    const hargaDiskonEl = document.getElementById('detailHargaDiskon');
    if (product.is_promo && product.diskon > 0 && product.harga_diskon < product.harga) {
        hargaDiskonEl.textContent = 'Rp ' + product.harga_diskon.toLocaleString('id-ID');
        hargaDiskonEl.classList.remove('hidden');
    } else {
        hargaDiskonEl.classList.add('hidden');
    }

    // Status
    const statusEl = document.getElementById('detailStatus');
    if (product.is_available) {
        statusEl.textContent = 'Available';
        statusEl.className = 'inline-block px-3 py-1 rounded-full text-xs font-medium mt-1 bg-green-100 text-green-600';
    } else {
        statusEl.textContent = 'Unavailable';
        statusEl.className = 'inline-block px-3 py-1 rounded-full text-xs font-medium mt-1 bg-red-100 text-red-600';
    }

    // Promo
    const promoEl = document.getElementById('detailPromo');
    if (product.is_promo) {
        promoEl.textContent = 'Aktif';
        promoEl.className = 'inline-block px-3 py-1 rounded-full text-xs font-medium mt-1 bg-orange-100 text-orange-600';
    } else {
        promoEl.textContent = 'Tidak Aktif';
        promoEl.className = 'inline-block px-3 py-1 rounded-full text-xs font-medium mt-1 bg-gray-100 text-gray-500';
    }

    // Diskon
    const diskonContainer = document.getElementById('detailDiskonContainer');
    if (product.is_promo && product.diskon > 0) {
        document.getElementById('detailDiskon').textContent = product.diskon + '%';
        diskonContainer.classList.remove('hidden');
    } else {
        diskonContainer.classList.add('hidden');
    }

    // Varian
    const varianContainer = document.getElementById('detailVarian');
    varianContainer.innerHTML = '';
    if (product.varian && product.varian.length > 0) {
        product.varian.forEach(v => {
            const badge = document.createElement('span');
            badge.className = 'bg-[#F2D7BD]/60 text-[#F59A40] px-3 py-1 rounded-full text-xs font-medium';
            badge.textContent = v;
            varianContainer.appendChild(badge);
        });
        document.getElementById('detailVarianContainer').classList.remove('hidden');
    } else {
        document.getElementById('detailVarianContainer').classList.add('hidden');
    }

    // Deskripsi
    document.getElementById('detailDeskripsi').textContent = product.deskripsi;

    // Show modal
    document.getElementById('detailModal').classList.remove('hidden');
}

function closeDetailModal() {
    document.getElementById('detailModal').classList.add('hidden');
}

// Close modal on backdrop click
document.getElementById('detailModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDetailModal();
    }
});
</script>

<script>
function openModal(){
    document.getElementById('productModal').classList.remove('hidden')
}
function closeModal(){
    document.getElementById('productModal').classList.add('hidden')
}

// Auto-open modal saat edit mode
@if($editMode)
    document.addEventListener('DOMContentLoaded', function(){
        openModal()
    })
@endif
</script>
<script>
    function tambahVarian() {
        const container = document.getElementById('varian-container');

        const div = document.createElement('div');
        div.className = 'flex items-center gap-2 varian-item';

        div.innerHTML = `
            <input
                type="text"
                name="varian[]"
                placeholder="Contoh: Coklat / Keju / Large"
                class="flex-1 bg-[#F4F1EE] border border-[#DDD6CF] rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#F59A40] focus:border-[#F59A40] outline-none"
            >
            <button
                type="button"
                onclick="hapusVarian(this)"
                class="w-12 h-12 flex items-center justify-center bg-red-500 hover:bg-red-600 text-white rounded-xl transition"
            >
                ✕
            </button>
        `;
        container.appendChild(div);
    }

    function hapusVarian(button) {
        const container = document.getElementById('varian-container');
        const items = container.querySelectorAll('.varian-item');

        if (items.length > 1) {
            button.parentElement.remove();
        } else {
            button.parentElement.querySelector('input').value = '';
        }
    }
</script>

<x-scripts-admin />