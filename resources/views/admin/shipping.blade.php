<style>
body { font-family: 'Poppins', sans-serif; }
.stat-value { font-weight: 800; }
</style>

<x-admin-header />

<div class="ml-[90px] p-8 bg-[#F8F9FB] min-h-screen">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
                <span class="p-2.5 bg-[#F59A40] rounded-2xl text-white shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                    </svg>
                </span>
                Shipping Management
            </h1>
            <p class="text-sm text-gray-500 mt-2 font-medium">Manage delivery execution, drivers and schedules</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" id="searchInput" placeholder="Search Order / Customer..."
                    class="pl-12 pr-6 py-3 bg-white border border-gray-200 rounded-2xl text-sm focus:ring-2 focus:ring-orange-400 w-72 shadow-sm transition-all outline-none"
                    onkeyup="filterTable()">
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl flex items-center gap-3 shadow-sm">
        <svg class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        <span class="font-semibold text-sm">{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-2xl flex items-center gap-3 shadow-sm">
        <svg class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        <span class="font-semibold text-sm">{{ session('error') }}</span>
    </div>
    @endif

    <!-- MINI STATS -->
    <div class="grid grid-cols-4 gap-5 mb-8">
        <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-yellow-100 flex items-center justify-center">
                    <svg class="h-5 w-5 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Scheduled</p>
            </div>
            <h2 class="text-3xl stat-value text-gray-800">{{ number_format($stats['scheduled']) }}</h2>
            <p class="text-[10px] text-yellow-600 font-bold bg-yellow-50 px-2 py-1 rounded-lg mt-2 inline-block">Today</p>
        </div>
        <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                    <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Ready to Ship</p>
            </div>
            <h2 class="text-3xl stat-value text-gray-800">{{ number_format($stats['ready']) }}</h2>
            <p class="text-[10px] text-blue-600 font-bold bg-blue-50 px-2 py-1 rounded-lg mt-2 inline-block">Packed</p>
        </div>
        <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-orange-100 flex items-center justify-center">
                    <svg class="h-5 w-5 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg>
                </div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">On Delivery</p>
            </div>
            <h2 class="text-3xl stat-value text-gray-800">{{ number_format($stats['on_delivery']) }}</h2>
            <p class="text-[10px] text-orange-600 font-bold bg-orange-50 px-2 py-1 rounded-lg mt-2 inline-block">Active</p>
        </div>
        <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center">
                    <svg class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Delivered</p>
            </div>
            <h2 class="text-3xl stat-value text-gray-800">{{ number_format($stats['delivered']) }}</h2>
            <p class="text-[10px] text-green-600 font-bold bg-green-50 px-2 py-1 rounded-lg mt-2 inline-block">+{{ $stats['delivered_today'] }} today</p>
        </div>
    </div>

    <!-- FILTER BAR -->
    <form method="GET" action="{{ route('admin.shipping') }}" class="flex flex-wrap gap-3 mb-6 items-center">
        <select name="status" class="bg-white px-4 py-2.5 rounded-xl shadow-sm border border-gray-100 text-sm outline-none focus:ring-2 focus:ring-orange-400">
            <option value="">All Status</option>
            <option value="packed" {{ request('status')=='packed'?'selected':'' }}>Scheduled / Ready</option>
            <option value="shipped" {{ request('status')=='shipped'?'selected':'' }}>On Delivery</option>
            <option value="delivered" {{ request('status')=='delivered'?'selected':'' }}>Delivered</option>
            <option value="completed" {{ request('status')=='completed'?'selected':'' }}>Completed</option>
        </select>
        <input type="date" name="date" value="{{ request('date') }}" class="px-4 py-2.5 rounded-xl shadow-sm border border-gray-100 text-sm outline-none focus:ring-2 focus:ring-orange-400 bg-white">
        <select name="driver" class="bg-white px-4 py-2.5 rounded-xl shadow-sm border border-gray-100 text-sm outline-none focus:ring-2 focus:ring-orange-400">
            <option value="">All Drivers</option>
            @foreach($drivers as $d)
            <option value="{{ $d }}" {{ request('driver')==$d?'selected':'' }}>{{ $d }}</option>
            @endforeach
        </select>
        <input type="hidden" name="search" value="{{ request('search') }}">
        <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition-all">Filter</button>
        <a href="{{ route('admin.shipping') }}" class="text-gray-400 hover:text-gray-600 text-sm px-3 py-2.5">Clear</a>
    </form>

    <!-- TABLE -->
    <div class="bg-white rounded-[2.5rem] shadow-sm p-8 border border-gray-100">
        <div class="flex items-center gap-2 mb-6">
            <span class="text-orange-500 text-xl font-bold">📦</span>
            <h2 class="text-xl font-bold text-gray-800">Shipping Orders</h2>
        </div>
        <div class="overflow-visible">
            <table class="w-full text-sm text-left border-separate border-spacing-y-3" id="shippingTable">
                <thead>
                    <tr class="bg-[#F2E8DA]/30">
                        <th class="p-4 rounded-l-2xl text-gray-500 font-bold uppercase text-[11px] first:pl-10">Order ID</th>
                        <th class="p-4 text-gray-500 font-bold uppercase text-[11px]">Customer</th>
                        <th class="p-4 text-gray-500 font-bold uppercase text-[11px]">Address</th>
                        <th class="p-4 text-gray-500 font-bold uppercase text-[11px]">Delivery Date</th>
                        <th class="p-4 text-gray-500 font-bold uppercase text-[11px]">Time</th>
                        <th class="p-4 text-gray-500 font-bold uppercase text-[11px]">Driver</th>
                        <th class="p-4 text-gray-500 font-bold uppercase text-[11px]">Status</th>
                        <th class="p-4 rounded-r-2xl text-gray-500 font-bold uppercase text-[11px] text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    @php
                        $addr = $order->alamat ?? '';
                        $shortAddr = strlen($addr) > 30 ? substr($addr, 0, 30) . '...' : $addr;
                        $orderStatus = strtolower($order->order_status);
                        $hasDriver = !empty($order->driver);
                    @endphp
                    <tr class="bg-white hover:bg-gray-50 transition-all shadow-sm shipping-row" data-search="{{ strtolower($order->midtrans_order_id.' '.$order->nama_pemesan.' '.$order->nama_penerima) }}">
                        <td class="p-5 first:pl-10 rounded-l-3xl font-bold text-orange-500">#{{ $order->midtrans_order_id }}</td>
                        <td class="p-5">
                            <div class="flex items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($order->nama_pemesan) }}&background=F59A40&color=fff&bold=true" class="w-10 h-10 rounded-2xl" alt="avatar">
                        </td>
                        <td class="p-5 text-gray-500 max-w-[180px]" title="{{ $addr }}">{{ $shortAddr ?: '-' }}</td>
                        <td class="p-5 text-gray-500 font-medium">{{ \Carbon\Carbon::parse($order->tanggal_penerimaan)->format('d M Y') }}</td>
                        <td class="p-5 text-gray-500 font-medium">{{ $order->delivery_time ?: '-' }}</td>
                        <td class="p-5 font-semibold {{ $hasDriver ? 'text-gray-800' : 'text-gray-400' }}">{{ $order->driver ?: '-' }}</td>
                        <td class="p-5">
                            @if($orderStatus == 'packed' && !$hasDriver)
                                <span class="px-4 py-1.5 rounded-full text-[10px] font-bold uppercase bg-yellow-100 text-yellow-600">Scheduled</span>
                            @elseif($orderStatus == 'packed' && $hasDriver)
                                <span class="px-4 py-1.5 rounded-full text-[10px] font-bold uppercase bg-blue-100 text-blue-600">Ready</span>
@elseif($orderStatus == 'shipped')
                                <div>
                                    <span class="block px-4 py-1.5 rounded-full text-[10px] font-bold uppercase bg-orange-100 text-orange-600 mb-1">On Delivery</span>
                                    @if($order->driver)
                                        <span class="block text-[9px] text-orange-700 font-semibold bg-orange-50 px-2 py-0.5 rounded-full">👤 {{ $order->driver }}</span>
                                    @endif
@if($order->shipped_at)
    <span class="block text-[9px] text-orange-800 bg-orange-50/80 px-2 py-0.5 rounded-full mt-0.5">
        {{ \Carbon\Carbon::parse($order->shipped_at)->format('d M Y H:i') }}
    </span>
@endif
                                </div>
                            @elseif($orderStatus == 'delivered')
                                <span class="px-4 py-1.5 rounded-full text-[10px] font-bold uppercase bg-green-100 text-green-600">Delivered</span>
                            @elseif($orderStatus == 'completed')
                                <span class="px-4 py-1.5 rounded-full text-[10px] font-bold uppercase bg-green-100 text-green-700">Completed</span>
                            @endif
                        </td>
                        <td class="p-5 rounded-r-3xl text-center">
                            <div class="flex items-center justify-center gap-2">
                                @if($orderStatus == 'packed' && !$hasDriver)
                                    <button onclick="openQuickAssign({{ $order->id }}, '{{ addslashes($order->nama_pemesan) }}')"
                                            class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1.5 rounded-xl text-[11px] font-bold transition-all shadow-lg shadow-orange-200">Assign</button>
                                @elseif($orderStatus == 'packed' && $hasDriver)
                                    <form action="{{ route('admin.start-delivery', $order->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1.5 rounded-xl text-[11px] font-bold transition-all shadow-lg shadow-green-200">Start Delivery</button>
                                    </form>
                                @elseif($orderStatus == 'shipped')
                                    <form action="{{ route('admin.mark-delivered', $order->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-xl text-[11px] font-bold transition-all shadow-lg shadow-blue-200">Mark Delivered</button>
                                    </form>
                                @else
                                    <button onclick="openDetailModal({{ $order->id }})" class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-3 py-1.5 rounded-xl text-[11px] font-bold transition-all">Detail</button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="p-10 text-center text-gray-400">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                <p class="font-medium">No shipping orders found</p>
                                <p class="text-xs">Orders with status Packed and above, paid only</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
</div>

<!-- DETAIL MODAL -->
<div id="detailModal" class="fixed inset-0 bg-black/30 hidden items-center justify-center z-[9999] backdrop-blur-sm">

    <div class="bg-white rounded-[2rem] shadow-2xl w-[600px] max-w-[95%] max-h-[90vh] overflow-y-auto p-8 relative">

        <!-- CLOSE -->
        <button onclick="closeDetailModal()"
            class="absolute top-6 right-6 w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 text-gray-500 hover:bg-gray-200 transition">
            ✕
        </button>

        <!-- HEADER -->
        <div class="flex items-center gap-3 mb-6">
            <div class="w-12 h-12 rounded-2xl bg-blue-100 flex items-center justify-center text-blue-600">
                📦
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-800">Shipping Detail</h2>
                <p class="text-xs text-gray-500" id="detailOrderId">-</p>
            </div>
        </div>

        <!-- CUSTOMER -->
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div class="bg-gray-50 p-4 rounded-2xl">
                <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Customer</p>
                <p class="font-bold text-gray-800 text-sm" id="detailCustomer">-</p>
            </div>

            <div class="bg-gray-50 p-4 rounded-2xl">
                <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Recipient</p>
                <p class="font-bold text-gray-800 text-sm" id="detailRecipient">-</p>
            </div>

            <div class="bg-gray-50 p-4 rounded-2xl">
                <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Phone</p>
                <p class="font-bold text-gray-800 text-sm" id="detailPhone">-</p>
            </div>

            <div class="bg-gray-50 p-4 rounded-2xl">
                <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Receive Date</p>
                <p class="font-bold text-gray-800 text-sm" id="detailDate">-</p>
            </div>
        </div>

        <!-- ADDRESS -->
        <div class="bg-gray-50 rounded-2xl p-4 mb-6">
            <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Address</p>
            <p class="text-sm text-gray-700" id="detailAddress">-</p>
        </div>

        <!-- PAYMENT -->
        <div class="grid grid-cols-3 gap-4 mb-6">
            <div class="bg-orange-50 p-4 rounded-2xl text-center">
                <p class="text-[10px] font-bold text-orange-400 uppercase mb-1">Payment</p>
                <p class="font-extrabold text-orange-600 text-sm" id="detailMethod">-</p>
            </div>

            <div class="bg-green-50 p-4 rounded-2xl text-center">
                <p class="text-[10px] font-bold text-green-400 uppercase mb-1">Amount</p>
                <p class="font-extrabold text-green-600 text-sm" id="detailAmount">-</p>
            </div>

            <div class="bg-blue-50 p-4 rounded-2xl text-center">
                <p class="text-[10px] font-bold text-blue-400 uppercase mb-1">Shipping</p>
                <p class="font-extrabold text-blue-600 text-sm" id="detailShipping">-</p>
            </div>
        </div>

        <!-- STATUS -->
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center gap-2">
                <span class="text-[10px] font-bold text-gray-400 uppercase">Status:</span>
                                <span id="detailStatus" class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase bg-gray-100 text-gray-600">
                    -
                </span>
            </div>

            <div class="flex items-center gap-2">
                <span class="text-[10px] font-bold text-gray-400 uppercase">Driver:</span>
                <span id="detailDriver" class="text-xs text-gray-600">-</span>
            </div>
        </div>

        <!-- DELIVERY TIME -->
        <div class="mb-6">
            <span class="text-[10px] font-bold text-gray-400 uppercase">Delivery Time:</span>
            <span id="detailDeliveryTime" class="text-xs text-gray-600 ml-2">-</span>
        </div>
        
        <!-- SHIPPED INFO -->
        <div id="detailShippedInfo" class="hidden bg-orange-50 p-3 rounded-xl mb-6">
            <!-- Dynamic JS content -->
        </div>

        <!-- NOTE -->
        <div id="detailNoteBox" class="bg-yellow-50 rounded-2xl p-4 mb-6 hidden">
            <p class="text-[10px] font-bold text-yellow-600 uppercase mb-1">Note</p>
            <p class="text-sm text-yellow-800" id="detailNote">-</p>
        </div>

        <!-- PRODUCTS -->
        <div class="mb-6">
            <h3 class="text-sm font-bold text-gray-800 mb-3">Product Details</h3>
            <div id="detailProducts" class="space-y-3"></div>
        </div>

        <!-- TOTAL -->
        <div class="border-t pt-4">
            <div class="flex justify-between">
                <span class="text-sm font-bold text-gray-500">Subtotal</span>
                <span id="detailSubtotal" class="font-bold">-</span>
            </div>

            <div class="flex justify-between mt-2">
                <span class="text-sm font-bold text-gray-500">Shipping Cost</span>
                <span id="detailOngkir" class="font-bold">-</span>
            </div>

            <div class="flex justify-between mt-3 pt-3 border-t">
                <span class="font-extrabold text-gray-800">Total</span>
                <span id="detailTotal" class="font-extrabold text-orange-500">-</span>
            </div>
        </div>

    </div>
</div>

<!-- QUICK ASSIGN MODAL -->
<div id="quickAssignModal"
     class="fixed inset-0 bg-black/30 hidden items-center justify-center z-[9999] backdrop-blur-sm">

    <div class="bg-white rounded-[2rem] shadow-2xl w-[420px] max-w-[95%] p-8 relative">

        <!-- CLOSE -->
        <button onclick="closeQuickAssign()"
            class="absolute top-6 right-6 w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 text-gray-500 hover:bg-gray-200 transition-colors">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <!-- HEADER -->
        <div class="flex items-center gap-3 mb-6">
            <div class="w-12 h-12 rounded-2xl bg-orange-100 flex items-center justify-center text-orange-600">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-800">Assign Driver</h2>
                <p class="text-xs text-gray-500">
                    Order for
                    <span id="assignCustomerName" class="font-bold text-orange-500">-</span>
                </p>
            </div>
        </div>

        <!-- FORM -->
        <form id="quickAssignForm" method="POST" action="">
            @csrf

            <div class="space-y-4">

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2">
                        Driver Name
                    </label>
                    <input type="text" name="driver" required
                        placeholder="Enter driver name..."
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-400 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2">
                        Delivery Time
                    </label>
                    <input type="text" name="delivery_time" required
                        placeholder="e.g. 14:00 - 16:00"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-400 outline-none">
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-xl font-bold text-sm transition-all shadow-lg shadow-orange-200">
                        Assign Driver
                    </button>
                </div>

            </div>
        </form>

    </div>
</div>

<script>
const ordersData = @json($orders);

function filterTable() {
    const input = document.getElementById('searchInput').value.toLowerCase();
    const rows = document.querySelectorAll('.shipping-row');
    rows.forEach(row => {
        const search = row.getAttribute('data-search');
        row.style.display = search.includes(input) ? '' : 'none';
    });
}

function openDetailModal(orderId) {
    const order = ordersData.find(o => o.id === orderId);
    if (!order) return;

    document.getElementById('detailOrderId').textContent = '#' + (order.midtrans_order_id || order.id);
    document.getElementById('detailCustomer').textContent = order.nama_pemesan || '-';
    document.getElementById('detailRecipient').textContent = order.nama_penerima || '-';
    document.getElementById('detailPhone').textContent = order.no_hp || '-';
    document.getElementById('detailDate').textContent = order.tanggal_penerimaan || '-';
    document.getElementById('detailAddress').textContent = order.alamat || '-';
    document.getElementById('detailMethod').textContent = order.payment_method || '-';
    document.getElementById('detailAmount').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(order.total || 0);
    document.getElementById('detailShipping').textContent = (order.shipping_method || '-').toUpperCase();
    document.getElementById('detailDriver').textContent = order.driver || '-';
    document.getElementById('detailDeliveryTime').textContent = order.delivery_time || '-';
    
    // Shipped info
    const shippedInfo = document.getElementById('detailShippedInfo');
    if (order.shipped_at && order.driver) {
        shippedInfo.innerHTML = `<span class="text-xs font-bold text-orange-600">🚚 Dikirim oleh ${order.driver} pada ${new Date(order.shipped_at).toLocaleString('id-ID', {day:'numeric', month:'short', year:'numeric', hour:'2-digit', minute:'2-digit'})}</span>`;
        shippedInfo.classList.remove('hidden');
    } else {
        shippedInfo.classList.add('hidden');
    }

    const statusEl = document.getElementById('detailStatus');
    const orderStatus = (order.order_status || '').toLowerCase();
    statusEl.textContent = orderStatus.replaceAll('_', ' ');
    statusEl.className = 'px-3 py-1 rounded-full text-[10px] font-extrabold uppercase ';
    if (orderStatus === 'packed') {
        statusEl.classList.add('bg-purple-100', 'text-purple-600');
    } else if (orderStatus === 'shipped') {
        statusEl.classList.add('bg-indigo-100', 'text-indigo-600');
    } else if (orderStatus === 'delivered') {
        statusEl.classList.add('bg-green-100', 'text-green-600');
    } else if (orderStatus === 'completed') {
        statusEl.classList.add('bg-green-100', 'text-green-700');
    } else {
        statusEl.classList.add('bg-gray-100', 'text-gray-600');
    }

    const noteBox = document.getElementById('detailNoteBox');
    if (order.catatan) {
        noteBox.classList.remove('hidden');
        document.getElementById('detailNote').textContent = order.catatan;
    } else {
        noteBox.classList.add('hidden');
    }

    const productsContainer = document.getElementById('detailProducts');
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

    document.getElementById('detailSubtotal').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(order.subtotal || 0);
    document.getElementById('detailOngkir').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(order.ongkir || 0);
    document.getElementById('detailTotal').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(order.total || 0);

    const modal = document.getElementById('detailModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeDetailModal() {
    const modal = document.getElementById('detailModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

const assignRouteTemplate = "{{ route('admin.assign-driver', ':orderId') }}";

function openQuickAssign(orderId, customerName) {
    const form = document.getElementById('quickAssignForm');
    form.action = assignRouteTemplate.replace(':orderId', orderId);
    document.getElementById('assignCustomerName').textContent = customerName || '-';
    const modal = document.getElementById('quickAssignModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeQuickAssign() {
    const modal = document.getElementById('quickAssignModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

document.getElementById('detailModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDetailModal();
    }
});

document.getElementById('quickAssignModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeQuickAssign();
    }
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDetailModal();
        closeQuickAssign();
    }
});
</script>

</div>

<x-scripts-admin />
