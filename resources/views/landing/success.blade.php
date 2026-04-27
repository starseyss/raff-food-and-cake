<x-header />

<div class="h-screen flex items-center justify-center">
    <div class="bg-white p-10 rounded-2xl shadow text-center">

        <h1 class="text-2xl font-bold text-green-600 mb-4">
            ✅ Pembayaran Berhasil
        </h1>

        <p class="text-gray-600 mb-6">
            Terima kasih, pesanan kamu sedang diproses.
        </p>

        <a href="/"
           class="px-6 py-3 bg-[#F59A40] text-white rounded-full">
            Kembali ke Home
        </a>

    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {

    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let checkout = JSON.parse(localStorage.getItem('checkoutCart')) || [];

    console.log("CART BEFORE:", cart);
    console.log("CHECKOUT:", checkout);

    if (!checkout.length) {
        console.warn("checkoutCart kosong, skip hapus");
        return;
    }

    let checkoutKeys = checkout.map(i => i.id + "-" + i.variant);

    let newCart = cart.filter(item => {
        let key = item.id + "-" + item.variant;
        return !checkoutKeys.includes(key);
    });

    console.log("CART AFTER:", newCart);

    localStorage.setItem('cart', JSON.stringify(newCart));
    localStorage.removeItem('checkoutCart');
});
</script>
<x-footer />