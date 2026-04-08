<x-header />

<section class="max-w-[900px] mx-auto mt-20 mb-20 px-6">

    <div class="bg-white rounded-[30px] p-10 border shadow-sm">

        <h2 class="text-xl font-semibold mb-8">
            Detail Pembayaran
        </h2>

        @php
            $shipping = request('shipping_method');
            $payment = request('payment_method');

            $shippingCost = $shipping == 'gosend' ? 15000 : 0;
        @endphp

        <!-- ================= RINGKASAN ================= -->
        <div class="space-y-4 text-sm border-b pb-6">

            <div class="flex justify-between">
                <span>Metode Pengiriman</span>
                <span class="font-medium">
                    {{ $shipping == 'gosend' ? 'GoSend Instant' : 'Ambil Sendiri' }}
                </span>
            </div>

            <div class="flex justify-between">
                <span>Ongkir</span>
                <span class="text-[#F59A40] font-medium">
                    Rp{{ number_format($shippingCost) }}
                </span>
            </div>

            <div class="flex justify-between">
                <span>Metode Pembayaran</span>
                <span class="font-medium uppercase">
                    {{ $payment }}
                </span>
            </div>

        </div>

        <!-- ================= DETAIL BANK ================= -->
        <div class="mt-8">

            <h3 class="font-medium mb-4">Instruksi Pembayaran</h3>

            @switch($payment)

                @case('bri')
                    <p>Transfer ke Bank BRI</p>
                    <p class="font-semibold">1234567890</p>
                    <p>a.n RAFF Catering</p>
                    @break

                @case('bca')
                    <p>Transfer ke Bank BCA</p>
                    <p class="font-semibold">444555666</p>
                    <p>a.n RAFF Catering</p>
                    @break

                @case('bni')
                    <p>Transfer ke Bank BNI</p>
                    <p class="font-semibold">9876543210</p>
                    <p>a.n RAFF Catering</p>
                    @break

                @case('mandiri')
                    <p>Transfer ke Bank Mandiri</p>
                    <p class="font-semibold">111222333</p>
                    <p>a.n RAFF Catering</p>
                    @break

                @case('qris')
                    <p>Silakan scan QRIS berikut saat pembayaran.</p>
                    <img src="{{ asset('images/qris.png') }}"
                         class="h-32 mt-4">
                    @break

                @case('dana')
                    <p>Transfer ke Bank DANA</p>
                    <p class="font-semibold">0823756235</p>
                    <p>a.n RAFF Catering</p>
                    @break

                @case('gopay')
                    <p>Transfer ke Bank GOPAY</p>
                    <p class="font-semibold">081245175</p>
                    <p>a.n RAFF Catering</p>
                    @break

                @case('permata')
                    <p>Transfer ke Bank PERMATA BANK</p>
                    <p class="font-semibold">79435732</p>
                    <p>a.n RAFF Catering</p>
                    @break

                @case('visa')
                    <p>Transfer ke Bank VISA</p>
                    <p class="font-semibold">84562748</p>
                    <p>a.n RAFF Catering</p>
                    @break

                @case('seabank')
                    <p>Transfer ke Bank SEABANK</p>
                    <p class="font-semibold">834589764</p>
                    <p>a.n RAFF Catering</p>
                    @break

                @default
                    <p>Ikuti instruksi pembayaran yang tersedia.</p>

            @endswitch

        </div>

        <a href="/"
           class="mt-10 inline-block bg-[#F59A40] text-white
                  px-6 py-3 rounded-full">
            Kembali ke Beranda
        </a>

    </div>

</section>

<x-footer />
<x-scripts />