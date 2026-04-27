<x-header />
<style>
.input-modern {
    width: 100%;
    height: 45px;
    padding: 0 16px;
    border-radius: 14px;
    border: 1px solid rgba(255,255,255,0.4);
    background: rgba(255,255,255,0.4);
    backdrop-filter: blur(10px);
    font-size: 14px;
    outline: none;
    transition: 0.3s;
}

.input-modern:focus {
    border-color: #F59A40;
    box-shadow: 0 0 0 2px rgba(245,154,64,0.2);
}
</style>
<form id="checkoutForm">
@csrf
<input type="hidden" name="cart_data" id="cartDataInput">
<!-- ================= CHECKOUT WRAPPER ================= -->
<section class="max-w-[1200px] mx-auto mt-16 mb-20 px-6">

    <div class="bg-white/80 backdrop-blur-sm rounded-[30px] shadow-sm border border-gray-200/50 p-10">

        <!-- ================= FORM ATAS ================= -->
<div class="mb-10">

    <p class="text-sm font-medium mb-3 text-gray-600">
        Alamat Pengiriman
    </p>

    <div id="alamatContainer">

        <!-- ================= DEFAULT (KOSONG) ================= -->
        <div class="border border-dashed rounded-xl p-6 text-center">

            <p class="text-sm text-gray-500 mb-3">
                📍 Belum tambah alamat
            </p>

<button type="button"
        onclick="openAlamatModal()"
        class="px-4 py-2 text-sm bg-[#F59A40] text-white rounded-full">
    Pilih Alamat
</button>
        </div>

    </div>

</div>
        <!-- ================= TABLE HEADER ================= -->
        <div class="grid grid-cols-4 text-sm text-gray-500 pb-4 border-b">
            <div>Pesanan</div>
            <div class="text-center">Harga per pax</div>
            <div class="text-center">Jumlah</div>
            <div class="text-right">Subtotal</div>
        </div>

       <div id="checkoutItems"></div>

        <!-- ================= CATATAN + PENGIRIMAN ================= -->
<div class="grid grid-cols-2 gap-10 mt-10">

    <!-- CATATAN -->
    <div>
        <textarea
            placeholder="Masukan Catatan..." name="catatan"
            class="w-full h-[200px] px-5 py-3
                   rounded-xl border border-gray-200
                   outline-none focus:border-[#F59A40]
                   text-sm resize-none
                   placeholder:text-gray-400 leading-relaxed" required></textarea>
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
                       class="hidden peer" required>

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
                        <img src="{{ asset('images/rafflogo.png') }}"
                             class="h-[50px] w-auto object-contain ml-19">
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
            Total pesanan (<span id="totalItem">0</span> Produk) :
            <span id="totalHargaAtas" class="text-[#F59A40] font-semibold">
                Rp 0
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
            <input type="radio" name="payment_method" value="qris" class="hidden peer" required>

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
                    <span id="subtotalProduk">Rp 0</span>
                </div>

                <div class="flex justify-between">
                    <span>Subtotal Pengiriman</span>
                    <span id="ongkir">Rp 0</span>
                </div>

                <div class="flex justify-between">
                    <span>Voucher</span>
                    <span id="voucher">-Rp 0</span>
                </div>

                <div class="flex justify-between text-lg font-semibold text-[#F59A40] pt-3">
                    <span>Total Pembayaran</span>
                    <span id="totalBayar">Rp 0</span>
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
<!-- ================= MODAL ALAMAT ================= -->
<div id="alamatModal"
     class="fixed inset-0 bg-black/40 backdrop-blur-md
            flex items-center justify-center z-[9999] hidden">

    <div class="w-[600px] max-w-[95%]
                rounded-[30px] p-0 overflow-hidden
                bg-white/20 backdrop-blur-xl
                border border-white/30
                shadow-[0_10px_60px_rgba(0,0,0,0.25)]">

        <!-- HEADER -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-white/20">

            <div class="flex items-center gap-3">
                <!-- SVG ICON DINAMIS -->
                <div class="w-10 h-10 flex items-center justify-center rounded-full bg-[#F59A40]/20 group">
                    <svg class="w-5 h-5 text-[#F59A40] transition group-hover:scale-110"
                         fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path d="M12 21s-6-5.686-6-10a6 6 0 1112 0c0 4.314-6 10-6 10z"/>
                        <circle cx="12" cy="11" r="2"/>
                    </svg>
                </div>

                <h2 class="font-semibold text-lg text-gray-800">
                    Alamat Saya
                </h2>
            </div>

            <button onclick="closeAlamatModal()"
                    class="text-gray-600 hover:text-black text-lg">
                ✕
            </button>

        </div>

        <!-- LIST -->
        <div id="modalAlamatList"
             class="p-6 space-y-4 max-h-[350px] overflow-y-auto">
        </div>

        <!-- FOOTER -->
        <div class="p-5 border-t border-white/20 flex justify-end">
            <button onclick="openFormTambahAlamat()"
                    class="flex items-center gap-2 px-5 py-2 rounded-full
                           bg-[#F59A40] text-white text-sm
                           hover:scale-105 transition">

                <!-- SVG PLUS -->
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path d="M12 5v14M5 12h14"/>
                </svg>

                Tambah Alamat
            </button>
        </div>

    </div>
</div>
<div id="formAlamatModal"
     class="fixed inset-0 bg-black/40 backdrop-blur-md
            flex items-center justify-center z-[9999] hidden">

    <div class="w-[700px] max-w-[95%]
                rounded-[30px] p-8
                bg-white/30 backdrop-blur-xl
                border border-white/30
                shadow-[0_10px_60px_rgba(0,0,0,0.25)]">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold">Tambah / Edit Alamat</h2>

            <button onclick="closeFormAlamat()" class="text-lg">✕</button>
        </div>

        <!-- FORM -->
        <div class="grid grid-cols-2 gap-5">

            <!-- LEFT -->
            <div class="space-y-4">

                <input id="inputNama"
                    placeholder="Nama"
                    class="input-modern">

                <input id="inputPenerima"
                    placeholder="Penerima"
                    class="input-modern">

                <input id="inputHP"
                    placeholder="No HP"
                    class="input-modern">

                <input type="date"
                    id="inputTanggal"
                    class="input-modern">

            </div>

            <!-- RIGHT -->
            <textarea id="inputAlamat"
                placeholder="Alamat lengkap"
                class="input-modern h-full min-h-[160px] resize-none"></textarea>

        </div>

        <!-- BUTTON -->
        <div class="flex justify-end gap-3 mt-6">

            <button onclick="closeFormAlamat()"
                    class="px-4 py-2 rounded-full border text-sm">
                Batal
            </button>

            <button onclick="simpanAlamat()"
                    class="px-5 py-2 rounded-full bg-[#F59A40] text-white text-sm
                           hover:scale-105 transition">
                Simpan
            </button>

        </div>

    </div>
</div>
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

<script>
console.log("✅ Checkout script loaded");

// ================= FORMAT RUPIAH =================
function formatRupiah(angka) {
    return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

// ================= LOAD CHECKOUT =================
function loadCheckout() {
    let cart = JSON.parse(localStorage.getItem('checkoutCart')) || [];
    const container = document.getElementById('checkoutItems');

    let total = 0;
    let totalItem = 0;

    container.innerHTML = '';

    if (cart.length === 0) {
        container.innerHTML = `<div class="text-center py-10 text-gray-500">Keranjang kosong</div>`;
        return;
    }

    cart.forEach(item => {
        let price = Number(item.price) || 0;
        let subtotal = price * item.qty;

        total += subtotal;
        totalItem += item.qty;

        container.innerHTML += `
        <div class="grid grid-cols-4 items-center py-5 border-b">
            <div class="flex items-center gap-4">
                <img src="${item.image}" class="w-14 h-14 rounded-xl object-cover">
                <div>
                    <p class="text-sm">${item.name}</p>
                    <p class="text-xs text-gray-500">${item.variant || '-'}</p>
                </div>
            </div>

            <div class="text-center text-sm">Rp ${formatRupiah(price)}</div>
            <div class="text-center text-sm">${item.qty}</div>
            <div class="text-right text-sm">Rp ${formatRupiah(subtotal)}</div>
        </div>`;
    });

    updateTotal(total, totalItem);
}

// ================= UPDATE TOTAL =================
function updateTotal(total = null, totalItem = null) {

    let cart = JSON.parse(localStorage.getItem('checkoutCart')) || [];

    if (total === null) {
        total = 0;
        totalItem = 0;

        cart.forEach(item => {
            total += Number(item.price) * item.qty;
            totalItem += item.qty;
        });
    }

    let ongkir = 0;
    let selectedShipping = document.querySelector('input[name="shipping_method"]:checked');

    if (selectedShipping && selectedShipping.value === 'gosend') {
        ongkir = 15000;
    }

    let totalBayar = total + ongkir;

    document.getElementById('totalItem').textContent = totalItem;
    document.getElementById('totalHargaAtas').textContent = 'Rp ' + formatRupiah(total);

    document.getElementById('subtotalProduk').textContent = 'Rp ' + formatRupiah(total);
    document.getElementById('ongkir').textContent = 'Rp ' + formatRupiah(ongkir);
    document.getElementById('totalBayar').textContent = 'Rp ' + formatRupiah(totalBayar);
}

// ================= INIT =================
document.addEventListener('DOMContentLoaded', function () {

    loadCheckout();
    tampilkanAlamatUtama();

    document.querySelectorAll('input[name="shipping_method"]').forEach(el => {
        el.addEventListener('change', () => updateTotal());
    });

    document.getElementById('checkoutForm').addEventListener('submit', async function (e) {
        e.preventDefault();

        let cart = JSON.parse(localStorage.getItem('checkoutCart')) || [];

        if (cart.length === 0) {
            alert('Keranjang kosong!');
            return;
        }

        let selectedShipping = document.querySelector('input[name="shipping_method"]:checked');
        let selectedPayment = document.querySelector('input[name="payment_method"]:checked');

        if (!selectedShipping) {
            alert("Pilih metode pengiriman!");
            return;
        }

        if (!selectedPayment) {
            alert("Pilih metode pembayaran!");
            return;
        }

        let total = 0;
        cart.forEach(item => {
            total += Number(item.price) * item.qty;
        });

        let ongkir = selectedShipping.value === 'gosend' ? 15000 : 0;
        let totalBayar = total + ongkir;

        try {

            // ================= AMBIL ALAMAT =================
            let resAlamat = await fetch('/alamat');
            let alamatList = await resAlamat.json();
            let alamatUtama = alamatList.find(a => a.is_main);

            if (!alamatUtama) {
                alert("Pilih alamat dulu!");
                return;
            }

            // ================= FETCH BAYAR =================
            let res = await fetch('/bayar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    cart: cart,
                    shipping_method: selectedShipping.value,
                    payment_method: selectedPayment.value,

                    nama: alamatUtama.nama,
                    nama_penerima: alamatUtama.nama,
                    tanggal_penerimaan: alamatUtama.tanggal,
                    no_hp: alamatUtama.hp,
                    alamat: alamatUtama.alamat,

                    total: totalBayar
                })
            });

            let data = await res.json();

            if (!data.snap_token) {
                alert("Snap token tidak ditemukan!");
                return;
            }

            snap.pay(data.snap_token, {

                onSuccess: function(result) {

                    let cart = JSON.parse(localStorage.getItem('cart')) || [];
                    let checkout = JSON.parse(localStorage.getItem('checkoutCart')) || [];

                    let checkoutKeys = checkout.map(i => (i.id || '') + '-' + (i.variant || ''));

                    let newCart = cart.filter(item => {
                        let key = (item.id || '') + '-' + (item.variant || '');
                        return !checkoutKeys.includes(key);
                    });

                    localStorage.setItem('cart', JSON.stringify(newCart));
                    localStorage.removeItem('checkoutCart');

                    window.location.href = "/payment-success?order_id=" + result.order_id;
                },

                onPending: function() {
                    alert("Menunggu pembayaran...");
                },

                onError: function() {
                    alert("Pembayaran gagal!");
                },

                onClose: function() {
                    alert("Kamu belum menyelesaikan pembayaran!");
                }

            });

        } catch (err) {
            console.error(err);
            alert("Gagal konek ke server");
        }
    });

});


// ================= MODAL =================
function openAlamatModal() {
    document.getElementById('alamatModal').classList.remove('hidden');
    renderAlamatModal();
}

function closeAlamatModal() {
    document.getElementById('alamatModal').classList.add('hidden');
}

function openFormTambahAlamat() {
    document.getElementById('formAlamatModal').classList.remove('hidden');
}

function closeFormAlamat() {
    document.getElementById('formAlamatModal').classList.add('hidden');
}


// ================= RENDER ALAMAT =================
async function renderAlamatModal() {
    try {
        let res = await fetch('/alamat');
        let alamatList = await res.json();

        const container = document.getElementById('modalAlamatList');
        container.innerHTML = '';

        if (alamatList.length === 0) {
            container.innerHTML = `
                <p class="text-sm text-gray-500 text-center">
                    Belum ada alamat
                </p>`;
            return;
        }

        alamatList.forEach((alamat) => {
container.innerHTML += `
<div class="p-4 rounded-2xl border transition cursor-pointer
            hover:shadow-md hover:border-[#F59A40]
            ${alamat.is_main ? 'border-[#F59A40] bg-[#F59A40]/5' : 'border-white/30'}">

    <div class="flex justify-between items-start">

        <div class="flex gap-3">

            <input type="radio"
                   name="pilih_alamat"
                   onchange="pilihAlamat(${alamat.id})"
                   ${alamat.is_main ? 'checked' : ''}
                   class="mt-1 accent-[#F59A40]">

            <div>

                <div class="flex items-center gap-2">
                    <p class="font-semibold text-sm">${alamat.nama}</p>
                    <span class="text-xs text-gray-400">${alamat.hp}</span>
                </div>

                <p class="text-sm text-gray-600 mt-2">
                    ${alamat.alamat}
                </p>

                ${
                    alamat.is_main
                    ? `<span class="text-xs text-[#F59A40] font-medium mt-1 inline-block">
                        Alamat Utama
                       </span>`
                    : ''
                }

            </div>

        </div>

        <!-- ACTION -->
        <div class="flex gap-3">

            <button onclick="editAlamat(${alamat.id})"
                    class="group">

                <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition"
                     fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path d="M15 3l6 6-12 12H3v-6L15 3z"/>
                </svg>

            </button>

            <button onclick="hapusAlamat(${alamat.id})"
                    class="group">

                <svg class="w-5 h-5 text-gray-400 group-hover:text-red-500 transition"
                     fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path d="M6 7h12M9 7V4h6v3m-8 0l1 13h8l1-13"/>
                </svg>

            </button>

        </div>

    </div>

</div>
`;
        });

    } catch (err) {
        console.error(err);
        alert("Gagal load alamat!");
    }
}


// ================= PILIH =================
async function pilihAlamat(id) {
    try {
        await fetch(`/alamat/${id}/main`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        tampilkanAlamatUtama();
        closeAlamatModal();

    } catch (err) {
        console.error(err);
        alert("Gagal pilih alamat!");
    }
}


// ================= TAMPIL =================
async function tampilkanAlamatUtama() {
    try {
        let res = await fetch('/alamat');
        let alamatList = await res.json();

        let alamatUtama = alamatList.find(a => a.is_main);

        const container = document.getElementById('alamatContainer');

        if (!alamatUtama) {
            container.innerHTML = `
            <div class="border border-dashed rounded-xl p-6 text-center">
                <p class="text-sm text-gray-500 mb-3">📍 Belum tambah alamat</p>
                <button onclick="openAlamatModal()" class="px-4 py-2 text-sm bg-[#F59A40] text-white rounded-full">
                    Pilih Alamat
                </button>
            </div>`;
            return;
        }

        container.innerHTML = `
        <div class="border rounded-xl p-5 flex justify-between items-start">
            <div>
                <p class="font-semibold text-sm">Nama Penerima: ${alamatUtama.nama}</p>
                <p class="text-sm text-gray-500">No.Hp: ${alamatUtama.hp}</p>
                <p class="text-sm mt-2 text-gray-600">Alamat: ${alamatUtama.alamat}</p>
                <p class="text-xs text-gray-400 mt-1">Tanggal Penerimaan: ${alamatUtama.tanggal || '-'}</p>
            </div>
            <button onclick="openAlamatModal()" class="text-blue-500 text-sm hover:underline">
                Ubah
            </button>
        </div>`;

    } catch (err) {
        console.error(err);
    }
}


// ================= SIMPAN =================
async function simpanAlamat() {

    let nama = document.getElementById('inputNama').value;
    let penerima = document.getElementById('inputPenerima').value;
    let hp = document.getElementById('inputHP').value;
    let tanggal = document.getElementById('inputTanggal').value;
    let alamat = document.getElementById('inputAlamat').value;

    if (!nama || !penerima || !hp || !alamat) {
        alert("Isi semua data!");
        return;
    }

    try {

        let url = '/alamat';
        let method = 'POST';

        // ✅ kalau mode EDIT
        if (editId) {
            url = `/alamat/${editId}`;
            method = 'PUT'; // atau POST + _method kalau Laravel kamu butuh
        }

        let res = await fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
body: JSON.stringify({
    nama: nama,
    hp: hp,
    alamat: alamat,
    tanggal: tanggal
})
        });

        if (!res.ok) throw new Error();

        alert(editId ? "Alamat berhasil diupdate!" : "Alamat berhasil disimpan!");

        editId = null; // reset setelah save

        closeFormAlamat();
        renderAlamatModal();
        tampilkanAlamatUtama();

    } catch (err) {
        console.error(err);
        alert("Gagal simpan alamat!");
    }
}
async function hapusAlamat(id) {

    if (!confirm("Yakin ingin hapus alamat ini?")) return;

    try {
        await fetch(`/alamat/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        alert("Alamat berhasil dihapus");

        renderAlamatModal();
        tampilkanAlamatUtama();

    } catch (err) {
        console.error(err);
        alert("Gagal hapus alamat!");
    }
}
let editId = null;

async function editAlamat(id) {

    try {
        let res = await fetch('/alamat');
        let data = await res.json();

        let alamat = data.find(a => a.id === id);

        if (!alamat) return;

        editId = id;

        // isi form
document.getElementById('inputNama').value = alamat.nama;
document.getElementById('inputHP').value = alamat.hp;
document.getElementById('inputTanggal').value = alamat.tanggal;
document.getElementById('inputAlamat').value = alamat.alamat;

        openFormTambahAlamat();

    } catch (err) {
        console.error(err);
    }
}
</script>
<x-scripts />