<x-header />

<section class="max-w-[1320px] mx-auto px-6 mt-10 mb-20">

    <!-- HEADER -->
    <div class="grid grid-cols-12 text-sm text-gray-500 pb-4 border-b">
        <div class="col-span-5">Produk</div>
        <div class="col-span-2 text-center">Harga per pcs</div>
        <div class="col-span-2 text-center">Kuantitas</div>
        <div class="col-span-2 text-center">Total Harga</div>
        <div class="col-span-1 text-center">Aksi</div>
    </div>

    <!-- CART -->
    <div id="cartContainer"></div>

    <!-- EMPTY -->
    <div id="emptyCart" class="hidden text-center py-20">
        <img src="{{ asset('images/box.png') }}" class="w-20 mx-auto opacity-30 mb-4">
        <h3 class="text-lg font-semibold text-gray-700">Keranjang kosong</h3>
        <p class="text-sm text-gray-500 mt-2">
            Yuk pilih produk dulu dari menu 😊
        </p>
    </div>

    <!-- TOTAL -->
    <div class="mt-10 bg-white rounded-2xl border p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

            <div class="flex items-center gap-4">
                <input type="checkbox" id="selectAll"
                       class="w-4 h-4 accent-[#F59A40]">
                <span class="text-sm">Pilih semua</span>

                <button onclick="clearCart()"
                        class="text-red-500 text-sm hover:underline">
                    Hapus semua
                </button>
            </div>

            <div class="flex items-center gap-6">

                <div class="text-sm">
                    Total (<span class="totalItem">0</span> produk):
                    <span class="text-[#F59A40] font-semibold text-lg totalHarga">
                        Rp 0
                    </span>
                </div>

                <button onclick="goToCheckout()"
                    class="px-8 py-2 border border-[#F59A40]
                           text-[#F59A40] rounded-full
                           hover:bg-[#F59A40] hover:text-white transition">
                    Checkout
                </button>

            </div>

        </div>
    </div>

</section>

<x-footer />

<script>

// ================= SAFE NUMBER =================
function toNumber(val) {
    return Number(String(val).replace(/[^0-9]/g, '')) || 0;
}

// ================= FORMAT =================
function formatRupiah(angka) {
    return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

// ================= LOAD CART =================
function loadCart() {
    const container = document.getElementById('cartContainer');
    const empty = document.getElementById('emptyCart');
    const cart = JSON.parse(localStorage.getItem('cart')) || [];

    container.innerHTML = '';

    if (cart.length === 0) {
        empty.classList.remove('hidden');
        updateTotal();
        return;
    } else {
        empty.classList.add('hidden');
    }

    cart.forEach((item, index) => {

        let price = toNumber(item.price);
        let total = price * item.qty;

        container.innerHTML += `
        <div class="grid grid-cols-12 items-center py-6 border-b">

            <div class="col-span-5 flex items-center gap-4">
                <input type="checkbox"
                       class="productCheckbox w-4 h-4 accent-[#F59A40]"
                       checked>

                <img src="${item.image}"
                     class="w-[70px] h-[70px] rounded-xl object-cover">

                <div>
                    <p class="font-medium">${item.name}</p>
                    <p class="text-xs text-gray-500">
                        Varian: <span class="font-medium text-gray-700">
                        ${item.variant || 'Default'}
                        </span>
                    </p>
                </div>
            </div>

            <div class="col-span-2 text-center text-sm">
                Rp ${formatRupiah(price)}
            </div>

            <div class="col-span-2 flex justify-center">
                <div class="flex items-center gap-3">

                    <button onclick="changeQty(${index}, -1)"
                        class="w-7 h-7 bg-[#F59A40] text-white rounded-full">-</button>

                    <span>${item.qty}</span>

                    <button onclick="changeQty(${index}, 1)"
                        class="w-7 h-7 bg-[#F59A40] text-white rounded-full">+</button>

                </div>
            </div>

            <div class="col-span-2 text-center text-sm">
                Rp ${formatRupiah(total)}
            </div>

            <div class="col-span-1 text-center">
                <button onclick="removeItem(${index})"
                    class="text-red-500 text-sm hover:underline">
                    Hapus
                </button>
            </div>

        </div>`;
    });

    // AUTO SELECT ALL
    document.getElementById('selectAll').checked = true;

    updateTotal();
    saveSelectedCart();
}

// ================= UPDATE TOTAL =================
function updateTotal() {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    let total = 0;
    let totalItem = 0;

    const checkboxes = document.querySelectorAll('.productCheckbox');

    cart.forEach((item, i) => {
        if (checkboxes[i]?.checked) {
            let price = toNumber(item.price);
            total += price * item.qty;
            totalItem += item.qty;
        }
    });

    document.querySelector('.totalHarga').textContent =
        'Rp ' + formatRupiah(total);

    document.querySelector('.totalItem').textContent = totalItem;
}

// ================= SAVE SELECTED =================
function saveSelectedCart() {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let checkboxes = document.querySelectorAll('.productCheckbox');

    let selected = [];

    cart.forEach((item, i) => {
        if (checkboxes[i]?.checked) {
            selected.push(item);
        }
    });

    localStorage.setItem('selectedCart', JSON.stringify(selected));
}

// ================= QTY =================
function changeQty(index, change) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    cart[index].qty += change;

    if (cart[index].qty <= 0) {
        cart.splice(index, 1);
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    loadCart();
}

// ================= REMOVE =================
function removeItem(index) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart.splice(index, 1);

    localStorage.setItem('cart', JSON.stringify(cart));
    loadCart();
}

// ================= CLEAR =================
function clearCart() {
    localStorage.removeItem('cart');
    localStorage.removeItem('selectedCart');
    loadCart();
}

// ================= SELECT ALL =================
document.addEventListener('change', function (e) {

    if (e.target.id === 'selectAll') {
        document.querySelectorAll('.productCheckbox').forEach(cb => {
            cb.checked = e.target.checked;
        });

        updateTotal();
        saveSelectedCart();
    }

    if (e.target.classList.contains('productCheckbox')) {

        // update selectAll state
        let all = document.querySelectorAll('.productCheckbox');
        let checked = document.querySelectorAll('.productCheckbox:checked');

        document.getElementById('selectAll').checked =
            all.length === checked.length;

        updateTotal();
        saveSelectedCart();
    }
});

// ================= CHECKOUT =================
function goToCheckout() {
    let selected = JSON.parse(localStorage.getItem('selectedCart')) || [];

    if (selected.length === 0) {
        alert('Pilih produk dulu!');
        return;
    }

    // 🔥 SIMPAN KE CHECKOUT CART
    localStorage.setItem('checkoutCart', JSON.stringify(selected));

    window.location.href = "{{ route('landing.checkout') }}";
}

// ================= INIT =================
document.addEventListener('DOMContentLoaded', loadCart);

</script>

<x-scripts />