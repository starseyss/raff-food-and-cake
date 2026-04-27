<x-header />

<section class="max-w-[900px] mx-auto mt-20 mb-20 px-6">

    <div class="bg-white rounded-[30px] p-10 border shadow-sm">

        <h2 class="text-xl font-semibold mb-6">
            Pembayaran Pesanan
        </h2>

        <!-- INFO ORDER -->
        <div class="mb-6 text-sm space-y-2">
            <div class="flex justify-between">
                <span>ID Order</span>
                <span class="font-medium">{{ $order->midtrans_order_id }}</span>
            </div>

            <div class="flex justify-between">
                <span>Total Bayar</span>
                <span class="text-[#F59A40] font-semibold">
                    Rp {{ number_format($order->total) }}
                </span>
            </div>

            <div class="flex justify-between">
                <span>Status</span>
                <span class="capitalize">
                    {{ $order->status }}
                </span>
            </div>
        </div>

        <!-- BUTTON BAYAR -->
        <button id="pay-button"
                class="w-full py-3 bg-[#F59A40] text-white rounded-full font-medium hover:opacity-90">
            Bayar Sekarang
        </button>

        <a href="/"
           class="mt-6 block text-center text-sm text-gray-500 hover:underline">
            Kembali ke Beranda
        </a>

    </div>

</section>

<x-footer />

<!-- MIDTRANS SCRIPT -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}">
</script>

<script>
document.getElementById('pay-button').onclick = function () {
    snap.pay('{{ $snapToken }}', {

        onSuccess: function(result){
            alert("Pembayaran berhasil!");
            window.location.href = "/payment-success?order_id=" + result.order_id;
        },

        onPending: function(result){
            alert("Menunggu pembayaran...");
        },

        onError: function(result){
            alert("Pembayaran gagal!");
        }

    });
};
</script>

<x-scripts />