<x-header />

<section class="max-w-[1200px] mx-auto px-6 mt-10 mb-20">

    <!-- HEADER -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">
            Pesanan Saya
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Daftar semua pesanan kamu
        </p>
    </div>

    @forelse($orders as $order)

    @php
        $cart = json_decode($order->cart_data, true);
    @endphp

    <!-- CARD ORDER -->
    <a href="{{ route('pesanan.detail', $order->id) }}" 
       class="block bg-white border rounded-2xl p-5 mb-6 hover:shadow-lg transition cursor-pointer">

        <!-- INFO ORDER -->
<div class="flex flex-col md:flex-row md:justify-between md:items-center gap-3 mb-4">

    <!-- LEFT -->
    <div class="min-w-0">
        <p class="text-xs md:text-sm text-gray-500 break-words">
            {{ $order->nama_pemesan }} • {{ $order->created_at->format('d M Y H:i') }}
        </p>
    </div>

    <!-- RIGHT STATUS -->
    <div class="flex flex-wrap items-center gap-2 md:justify-end">

        <!-- PAYMENT STATUS -->
        <span class="px-3 py-1 rounded-full text-[11px] md:text-xs font-medium whitespace-nowrap

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
                ❌ Dibatalkan

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
        <span class="px-3 md:px-4 py-1 md:py-2 rounded-full text-[11px] md:text-sm font-medium whitespace-nowrap

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

</div>

        <!-- ITEM CART -->
        <div class="space-y-3">

            @foreach($cart as $item)
            <div class="flex items-center gap-4 border-b pb-3">

                <img src="{{ $item['image'] }}"
                     class="w-16 h-16 rounded-xl object-cover">

                <div class="flex-1">
                    <h3 class="font-medium text-gray-800">
                        {{ $item['name'] }}
                    </h3>

                    <p class="text-sm text-gray-500">
                        Varian: {{ $item['variant'] ?? '-' }}
                    </p>

                    <p class="text-sm text-gray-500">
                        Qty: {{ $item['qty'] }}
                    </p>
                </div>

                <div class="text-right">
                    <p class="font-semibold text-[#F59A40]">
                        Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                    </p>
                </div>

            </div>
            @endforeach

        </div>

        <!-- TOTAL -->
        <div class="flex justify-between mt-4 pt-4 border-t">
            <div class="text-sm text-gray-500">
                <p>Alamat: {{ $order->alamat }}</p>
                <p>Metode: {{ $order->shipping_method }} / {{ $order->payment_method }}</p>
            </div>

            <div class="text-right">
                <p class="text-sm text-gray-500">Total</p>
                <p class="text-xl font-bold text-[#F59A40]">
                    Rp {{ number_format($order->total, 0, ',', '.') }}
                </p>
            </div>
        </div>

    </a> <!-- ✅ FIX: sebelumnya </div> -->

    @empty

    <!-- EMPTY -->
    <div class="text-center py-20">
        <h3 class="text-lg font-semibold text-gray-700">
            Belum ada pesanan
        </h3>
        <p class="text-sm text-gray-500 mt-2">
            Silakan lakukan checkout terlebih dahulu
        </p>

        <a href="{{ url('/') }}"
           class="inline-block mt-6 px-6 py-2 bg-[#F59A40] text-white rounded-full">
            Mulai Belanja
        </a>
    </div>

    @endforelse

</section>

<x-footer />