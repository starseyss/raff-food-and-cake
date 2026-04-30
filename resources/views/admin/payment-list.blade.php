<x-admin-header />

<div class="lg:ml-[90px] p-4 sm:p-6 lg:p-8 bg-[#F8F9FB] min-h-screen overflow-x-hidden">

    <!-- ================= HEADER ================= -->
    <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-5 mb-8 lg:mb-10">

        <!-- LEFT -->
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 flex items-center gap-3 flex-wrap">
                <span class="p-2.5 bg-[#F59A40] rounded-2xl text-white shadow-lg shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 sm:h-7 sm:w-7"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a1 1 0 11-2 0 1 1 0 012 0z" />
                    </svg>
                </span>

                Payment Management
            </h1>

            <p class="text-sm text-gray-500 mt-2 font-medium">
                View and Manage All Payment
            </p>
        </div>

        <!-- SEARCH -->
        <div class="relative w-full xl:w-[320px]">
            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                <svg class="h-5 w-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </span>

            <input type="text"
                placeholder="Enter Keywords..."
                class="w-full pl-12 pr-6 py-3 bg-white border border-gray-200 rounded-2xl text-sm focus:ring-2 focus:ring-orange-400 shadow-sm transition-all outline-none">
        </div>
    </div>

<!-- ================= STATS ================= -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 lg:gap-5 mb-8 lg:mb-10">

        <!-- CARD -->
        <div class="bg-white rounded-[2rem] p-5 lg:p-6 shadow-sm border border-gray-100">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">
                Total Transaction
            </p>

            <h2 class="text-2xl lg:text-3xl font-extrabold text-gray-800 mt-2 break-all">
                {{ number_format($paymentStats['total_transaction']) }}
            </h2>
        </div>

        <!-- CARD -->
        <div class="bg-white rounded-[2rem] p-5 lg:p-6 shadow-sm border border-gray-100">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">
                Pending
            </p>

            <h2 class="text-2xl lg:text-3xl font-extrabold text-gray-800 mt-2 break-all">
                {{ number_format($paymentStats['pending']) }}
            </h2>

            <p class="text-[10px] text-yellow-600 font-bold bg-yellow-50 px-2 py-1 rounded-lg inline-block mt-2">
                Awaiting
            </p>
        </div>

        <!-- CARD -->
        <div class="bg-white rounded-[2rem] p-5 lg:p-6 shadow-sm border border-gray-100">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">
                Paid (Settlement)
            </p>

            <h2 class="text-2xl lg:text-3xl font-extrabold text-gray-800 mt-2 break-all">
                {{ number_format($paymentStats['paid']) }}
            </h2>

            <p class="text-[10px] text-green-600 font-bold bg-green-50 px-2 py-1 rounded-lg inline-block mt-2">
                Completed
            </p>
        </div>
                <!-- CARD -->
        <div class="bg-white rounded-[2rem] p-5 lg:p-6 shadow-sm border border-gray-100">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">
                Failed / Expired
            </p>

            <h2 class="text-2xl lg:text-3xl font-extrabold text-gray-800 mt-2 break-all">
                {{ number_format($paymentStats['failed_expired']) }}
            </h2>

            <p class="text-[10px] text-red-600 font-bold bg-red-50 px-2 py-1 rounded-lg inline-block mt-2">
                Rejected
            </p>
        </div>
    </div>
<!-- ================= FILTER ================= -->
    <div class="flex flex-wrap gap-3 mb-8">

        <button class="px-4 py-2 text-sm bg-orange-100 text-orange-600 rounded-full font-medium w-full sm:w-auto">
            Status ▼
        </button>

        <button class="px-4 py-2 text-sm bg-orange-100 text-orange-600 rounded-full font-medium w-full sm:w-auto">
            Method ▼
        </button>

        <button class="px-4 py-2 text-sm bg-orange-100 text-orange-600 rounded-full font-medium w-full sm:w-auto">
            Date Range ▼
        </button>
    </div>

   <!-- ================= TABLE / MOBILE ================= -->
    <div class="bg-white rounded-[2rem] lg:rounded-[2.5rem] shadow-sm p-4 sm:p-6 lg:p-8 border border-gray-100 overflow-hidden">

        <!-- TITLE -->
        <div class="flex items-center gap-3 mb-6 lg:mb-8">
            <img src="{{ asset('images/dompet.png') }}"
                alt="Dompet"
                class="w-10 h-10 object-contain">

            <h2 class="text-lg sm:text-xl font-bold text-gray-800">
                All Payment
            </h2>
        </div>

        <!-- ================= DESKTOP TABLE ================= -->
        <div class="hidden xl:block overflow-x-auto">

            <table class="w-full text-sm text-left border-separate border-spacing-y-4 min-w-[1100px]">

                <!-- HEAD -->
                <thead>
                    <tr class="bg-[#F2E8DA]/30">

                        <th class="p-4 rounded-l-2xl text-gray-500 font-bold uppercase text-[11px] first:pl-10">
                            Order ID
                        </th>

                        <th class="p-4 text-gray-500 font-bold uppercase text-[11px]">
                            Customer
                        </th>

                        <th class="p-4 text-gray-500 font-bold uppercase text-[11px] text-center">
                            Method
                        </th>

                        <th class="p-4 text-gray-500 font-bold uppercase text-[11px] text-center">
                            Amount
                        </th>

                        <th class="p-4 text-gray-500 font-bold uppercase text-[11px] text-center">
                            Status
                        </th>

                        <th class="p-4 text-gray-500 font-bold uppercase text-[11px] text-center">
                            Time
                        </th>

                        <th class="p-4 rounded-r-2xl text-gray-500 font-bold uppercase text-[11px] text-right">
                            Action
                        </th>
                    </tr>
                </thead>

                <!-- BODY -->
                <tbody>

                    @forelse($orders as $order)

                    <tr class="bg-white hover:bg-gray-50 transition-all shadow-sm">

                        <!-- ORDER ID -->
                        <td class="p-5 first:pl-10 rounded-l-3xl font-bold text-orange-500">
                            {{ $order->midtrans_order_id }}
                        </td>

                        <!-- CUSTOMER -->
                        <td class="p-5">
                            <div class="flex items-center gap-3">

                                <img src="https://ui-avatars.com/api/?name={{ urlencode($order->nama_pemesan) }}&background=F59A40&color=fff&bold=true"
                                    class="w-10 h-10 rounded-2xl"
                                    alt="avatar">

                                <span class="font-bold text-gray-700">
                                    {{ $order->nama_pemesan }}
                                </span>
                            </div>
                        </td>

                        <!-- METHOD -->
                        <td class="p-5 text-center">
                            <span class="px-4 py-1.5 rounded-full text-[10px] font-extrabold uppercase bg-gray-100 text-gray-600">
                                {{ strtoupper($order->payment_method) }}
                            </span>
                        </td>

                        <!-- AMOUNT -->
                        <td class="p-5 text-center font-extrabold text-orange-500">
                            Rp{{ number_format($order->total, 0, ',', '.') }}
                        </td>

                        <!-- STATUS -->
                        <td class="p-5 text-center">

                            @php
                                $payment = strtolower($order->payment_status);
                            @endphp

                            <span class="px-4 py-1.5 rounded-full text-[10px] font-extrabold uppercase

                                @if($payment == 'pending')
                                    bg-yellow-100 text-yellow-600
                                @elseif($payment == 'paid')
                                    bg-green-100 text-green-600
                                @elseif($payment == 'expired' || $payment == 'cancelled')
                                    bg-red-100 text-red-600
                                @elseif($payment == 'refunded')
                                    bg-blue-100 text-blue-600
                                @elseif($payment == 'refund_failed')
                                    bg-orange-100 text-orange-600
                                @else
                                    bg-gray-100 text-gray-600
                                @endif
                            ">
                                {{ $payment }}
                            </span>
                        </td>

                        <!-- TIME -->
                        <td class="p-5 text-center text-gray-500 text-xs font-medium">
                            {{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y H:i') }}
                        </td>

                        <!-- ACTION -->
                        <td class="p-5 rounded-r-3xl text-right">

                            <div class="flex justify-end gap-2">

                                <button onclick="location.reload()"
                                    class="w-8 h-8 flex items-center justify-center rounded-full bg-green-100 text-green-600 hover:bg-green-200 transition-colors"
                                    title="Refresh">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                </button>

                                <button onclick="openPaymentModal({{ $order->id }})"
                                    class="w-8 h-8 flex items-center justify-center rounded-full bg-blue-100 text-blue-600 hover:bg-blue-200 transition-colors"
                                    title="Info">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="7" class="p-10 text-center text-gray-500">

                            <div class="flex flex-col items-center gap-2">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-12 w-12 text-gray-300"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>

                                <p class="text-sm font-medium">
                                    No payment records found
                                </p>
                            </div>
                        </td>
                    </tr>

                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- ================= MOBILE CARD ================= -->
        <div class="xl:hidden space-y-4">

            @forelse($orders as $order)

            @php
                $payment = strtolower($order->payment_status);
            @endphp

            <div class="border border-gray-100 rounded-3xl p-5 shadow-sm">

                <!-- TOP -->
                <div class="flex items-start justify-between gap-3 mb-4">

                    <div class="min-w-0">
                        <p class="font-bold text-orange-500 text-sm break-all">
                            {{ $order->midtrans_order_id }}
                        </p>

                        <div class="flex items-center gap-3 mt-3">

                            <img src="https://ui-avatars.com/api/?name={{ urlencode($order->nama_pemesan) }}&background=F59A40&color=fff&bold=true"
                                class="w-11 h-11 rounded-2xl shrink-0"
                                alt="avatar">

                            <div class="min-w-0">
                                <p class="font-bold text-gray-800 text-sm truncate">
                                    {{ $order->nama_pemesan }}
                                </p>

                                <p class="text-xs text-gray-400 mt-1">
                                    {{ strtoupper($order->payment_method) }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase whitespace-nowrap

                        @if($payment == 'pending')
                            bg-yellow-100 text-yellow-600
                        @elseif($payment == 'paid')
                            bg-green-100 text-green-600
                        @elseif($payment == 'expired' || $payment == 'cancelled')
                            bg-red-100 text-red-600
                        @elseif($payment == 'refunded')
                            bg-blue-100 text-blue-600
                        @elseif($payment == 'refund_failed')
                            bg-orange-100 text-orange-600
                        @else
                            bg-gray-100 text-gray-600
                        @endif
                    ">
                        {{ $payment }}
                    </span>
                </div>

                <!-- MIDDLE -->
                <div class="grid grid-cols-2 gap-4 mb-5">

                    <div>
                        <p class="text-[11px] text-gray-400 font-bold uppercase">
                            Amount
                        </p>

                        <p class="text-sm font-extrabold text-orange-500 mt-1 break-all">
                            Rp{{ number_format($order->total, 0, ',', '.') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-[11px] text-gray-400 font-bold uppercase">
                            Time
                        </p>

                        <p class="text-xs text-gray-600 mt-1">
                            {{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y H:i') }}
                        </p>
                    </div>
                </div>

                <!-- ACTION -->
                <div class="flex items-center justify-end gap-2">

                    <button onclick="location.reload()"
                        class="w-10 h-10 flex items-center justify-center rounded-full bg-green-100 text-green-600 hover:bg-green-200 transition-colors">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </button>

                    <button onclick="openPaymentModal({{ $order->id }})"
                        class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-100 text-blue-600 hover:bg-blue-200 transition-colors">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>
                </div>
            </div>

            @empty

            <div class="text-center py-10 text-gray-500">
                No payment records found
            </div>

            @endforelse
        </div>
    </div>
</div>

<<!-- ================= PAYMENT DETAIL MODAL ================= -->
<div id="paymentModal"
    class="fixed inset-0 bg-black/30 hidden items-center justify-center z-[9999] backdrop-blur-sm p-4">

    <div class="bg-white rounded-[2rem] shadow-2xl w-full max-w-[450px] p-5 sm:p-8 relative max-h-[90vh] overflow-y-auto">

        <!-- CLOSE -->
        <button onclick="closePaymentModal()"
            class="absolute top-5 right-5 w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 text-gray-500 hover:bg-gray-200">
            ✕
        </button>

        <!-- HEADER -->
        <div class="mb-6">
            <h2 class="text-lg sm:text-xl font-bold text-gray-800">
                Payment Detail
            </h2>
        </div>

        <!-- CUSTOMER + ORDER -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">

            <div class="bg-gray-50 rounded-2xl p-4">
                <p class="text-[10px] font-bold text-gray-400 uppercase">
                    Customer
                </p>

                <p class="font-bold text-gray-800 text-sm break-words mt-1"
                    id="modalCustomer">
                    -
                </p>
            </div>

            <div class="bg-gray-50 rounded-2xl p-4">
                <p class="text-[10px] font-bold text-gray-400 uppercase">
                    Order ID
                </p>

                <p class="font-bold text-gray-800 text-sm break-all mt-1"
                    id="modalOrderId">
                    -
                </p>
            </div>
        </div>

        <!-- METHOD + AMOUNT -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">

            <!-- METHOD -->
            <div class="bg-gray-50 rounded-2xl p-4 flex flex-col items-center justify-center">

                <p class="text-[10px] font-bold text-gray-400 uppercase mb-2">
                    Method
                </p>

                <img id="modalMethodImg"
                    class="h-10 object-contain">
            </div>

            <!-- AMOUNT -->
            <div class="bg-gray-50 rounded-2xl p-4 text-center">

                <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">
                    Amount
                </p>

                <p class="font-extrabold text-green-600 text-sm break-all"
                    id="modalAmount">
                    -
                </p>
            </div>
        </div>

        <!-- STATUS + TIME -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

            <!-- STATUS -->
            <div class="bg-gray-50 rounded-2xl p-4 text-center">

                <p class="text-[10px] font-bold text-gray-400 uppercase mb-2">
                    Status
                </p>

                <span id="modalStatus"
                    class="text-sm font-extrabold uppercase">
                    -
                </span>
            </div>

            <!-- TIME -->
            <div class="bg-gray-50 rounded-2xl p-4 text-center">

                <p class="text-[10px] font-bold text-gray-400 uppercase mb-2">
                    Transaction Time
                </p>

                <p class="text-sm font-bold text-gray-700 break-words"
                    id="modalTime">
                    -
                </p>
            </div>
        </div>
    </div>
</div>
<script>
const ordersData = @json($orders);

function openPaymentModal(orderId) {

    const order = ordersData.find(o => o.id === orderId);

    if (!order) return;

    // ORDER ID
    document.getElementById('modalOrderId').textContent =
        order.midtrans_order_id || '#' + order.id;

    // CUSTOMER
    document.getElementById('modalCustomer').textContent =
        order.nama_pemesan || '-';

    // METHOD IMAGE
    const method = (order.payment_method || '').toLowerCase();

    document.getElementById('modalMethodImg').src =
        '/images/' + getPaymentImage(method);

    // AMOUNT
    document.getElementById('modalAmount').textContent =
        'Rp ' + new Intl.NumberFormat('id-ID').format(order.total || 0);

    // STATUS
    const status = (order.payment_status || '').toLowerCase();

    const statusEl = document.getElementById('modalStatus');

    statusEl.textContent = status;

    statusEl.className =
        "px-4 py-1.5 rounded-full text-[10px] font-extrabold uppercase";

    if (status === 'pending') {
        statusEl.classList.add('bg-yellow-100', 'text-yellow-600');
    }
    else if (status === 'paid') {
        statusEl.classList.add('bg-green-100', 'text-green-600');
    }
    else if (status === 'expired' || status === 'cancelled') {
        statusEl.classList.add('bg-red-100', 'text-red-600');
    }
    else if (status === 'refunded') {
        statusEl.classList.add('bg-blue-100', 'text-blue-600');
    }
    else if (status === 'refund_failed') {
        statusEl.classList.add('bg-orange-100', 'text-orange-600');
    }
    else {
        statusEl.classList.add('bg-gray-100', 'text-gray-600');
    }

    // TIME
    document.getElementById('modalTime').textContent =
        order.created_at
            ? new Date(order.created_at).toLocaleString('id-ID')
            : '-';

    // SHOW
    const modal = document.getElementById('paymentModal');

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closePaymentModal() {

    document.getElementById('paymentModal').classList.add('hidden');

    document.getElementById('paymentModal').classList.remove('flex');
}

// CLOSE BACKDROP
document.getElementById('paymentModal').addEventListener('click', function(e) {

    if (e.target === this) {
        closePaymentModal();
    }
});

// PAYMENT IMAGE MAP
function getPaymentImage(method) {

    const map = {
        bca: 'bca.png',
        bni: 'bni.png',
        bri: 'bri.png',
        dana: 'dana.png',
        gopay: 'gopay.png',
        mandiri: 'mandiri.png',
        permata: 'permata.png',
        qris: 'qris.png',
        seabank: 'seabnk.png',
        visa: 'visa.png'
    };

    return map[method] || 'default.png';
}
</script>

<x-scripts-admin />

