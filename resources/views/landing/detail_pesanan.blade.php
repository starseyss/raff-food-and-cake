<x-header />

<section class="max-w-[900px] mx-auto px-3 md:px-6 mt-6 md:mt-10 mb-12 md:mb-20">

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
<div class="mb-6 flex flex-col md:flex-row md:justify-between md:items-center gap-4">

    <!-- STATUS BADGE -->
    <div class="flex flex-wrap items-center gap-2">

        <!-- PAYMENT STATUS -->
        <span class="px-3 md:px-4 py-2 rounded-full text-[11px] md:text-sm font-medium whitespace-nowrap

            @if($order->payment_status == 'pending')
                bg-yellow-100 text-yellow-700

            @elseif($order->payment_status == 'paid')
                bg-green-100 text-green-700

            @elseif($order->payment_status == 'cancelled')
                bg-red-100 text-red-700

            @elseif($order->payment_status == 'refunded')
                bg-blue-100 text-blue-700

            @elseif($order->payment_status == 'refund_failed')
                bg-orange-100 text-orange-700

            @elseif($order->payment_status == 'expired')
                bg-gray-100 text-gray-700

            @else
                bg-gray-100 text-gray-700
            @endif
        ">

            @if($order->payment_status == 'pending')
                ⏳ Menunggu Pembayaran

            @elseif($order->payment_status == 'paid')
                ✅ Sudah Dibayar

            @elseif($order->payment_status == 'cancelled')
                ❌ Pembayaran Dibatalkan

            @elseif($order->payment_status == 'refunded')
                💸 Refund Berhasil

            @elseif($order->payment_status == 'refund_failed')
                ⚠️ Refund Gagal

            @elseif($order->payment_status == 'expired')
                🕒 Pembayaran Kadaluarsa

            @else
                {{ strtoupper($order->payment_status) }}
            @endif

        </span>

        <!-- ORDER STATUS -->
        <span class="px-3 md:px-4 py-2 rounded-full text-[11px] md:text-sm font-medium whitespace-nowrap

            @if($order->order_status == 'order_created')
                bg-gray-100 text-gray-700

            @elseif($order->order_status == 'processing')
                bg-blue-100 text-blue-700

            @elseif($order->order_status == 'packed')
                bg-purple-100 text-purple-700

            @elseif($order->order_status == 'shipped')
                bg-indigo-100 text-indigo-700

            @elseif($order->order_status == 'delivered')
                bg-green-100 text-green-700

            @elseif($order->order_status == 'completed')
                bg-emerald-100 text-emerald-700

            @elseif($order->order_status == 'cancelled')
                bg-red-100 text-red-700

            @else
                bg-gray-100 text-gray-700
            @endif
        ">

            @if($order->order_status == 'order_created')
                📝 Pesanan Dibuat

            @elseif($order->order_status == 'processing')
                👨‍🍳 Sedang Diproses

            @elseif($order->order_status == 'packed')
                📦 Sudah Dikemas

            @elseif($order->order_status == 'shipped')
                🚚 Sedang Dikirim

            @elseif($order->order_status == 'delivered')
                📍 Pesanan Sampai

            @elseif($order->order_status == 'completed')
                ✅ Pesanan Selesai

            @elseif($order->order_status == 'cancelled')
                ❌ Pesanan Dibatalkan

            @else
                {{ strtoupper(str_replace('_',' ', $order->order_status)) }}
            @endif

        </span>

    </div>

    <!-- BACK BUTTON -->
    <a href="{{ route('pesanan') }}"
       class="text-sm text-gray-500 hover:text-[#F59A40] transition whitespace-nowrap">
        ← Kembali
    </a>

</div>

<!-- LIST PRODUK -->
<div class="bg-white border rounded-2xl p-4 md:p-5 space-y-4">

    @forelse($cart as $item)

    @php
        // Ambil kategori dari produk jika ada
        $productCategory = '';
        if (!empty($item['id'])) {
            $produk = \App\Models\Produk::find($item['id']);
            $productCategory = $produk->kategori ?? '';
        }
    @endphp

    <div class="flex gap-3 md:gap-4 border-b pb-4 last:border-none">

        <!-- IMAGE -->
        <img src="{{ $item['image'] ?? '' }}"
             class="w-16 h-16 md:w-20 md:h-20 rounded-xl object-cover bg-gray-100 shrink-0">

        <!-- CONTENT -->
        <div class="flex-1 min-w-0">

            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-2">

                <div class="min-w-0">

                    <h3 class="font-semibold text-gray-800 text-sm md:text-base break-words">
                        {{ $item['name'] ?? '-' }}
                    </h3>

                    <p class="text-xs md:text-sm text-gray-500 mt-1">
                        Varian: {{ $item['variant'] ?? '-' }}
                    </p>

                    @if($productCategory)
                    <p class="text-xs md:text-sm text-gray-500">
                        Kategori: <span class="font-medium text-[#F59A40]">{{ $productCategory }}</span>
                    </p>
                    @endif

                    <p class="text-xs md:text-sm text-gray-500">
                        Qty: {{ $item['qty'] ?? 0 }}
                    </p>

                </div>

                <div class="sm:text-right">

                    <p class="font-semibold text-[#F59A40] text-sm md:text-base whitespace-nowrap">
                        Rp {{ number_format(($item['price'] ?? 0) * ($item['qty'] ?? 0), 0, ',', '.') }}
                    </p>

                </div>

            </div>

        </div>

    </div>

    @empty

    <p class="text-sm text-gray-500">
        Tidak ada item
    </p>

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
        
@if($order->order_status == 'shipped' && isset($order->driver) && $order->driver && isset($order->shipped_at) && $order->shipped_at)
        <div class="bg-orange-50 border-l-4 border-orange-400 p-3 mt-2 rounded-r-lg">
            <p class="text-sm font-semibold text-orange-800">
                🚚 Pengiriman dimulai oleh <strong>{{ $order->driver }}</strong>
            </p>
            <p class="text-xs text-orange-700 mt-0.5">
                ⏰ {{ \Carbon\Carbon::parse($order->shipped_at)->format('d M Y H:i') }}
            </p>
        </div>
        @endif

    </div>
<!-- TOTAL -->
<div class="mt-6 bg-white border rounded-2xl p-4 md:p-5">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>
            <p class="text-sm text-gray-500">
                Total Pembayaran
            </p>

            <p class="text-xs text-gray-400 mt-1">
                Sudah termasuk ongkir
            </p>
        </div>

        <div class="text-left sm:text-right">
            <p class="text-xl md:text-2xl font-bold text-[#F59A40] break-all">
                Rp {{ number_format($order->total, 0, ',', '.') }}
            </p>
        </div>

    </div>

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
@if($order->isPaid() && $order->isCancellable())

<div class="mt-4">

    <!-- BUTTON -->
    <button onclick="openRefundModal({{ $order->id }})"
        class="w-full bg-red-500 text-white py-3 rounded-xl font-semibold hover:bg-red-600 transition">

        📤 Kirim Permintaan Refund

    </button>

</div>

<!-- MODAL -->
<div id="refundFormPopup{{ $order->id }}"
     class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white rounded-2xl w-full max-w-md mx-4 p-6 relative">

        <!-- CLOSE -->
        <button onclick="closePopup({{ $order->id }})"
            class="absolute top-4 right-4 text-gray-400 hover:text-black text-xl">

            ✕

        </button>

        <h2 class="text-xl font-bold text-gray-800 mb-2">
            Permintaan Refund
        </h2>

        <p class="text-sm text-gray-500 mb-6">
            Order #{{ $order->midtrans_order_id }}
        </p>

        <!-- FORM -->
        <form
            action="{{ route('pesanan.refund', $order->id) }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-4">

            @csrf

            <!-- NO REK -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nomor Rekening
                </label>

                <input
                    type="text"
                    name="no_rek"
                    required
                    class="w-full border rounded-xl p-3 text-sm"
                    placeholder="1234567890">
            </div>

            <!-- NAMA -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nama Pemilik Rekening
                </label>

                <input
                    type="text"
                    name="nama_pemilik"
                    required
                    class="w-full border rounded-xl p-3 text-sm"
                    placeholder="Nama rekening">
            </div>

            <!-- FILE -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Upload Bukti Transfer
                </label>

                <input
                    type="file"
                    name="bukti_transfer"
                    accept="image/*"
                    required
                    class="w-full border rounded-xl p-3 text-sm">
            </div>

            <!-- TOTAL -->
            <div class="bg-gray-100 rounded-xl p-3 text-sm">
                Total Refund:
                <span class="font-semibold">
                    Rp {{ number_format($order->total, 0, ',', '.') }}
                </span>
            </div>

            <!-- BUTTON -->
            <button
                type="submit"
                class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-xl font-semibold transition">

                Kirim Permintaan Refund

            </button>

        </form>

    </div>

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
                          placeholder="Tulis review kamu..."
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
            // Ambil info produk yang sudah dirating
            $ratedProduk = \App\Models\Produk::find($order->rating_data->product_id);
            $ratedCategory = $ratedProduk->kategori ?? '';
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

            <p class="text-sm text-gray-600 mt-2">
                {{ $order->rating_data->comment ?? '-' }}
            </p>
            
            @if($ratedCategory)
            <p class="text-xs text-gray-500 mt-2">
                Kategori: <span class="font-medium text-[#F59A40]">{{ $ratedCategory }}</span>
            </p>
            @endif
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

    let isProcessing = false;

    btn.addEventListener('click', async function () {
        if (isProcessing) return;
        isProcessing = true;
        btn.disabled = true;
        btn.textContent = 'Memproses... ⏳';
        btn.classList.add('opacity-50', 'cursor-not-allowed');

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
                alert(data.error || "Snap token gagal dibuat. Pastikan status pesanan masih pending.");
                // Reset button
                isProcessing = false;
                btn.disabled = false;
                btn.textContent = 'Bayar Sekarang';
                btn.classList.remove('opacity-50', 'cursor-not-allowed');
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
                    // Reset button after Midtrans close
                    isProcessing = false;
                    btn.disabled = false;
                    btn.textContent = 'Bayar Sekarang';
                    btn.classList.remove('opacity-50', 'cursor-not-allowed');
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
<script>

function openRefundModal(orderId) {

    const popup = document.getElementById('refundFormPopup' + orderId);

    if (popup) {
        popup.classList.remove('hidden');
        popup.classList.add('flex');
    }

    document.body.style.overflow = 'hidden';
}

function closePopup(orderId) {

    const popup = document.getElementById('refundFormPopup' + orderId);

    if (popup) {
        popup.classList.add('hidden');
        popup.classList.remove('flex');
    }

    document.body.style.overflow = '';
}

</script>
<x-footer />
