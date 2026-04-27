<x-header />

<section class="max-w-[900px] mx-auto px-6 mt-10 mb-20">

    @php
        $cart = $order->cart_items;
    @endphp

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Detail Pesanan
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            {{ $order->nama_pemesan }} • {{ $order->created_at->format('d M Y H:i') }}
        </p>
    </div>

    <!-- STATUS -->
    <div class="mb-6 flex justify-between items-center">
<div class="flex gap-2">

    <!-- PAYMENT STATUS -->
    <span class="px-4 py-2 rounded-full text-sm
        @if($order->payment_status == 'pending') bg-yellow-100 text-yellow-600
        @elseif($order->payment_status == 'paid') bg-green-100 text-green-600
        @elseif($order->payment_status == 'cancelled') bg-red-100 text-red-600
        @elseif($order->payment_status == 'refunded') bg-blue-100 text-blue-600
        @elseif($order->payment_status == 'refund_failed') bg-orange-100 text-orange-600
        @elseif($order->payment_status == 'expired') bg-gray-100 text-gray-600
        @else bg-gray-100 text-gray-600 @endif">

        {{ strtoupper($order->payment_status) }}
    </span>

    <!-- ORDER STATUS -->
<span class="px-4 py-2 rounded-full text-sm
    @if($order->order_status == 'order_created') bg-gray-100 text-gray-600

    @elseif($order->order_status == 'processing') bg-blue-100 text-blue-600

    @elseif($order->order_status == 'packed') bg-purple-100 text-purple-600

    @elseif($order->order_status == 'shipped') bg-indigo-100 text-indigo-600

    @elseif($order->order_status == 'delivered') bg-green-100 text-green-600

    @elseif($order->order_status == 'completed') bg-green-100 text-green-600

    @elseif($order->order_status == 'cancelled') bg-red-100 text-red-600

    @else bg-gray-100 text-gray-600
    @endif">

    {{ strtoupper(str_replace('_',' ', $order->order_status)) }}
</span>

</div>

        <a href="{{ route('pesanan') }}"
           class="text-sm text-gray-500 hover:underline">
            ← Kembali
        </a>
    </div>

    <!-- LIST PRODUK -->
    <div class="bg-white border rounded-2xl p-5 space-y-4">

        @forelse($cart as $item)
        <div class="flex items-center gap-4 border-b pb-3 last:border-none">

            <img src="{{ $item['image'] ?? '' }}"
                 class="w-20 h-20 rounded-xl object-cover bg-gray-100">

            <div class="flex-1">
                <h3 class="font-semibold text-gray-800">
                    {{ $item['name'] ?? '-' }}
                </h3>

                <p class="text-sm text-gray-500">
                    Varian: {{ $item['variant'] ?? '-' }}
                </p>

                <p class="text-sm text-gray-500">
                    Qty: {{ $item['qty'] ?? 0 }}
                </p>
            </div>

            <div class="text-right">
                <p class="font-semibold text-[#F59A40]">
                    Rp {{ number_format(($item['price'] ?? 0) * ($item['qty'] ?? 0), 0, ',', '.') }}
                </p>
            </div>

        </div>
        @empty
        <p class="text-sm text-gray-500">Tidak ada item</p>
        @endforelse

    </div>

    <!-- INFORMASI -->
    <div class="bg-white border rounded-2xl p-5 mt-6 space-y-2">

        <h3 class="font-semibold text-gray-800 mb-2">
            Informasi Pesanan
        </h3>

        <p class="text-sm text-gray-600">
            <span class="font-medium">Alamat:</span> {{ $order->alamat }}
        </p>

        <p class="text-sm text-gray-600">
            <span class="font-medium">Pengiriman:</span> {{ $order->shipping_method }}
        </p>

        <p class="text-sm text-gray-600">
            <span class="font-medium">Pembayaran:</span> {{ $order->payment_method }}
        </p>

    </div>

    <!-- TOTAL -->
    <div class="flex justify-between items-center mt-6 bg-white border rounded-2xl p-5">
        <div>
            <p class="text-sm text-gray-500">Total Pembayaran</p>
            <p class="text-xs text-gray-400">Sudah termasuk ongkir</p>
        </div>

        <p class="text-2xl font-bold text-[#F59A40]">
            Rp {{ number_format($order->total, 0, ',', '.') }}
        </p>
    </div>
<!-- ACTION -->
@if(in_array($order->payment_status, ['pending', 'expired']))
<div class="mt-6">
    <button id="payButton"
        class="w-full bg-[#F59A40] text-white py-3 rounded-xl font-semibold hover:opacity-90 transition">
        Bayar Sekarang
    </button>
</div>
@endif

@if($order->order_status == 'delivered')
<div class="mt-6">
    <form action="{{ route('pesanan.terima', $order->id) }}" method="POST">
        @csrf
        <button
            class="w-full bg-green-500 text-white py-3 rounded-xl font-semibold hover:bg-green-600 transition">
            Pesanan Diterima ✅
        </button>
    </form>
</div>
@endif
@if(in_array($order->order_status, ['order_created', 'processing']))
<div class="mt-4">
    <form action="{{ route('pesanan.cancel', $order->id) }}" method="POST">
        @csrf

        <button
            onclick="return confirm('Yakin mau membatalkan pesanan?')"
            class="w-full bg-red-500 text-white py-3 rounded-xl font-semibold hover:bg-red-600 transition">
            Batalkan Pesanan ❌
        </button>
    </form>
</div>
@endif
@if($order->order_status == 'completed')

    @if(!$order->rating_data)

        <!-- FORM RATING -->
        <div class="mt-6 bg-white border rounded-2xl p-5">
            <h3 class="text-lg font-semibold mb-3 text-gray-800">
                Beri Rating & Review ⭐
            </h3>

            <form action="{{ route('pesanan.rating', $order->id) }}" method="POST">
                @csrf
@php
$productId = $order->cart_items[0]['id'] ?? null;
@endphp

<input type="hidden" name="product_id" value="{{ $productId }}">
                <div class="flex gap-1 text-3xl cursor-pointer">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="star text-gray-300" data-value="{{ $i }}">★</span>
                    @endfor
                </div>

                <input type="hidden" name="rating" id="ratingValue" required>

                <textarea name="comment"
                          class="w-full border rounded-xl p-3 text-sm mt-4"
                          required></textarea>

                <button type="submit"
                        class="mt-4 w-full bg-[#F59A40] text-white py-3 rounded-xl">
                    Kirim Rating
                </button>
            </form>
        </div>

    @else

        <!-- SUDAH RATING -->
        @php
            $userRating = $order->rating_data->rating ?? 0;
        @endphp

        <div class="mt-6 bg-white border rounded-2xl p-5">
            <h3 class="text-lg font-semibold mb-2 text-gray-800">
                Rating Kamu ⭐
            </h3>

            <div class="text-yellow-400 text-2xl">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= $userRating)
                        ★
                    @else
                        <span class="text-gray-300">★</span>
                    @endif
                @endfor
            </div>

            <p class="text-sm text-gray-600 mt-3">
                {{ $order->rating_data->comment ?? '-' }}
            </p>
        </div>

    @endif

@endif
</section>
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const btn = document.getElementById('payButton');

    if (!btn) {
        console.log("❌ Tombol tidak ditemukan (kemungkinan status bukan pending)");
        return;
    }

    btn.addEventListener('click', async function () {

        try {

            let res = await fetch('/bayar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    order_id: {{ $order->id }}
                })
            });

            let data = await res.json();

            console.log(data);

            if (!data.snap_token) {
    console.error("ERROR BACKEND:", data);
    alert(data.error || "Snap token gagal dibuat");
    return;
}

            snap.pay(data.snap_token, {

                onSuccess: function(result) {
                    window.location.href = "/payment-success?order_id=" + result.order_id;
                },

                onPending: function() {
                    alert("⏳ Menunggu pembayaran...");
                },

                onError: function() {
                    alert("❌ Pembayaran gagal!");
                },

                onClose: function() {
                    alert("⚠️ Kamu belum menyelesaikan pembayaran!");
                }

            });

        } catch (err) {
            console.error(err);
            alert("❌ Gagal konek ke server");
        }

    });

});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const stars = document.querySelectorAll(".star");
    const ratingInput = document.getElementById("ratingValue");

    stars.forEach((star, index) => {

        star.addEventListener("click", function () {

            let value = this.getAttribute("data-value");
            ratingInput.value = value;

            // reset semua bintang
            stars.forEach(s => s.classList.remove("text-yellow-400"));
            stars.forEach(s => s.classList.add("text-gray-300"));

            // aktifkan dari kiri sampai yang dipilih
            for (let i = 0; i < value; i++) {
                stars[i].classList.add("text-yellow-400");
                stars[i].classList.remove("text-gray-300");
            }

        });

    });

});
</script>
<x-footer />