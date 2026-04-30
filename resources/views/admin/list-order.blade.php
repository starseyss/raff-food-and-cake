<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
.status-card {
    color: white;
    padding: 14px;
    border-radius: 16px;
    text-align: center;
    transition: 0.3s;
    min-height: 110px;
}

.status-card p {
    font-size: 14px;
}

.status-card span {
    font-size: 11px;
    opacity: 0.9;
}

.status-card:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}
</style>
<style>
    body { font-family: 'Poppins', sans-serif; }
    
    .card-bold { font-weight: 700; }
    .stat-value { font-weight: 800; }

    /* Custom Dropdown Animation */
.action-menu {
    display: none;
    position: absolute;
    top: 50%;
    right: 70%; /* 👉 geser ke kanan */
    transform: translateY(-50%);
    z-index: 50;
    min-width: 120px;
}
    
@keyframes slideSide {
    from { opacity: 0; transform: translateX(-10px); }
    to { opacity: 1; transform: translateX(0); }
}

.action-container:hover .action-menu,
.action-container:focus-within .action-menu {
    display: block;
    animation: slideSide 0.2s ease-out;
}
</style>

<x-admin-header />

<div class="lg:ml-[90px] px-3 sm:px-4 md:px-6 lg:px-8 py-4 md:py-6 bg-[#F8F9FB] min-h-screen overflow-x-hidden">

    <!-- ================= HEADER ================= -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6 md:mb-10">

        <!-- TITLE -->
        <div>
            <h1 class="text-2xl md:text-3xl card-bold text-gray-800 flex items-center gap-3 flex-wrap">

                <span class="p-2 md:p-2.5 bg-[#F59A40] rounded-2xl text-white shadow-lg shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-5 w-5 md:h-7 md:w-7"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />

                    </svg>
                </span>

                <span>Orders Management</span>

            </h1>

            <p class="text-xs md:text-sm text-gray-500 mt-2 font-medium">
                Manage and track all customer orders
            </p>
        </div>
        
         <!-- SEARCH -->
        <div class="relative w-full lg:w-auto">

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
                   class="w-full lg:w-80 pl-12 pr-6 py-3 bg-white border border-gray-200 rounded-2xl text-sm focus:ring-2 focus:ring-orange-400 shadow-sm transition-all outline-none">

        </div>

    </div>

    <!-- ================= STATS ================= -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-6 gap-4 md:gap-5 mb-6 md:mb-10">

        <!-- TOTAL -->
        <div class="sm:col-span-2 xl:col-span-1 bg-[#F59A40] rounded-[2rem] p-5 md:p-6 text-white shadow-lg shadow-orange-200">

            <p class="text-xs font-bold opacity-90 uppercase tracking-wider">
                Total Orders
            </p>

            <h2 class="text-3xl md:text-4xl stat-value my-2">
                {{ number_format($stats['total_orders']) }}
            </h2>

            <div class="bg-white/20 inline-block px-3 py-1 rounded-full text-[10px] font-bold">
                +{{ $stats['today_orders'] }} today
            </div>

        </div>


         <!-- CARD -->
        <div class="bg-white rounded-[2rem] p-5 md:p-6 shadow-sm border border-gray-100 flex flex-col justify-between">

            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">
                Pending Orders
            </p>

            <h2 class="text-2xl md:text-3xl stat-value text-gray-800">
                {{ number_format($stats['pending_orders']) }}
            </h2>

            <p class="text-[10px] text-yellow-600 font-bold bg-yellow-50 px-2 py-1 rounded-lg self-start mt-2">
                Awaiting
            </p>

        </div>
         <!-- CARD -->
        <div class="bg-white rounded-[2rem] p-5 md:p-6 shadow-sm border border-gray-100 flex flex-col justify-between">

            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">
                Processing
            </p>

            <h2 class="text-2xl md:text-3xl stat-value text-gray-800">
                {{ number_format($stats['processing']) }}
            </h2>

            <p class="text-[10px] text-blue-600 font-bold bg-blue-50 px-2 py-1 rounded-lg self-start mt-2">
                In Progress
            </p>

        </div>
        <div class="bg-white rounded-[2rem] p-5 md:p-6 shadow-sm border border-gray-100 flex flex-col justify-between">

            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">
                Completed
            </p>

            <h2 class="text-2xl md:text-3xl stat-value text-gray-800">
                {{ number_format($stats['completed']) }}
            </h2>

            <p class="text-[10px] text-green-600 font-bold bg-green-50 px-2 py-1 rounded-lg self-start mt-2">
                Delivered
            </p>

        </div>

        <div class="bg-white rounded-[2rem] p-5 md:p-6 shadow-sm border border-gray-100 flex flex-col justify-between">

            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">
                Cancelled
            </p>

            <h2 class="text-2xl md:text-3xl stat-value text-gray-800">
                {{ number_format($stats['cancelled']) }}
            </h2>

            <p class="text-[10px] text-red-600 font-bold bg-red-50 px-2 py-1 rounded-lg self-start mt-2">
                Rejected
            </p>

        </div>

        <div class="bg-white rounded-[2rem] p-5 md:p-6 shadow-sm border border-gray-100 flex flex-col justify-between">

            <p class="text-xs font-bold text-[#F59A40] uppercase tracking-wider">
                Total Revenue
            </p>

            <h2 class="text-lg md:text-2xl stat-value text-gray-800 break-words">
                Rp{{ number_format($stats['total_revenue'], 0, ',', '.') }}
            </h2>

            <p class="text-[10px] text-green-600 font-bold mt-2">
                +Rp{{ number_format($stats['today_revenue'], 0, ',', '.') }} today
            </p>

        </div>

    </div>

    <!-- ================= TABLE WRAPPER ================= -->
<div class="bg-white rounded-[1.5rem] md:rounded-[2.5rem] shadow-sm p-4 md:p-8 border border-gray-100 overflow-hidden">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6 md:mb-8">

        <div class="flex items-center gap-2">
            <span class="text-orange-500 text-lg md:text-xl font-bold">🛒</span>

            <h2 class="text-lg md:text-xl font-bold text-gray-800">
                All Orders
            </h2>
        </div>

        <!-- SEARCH -->
        <div class="w-full md:w-auto">
            <input type="text"
                   placeholder="Search order..."
                   class="w-full md:w-[260px]
                          h-11
                          rounded-2xl
                          border border-gray-200
                          bg-gray-50
                          px-4
                          text-sm
                          outline-none
                          focus:ring-2 focus:ring-orange-300">
        </div>

    </div>

    <!-- ================= DESKTOP TABLE ================= -->
    <div class="hidden lg:block overflow-x-auto">

        <table class="w-full min-w-[1100px] text-sm text-left border-separate border-spacing-y-4">

            <thead>
                <tr class="bg-[#F2E8DA]/30">

                    <th class="p-4 rounded-l-2xl text-gray-500 font-bold uppercase text-[11px]">
                        Order ID
                    </th>

                    <th class="p-4 text-gray-500 font-bold uppercase text-[11px]">
                        Customer
                    </th>

                    <th class="p-4 text-gray-500 font-bold uppercase text-[11px]">
                        Date
                    </th>

                    <th class="p-4 text-gray-500 font-bold uppercase text-[11px]">
                        Amount
                    </th>

                    <th class="p-4 text-gray-500 font-bold uppercase text-[11px]">
                        Payment
                    </th>

                    <th class="p-4 text-gray-500 font-bold uppercase text-[11px]">
                        Status
                    </th>

                    <th class="p-4 rounded-r-2xl text-gray-500 font-bold uppercase text-[11px] text-center">
                        Action
                    </th>

                </tr>
            </thead>

            <tbody>

                @forelse($orders as $order)

                <tr class="bg-white hover:bg-gray-50 transition-all shadow-sm">

                    <!-- ORDER ID -->
                    <td class="p-5 rounded-l-3xl font-bold text-orange-500 whitespace-nowrap">
                        #{{ $order->midtrans_order_id }}
                    </td>

                    <!-- CUSTOMER -->
                    <td class="p-5">

                        <div class="flex items-center gap-3">

                            <img src="https://ui-avatars.com/api/?name={{ urlencode($order->nama_pemesan) }}&background=F59A40&color=fff&bold=true"
                                 class="w-10 h-10 rounded-2xl object-cover">

                            <div>
                                <p class="font-bold text-gray-700">
                                    {{ $order->nama_pemesan }}
                                </p>

                                <p class="text-xs text-gray-400">
                                    {{ $order->no_hp }}
                                </p>
                            </div>

                        </div>

                    </td>

                    <!-- DATE -->
                    <td class="p-5 text-gray-500 font-medium whitespace-nowrap">
                        {{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}
                    </td>

                    <!-- AMOUNT -->
                    <td class="p-5 font-extrabold text-gray-800 whitespace-nowrap">
                        Rp{{ number_format($order->total, 0, ',', '.') }}
                    </td>

                    <!-- PAYMENT -->
                    <td class="p-5">

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

                            @elseif($payment == 'processing_refund')
                                bg-yellow-100 text-yellow-700

                            @elseif($payment == 'refund_failed')
                                bg-orange-100 text-orange-600

                            @else
                                bg-gray-100 text-gray-600
                            @endif">

                            {{ $payment == 'processing_refund' ? 'Processing Refund' : ucfirst($payment) }}

                        </span>

                    </td>

                    <!-- STATUS -->
                    <td class="p-5">

                        @php
                            $orderStatus = strtolower($order->order_status);
                        @endphp

                        <span class="px-4 py-1.5 rounded-full text-[10px] font-bold uppercase

                            @if($orderStatus == 'order_created')
                                bg-gray-100 text-gray-600

                            @elseif($orderStatus == 'processing')
                                bg-blue-100 text-blue-600

                            @elseif($orderStatus == 'packed')
                                bg-purple-100 text-purple-600

                            @elseif($orderStatus == 'shipped')
                                bg-indigo-100 text-indigo-600

                            @elseif($orderStatus == 'delivered' || $orderStatus == 'completed')
                                bg-green-100 text-green-600

                            @elseif($orderStatus == 'cancelled')
                                bg-red-100 text-red-600

                            @else
                                bg-gray-100 text-gray-600
                            @endif">

                            {{ str_replace('_', ' ', $orderStatus) }}

                        </span>

                    </td>

                    <!-- ACTION -->
                    <td class="p-5 rounded-r-3xl text-center">

                        <div class="flex items-center justify-center gap-2">

                            <!-- DETAIL -->
                            <button onclick="openOrderModal({{ $order->id }})"
                                class="w-10 h-10 rounded-full bg-blue-500 hover:bg-blue-600
                                       flex items-center justify-center text-white transition">

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

                            <!-- UPDATE -->
                            <button onclick="openStatusModal({{ $order->id }})"
                                class="w-10 h-10 rounded-full bg-emerald-500 hover:bg-emerald-600
                                       flex items-center justify-center text-white transition">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-5 w-5"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor">

                                    <path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>

                                </svg>

                            </button>

                            <!-- CANCEL -->
                            <form action="{{ route('admin.cancel', $order->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin mau membatalkan pesanan ini?')">

                                @csrf

                                <button type="submit"
                                    class="w-10 h-10 rounded-full bg-red-500 hover:bg-red-600
                                           flex items-center justify-center text-white transition">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="h-5 w-5"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636" />

                                    </svg>

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="7" class="py-16 text-center text-gray-400">
                        Tidak ada order
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <!-- ================= MOBILE CARD ================= -->
    <div class="grid grid-cols-1 gap-4 lg:hidden">

        @forelse($orders as $order)

        @php
            $payment = strtolower($order->payment_status);
            $orderStatus = strtolower($order->order_status);
        @endphp

        <div class="bg-[#FAFAFA] border border-gray-100 rounded-[2rem] p-4 shadow-sm">

            <!-- TOP -->
            <div class="flex items-start justify-between gap-3">

                <div class="flex items-center gap-3 min-w-0">

                    <img src="https://ui-avatars.com/api/?name={{ urlencode($order->nama_pemesan) }}&background=F59A40&color=fff&bold=true"
                         class="w-12 h-12 rounded-2xl shrink-0">

                    <div class="min-w-0">

                        <p class="font-bold text-gray-800 truncate">
                            {{ $order->nama_pemesan }}
                        </p>

                        <p class="text-xs text-gray-400 truncate">
                            #{{ $order->midtrans_order_id }}
                        </p>

                    </div>

                </div>

                <p class="text-xs text-gray-400 whitespace-nowrap">
                    {{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}
                </p>

            </div>

            <!-- INFO -->
            <div class="mt-4 space-y-3">

                <div class="flex justify-between items-center">
                    <span class="text-xs text-gray-400">Amount</span>

                    <span class="font-bold text-gray-800 text-sm">
                        Rp{{ number_format($order->total,0,',','.') }}
                    </span>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-xs text-gray-400">Payment</span>

                    <span class="text-[10px] px-3 py-1 rounded-full font-bold

                        @if($payment == 'pending')
                            bg-yellow-100 text-yellow-600

                        @elseif($payment == 'paid')
                            bg-green-100 text-green-600

                        @elseif($payment == 'expired' || $payment == 'cancelled')
                            bg-red-100 text-red-600

                        @else
                            bg-gray-100 text-gray-600
                        @endif">

                        {{ ucfirst($payment) }}

                    </span>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-xs text-gray-400">Status</span>

                    <span class="text-[10px] px-3 py-1 rounded-full font-bold

                        @if($orderStatus == 'processing')
                            bg-blue-100 text-blue-600

                        @elseif($orderStatus == 'packed')
                            bg-purple-100 text-purple-600

                        @elseif($orderStatus == 'shipped')
                            bg-indigo-100 text-indigo-600

                        @elseif($orderStatus == 'delivered' || $orderStatus == 'completed')
                            bg-green-100 text-green-600

                        @elseif($orderStatus == 'cancelled')
                            bg-red-100 text-red-600

                        @else
                            bg-gray-100 text-gray-600
                        @endif">

                        {{ str_replace('_',' ',$orderStatus) }}

                    </span>
                </div>

            </div>

            <!-- ACTION -->
            <div class="flex items-center justify-end gap-2 mt-5">

                <button onclick="openOrderModal({{ $order->id }})"
                    class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center">

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

                <button onclick="openStatusModal({{ $order->id }})"
                    class="w-10 h-10 rounded-full bg-emerald-500 text-white flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-5 w-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>

                    </svg>

                </button>

                <form action="{{ route('admin.cancel', $order->id) }}"
                      method="POST"
                      onsubmit="return confirm('Yakin mau membatalkan pesanan ini?')">

                    @csrf

                    <button type="submit"
                        class="w-10 h-10 rounded-full bg-red-500 text-white flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-5 w-5"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636" />

                        </svg>

                    </button>

                </form>

            </div>

        </div>

        @empty

        <div class="text-center py-14 text-gray-400">
            Tidak ada order
        </div>

        @endforelse

    </div>

</div>
<!-- ================= MODAL UPDATE STATUS ================= -->
<div id="statusModal"
     class="fixed inset-0 bg-black/20 hidden
            flex items-center justify-center z-[9999]">

    <div class="relative rounded-3xl p-8 w-[520px] max-w-[95%] text-center overflow-hidden bg-white/30 backdrop-blur-xl border border-white/40">

        <h2 class="text-gray-800 text-xl font-semibold mb-6">
            Update Status
        </h2>

        <form id="statusFormGlobal" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="order_status" id="selectedStatus">

            <div class="grid grid-cols-2 gap-4">

                <!-- Processing -->
                <button type="button" onclick="setStatus('processing')"
                    class="status-card bg-cover bg-center"
                    style="background-image: url('/images/processing.png');">
<div class="w-[96px] mx-auto mt-2 mb-1 bg-white/20 backdrop-blur-md rounded-full border border-white/20 py-1 flex justify-center">
                        <p class="font-semibold text-xs">Processing</p>
                                            </div>
                        <span>Pesanan lagi dibikin</span>
                </button>

                <!-- Packed -->
                <button type="button" onclick="setStatus('packed')"
                    class="status-card bg-cover bg-center"
                    style="background-image: url('/images/packed.png');">
<div class="w-[90px] mx-auto mt-2 mb-1 bg-white/20 backdrop-blur-md rounded-full border border-white/20 py-1 flex justify-center">
                        <p class="font-semibold text-xs">Packed</p>
                                            </div>
                        <span>Pesanan lagi dipacking siap kirim</span>
                </button>
            </div>

            <button type="button"
                onclick="closeStatusModal()"
                class="mt-6 text-gray-500 text-sm">
                Batal
            </button>

        </form>

    </div>
</div>

<!-- ================= PAYMENT DETAIL MODAL ================= -->
<div id="paymentModal" class="fixed inset-0 bg-black/30 hidden items-center justify-center z-[9999] backdrop-blur-sm">
    <div class="bg-white rounded-[2rem] shadow-2xl w-[600px] max-w-[95%] max-h-[90vh] overflow-y-auto p-8 relative">
        <!-- Close Button -->
        <button onclick="closePaymentModal()" class="absolute top-6 right-6 w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 text-gray-500 hover:bg-gray-200 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>

        <!-- Modal Header -->
        <div class="flex items-center gap-3 mb-6">
            <div class="w-12 h-12 rounded-2xl bg-blue-100 flex items-center justify-center text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-800">Order Detail</h2>
                <p class="text-xs text-gray-500" id="modalOrderId">-</p>
            </div>
        </div>

        <!-- Customer Info -->
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div class="bg-gray-50 rounded-2xl p-4">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Customer</p>
                <p class="font-bold text-gray-800 text-sm" id="modalCustomer">-</p>
            </div>
            <div class="bg-gray-50 rounded-2xl p-4">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Recipient</p>
                <p class="font-bold text-gray-800 text-sm" id="modalRecipient">-</p>
            </div>
            <div class="bg-gray-50 rounded-2xl p-4">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Phone</p>
                <p class="font-bold text-gray-800 text-sm" id="modalPhone">-</p>
            </div>
            <div class="bg-gray-50 rounded-2xl p-4">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Receive Date</p>
                <p class="font-bold text-gray-800 text-sm" id="modalDate">-</p>
            </div>
        </div>

        <!-- Address -->
        <div class="bg-gray-50 rounded-2xl p-4 mb-6">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Address</p>
            <p class="font-medium text-gray-700 text-sm" id="modalAddress">-</p>
        </div>

        <!-- Payment Info -->
        <div class="grid grid-cols-3 gap-4 mb-6">
            <div class="bg-orange-50 rounded-2xl p-4 text-center">
                <p class="text-[10px] font-bold text-orange-400 uppercase tracking-wider mb-1">Payment Method</p>
                <p class="font-extrabold text-orange-600 text-sm uppercase" id="modalMethod">-</p>
            </div>
            <div class="bg-green-50 rounded-2xl p-4 text-center">
                <p class="text-[10px] font-bold text-green-400 uppercase tracking-wider mb-1">Amount</p>
                <p class="font-extrabold text-green-600 text-sm" id="modalAmount">-</p>
            </div>
            <div class="bg-blue-50 rounded-2xl p-4 text-center">
                <p class="text-[10px] font-bold text-blue-400 uppercase tracking-wider mb-1">Status</p>
                <p class="font-extrabold text-blue-600 text-sm uppercase" id="modalShipping">-</p>
            </div>
        </div>

        <!-- Status & Time -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-2">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Status:</span>
                <span id="modalStatus" class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase">-</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Time:</span>
                <span class="text-xs font-medium text-gray-600" id="modalTime">-</span>
            </div>
        </div>

        <!-- Notes -->
        <div class="bg-yellow-50 rounded-2xl p-4 mb-6" id="modalNoteBox">
            <p class="text-[10px] font-bold text-yellow-600 uppercase tracking-wider mb-1">Note</p>
            <p class="text-sm text-yellow-800" id="modalNote">-</p>
        </div>

        <!-- Product Details -->
        <div>
            <h3 class="text-sm font-bold text-gray-800 mb-3">Product Details</h3>
            <div id="modalProducts" class="space-y-3">
                <!-- Products injected via JS -->
            </div>
        </div>

        <!-- Total -->
        <div class="mt-6 pt-4 border-t border-gray-100 flex justify-between items-center">
            <span class="text-sm font-bold text-gray-500">Subtotal</span>
            <span class="text-sm font-bold text-gray-800" id="modalSubtotal">-</span>
        </div>
        <div class="flex justify-between items-center mt-2">
            <span class="text-sm font-bold text-gray-500">Shipping Cost</span>
            <span class="text-sm font-bold text-gray-800" id="modalOngkir">-</span>
        </div>
        <div class="flex justify-between items-center mt-2 pt-2 border-t border-gray-200">
            <span class="text-base font-extrabold text-gray-800">Total</span>
            <span class="text-base font-extrabold text-orange-500" id="modalTotal">-</span>
        </div>
    </div>
</div>
<script>
// Order data from server
const ordersData = @json($orders);

function openOrderModal(orderId) {
    const order = ordersData.find(o => o.id === orderId);
    if (!order) return;

    // Basic info
    document.getElementById('modalOrderId').textContent = order.midtrans_order_id || '#' + order.id;
    document.getElementById('modalCustomer').textContent = order.nama_pemesan || '-';
    document.getElementById('modalRecipient').textContent = order.nama_penerima || '-';
    document.getElementById('modalPhone').textContent = order.no_hp || '-';
    document.getElementById('modalDate').textContent = order.tanggal_penerimaan || '-';
    document.getElementById('modalAddress').textContent = order.alamat || '-';
    document.getElementById('modalMethod').textContent = order.payment_method || '-';
    document.getElementById('modalAmount').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(order.total || 0);
    document.getElementById('modalShipping').textContent = (order.order_status || '-').replaceAll('_', ' ');
    document.getElementById('modalTime').textContent = order.created_at ? new Date(order.created_at).toLocaleString('en-GB', { day: '2-digit', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' }) : '-';

    // Note
    const noteBox = document.getElementById('modalNoteBox');
    if (order.catatan) {
        noteBox.classList.remove('hidden');
        document.getElementById('modalNote').textContent = order.catatan;
    } else {
        noteBox.classList.add('hidden');
    }

    // Status badge
    const statusEl = document.getElementById('modalStatus');
    const payment = (order.payment_status || '').toLowerCase();
    statusEl.textContent = payment;
    statusEl.className = 'px-3 py-1 rounded-full text-[10px] font-extrabold uppercase ';
    if (payment === 'pending') {
        statusEl.classList.add('bg-yellow-100', 'text-yellow-600');
    } else if (payment === 'paid') {
        statusEl.classList.add('bg-green-100', 'text-green-600');
    } else if (payment === 'expired' || payment === 'cancelled') {
        statusEl.classList.add('bg-red-100', 'text-red-600');
    } else if (payment === 'refunded') {
        statusEl.classList.add('bg-blue-100', 'text-blue-600');
    } else if (payment === 'refund_failed') {
        statusEl.classList.add('bg-orange-100', 'text-orange-600');
    } else {
        statusEl.classList.add('bg-gray-100', 'text-gray-600');
    }

    // Products
    const productsContainer = document.getElementById('modalProducts');
    productsContainer.innerHTML = '';
    let cart = [];
    try {
        cart = JSON.parse(order.cart_data || '[]');
    } catch (e) {
        cart = [];
    }

    if (cart.length === 0) {
        productsContainer.innerHTML = '<p class="text-sm text-gray-400 italic">No product data</p>';
    } else {
        cart.forEach(item => {
            const div = document.createElement('div');
            div.className = 'flex justify-between items-center bg-gray-50 rounded-xl p-3';
            div.innerHTML = `
                <div>
                    <p class="font-bold text-gray-800 text-sm">${item.name || 'Unknown'}</p>
                    <p class="text-[10px] text-gray-500">Varian: ${item.variant || '-'} &bull; Qty: ${item.qty || 0}</p>
                </div>
                <p class="font-bold text-orange-500 text-sm">Rp ${new Intl.NumberFormat('id-ID').format((item.price || 0) * (item.qty || 0))}</p>
            `;
            productsContainer.appendChild(div);
        });
    }

    // Totals
    document.getElementById('modalSubtotal').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(order.subtotal || 0);
    document.getElementById('modalOngkir').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(order.ongkir || 0);
    document.getElementById('modalTotal').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(order.total || 0);

    // Show modal
    document.getElementById('paymentModal').classList.remove('hidden');
    document.getElementById('paymentModal').classList.add('flex');
}

function closePaymentModal() {
    document.getElementById('paymentModal').classList.add('hidden');
    document.getElementById('paymentModal').classList.remove('flex');
}

// Close modal on backdrop click
document.getElementById('paymentModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closePaymentModal();
    }
});

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closePaymentModal();
    }
});
</script>
<script>
let currentOrderId = null;

function openStatusModal(id) {
    currentOrderId = id;

    const form = document.getElementById('statusFormGlobal');
    form.action = `/admin/orders/${id}/status`;

    document.getElementById('statusModal').classList.remove('hidden');
}

function closeStatusModal() {
    document.getElementById('statusModal').classList.add('hidden');
}

function setStatus(status) {
    document.getElementById('selectedStatus').value = status;
    document.getElementById('statusFormGlobal').submit();
}
</script>