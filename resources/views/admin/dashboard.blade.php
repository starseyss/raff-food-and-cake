<x-admin-header />

<section class="lg:ml-[90px] p-3 md:p-6 bg-[#F6F6F6] min-h-[calc(100vh-120px)] overflow-x-hidden">

    <!-- ================= TOP ================= -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-4 md:gap-6">

        <!-- ================= LEFT CONTENT ================= -->
        <div class="xl:col-span-9 space-y-4 md:space-y-6 min-w-0">

            <!-- ================= CARDS ================= -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">

                <!-- TOTAL SALES -->
                <div class="bg-gradient-to-r from-[#FF8A00] to-[#F59A40]
                            p-4 md:p-6 rounded-2xl md:rounded-[25px]
                            text-white shadow-sm">

                    <p class="text-xs opacity-80">Total Sales</p>

                    <h2 class="text-xl md:text-2xl font-bold mt-2 break-words">
                        Rp{{ number_format($totalSales,0,',','.') }}
                    </h2>

                    <div class="mt-3 md:mt-4 h-[6px] bg-white/30 rounded-full">
                        <div class="h-[6px] bg-white rounded-full w-[70%]"></div>
                    </div>
                </div>

                <!-- TOTAL ORDERS -->
                <div class="bg-white/80 backdrop-blur-sm
                            p-4 md:p-6 rounded-2xl md:rounded-3xl
                            shadow border border-gray-200/50">

                    <p class="text-xs md:text-sm text-gray-400">
                        Total Orders
                    </p>

                    <h2 class="text-xl md:text-2xl font-bold mt-2 text-gray-700">
                        {{ number_format($totalOrders,0,',','.') }}
                    </h2>

                    <div class="h-1.5 md:h-2 bg-orange-100 rounded mt-3 md:mt-4">
                        <div class="h-1.5 md:h-2 bg-[#F59A40] rounded w-[50%]"></div>
                    </div>
                </div>

                <!-- CUSTOMER -->
                <div class="bg-white/80 backdrop-blur-sm
                            p-4 md:p-6 rounded-2xl md:rounded-3xl
                            shadow border border-gray-200/50">

                    <p class="text-xs md:text-sm text-gray-400">
                        Customer
                    </p>

                    <h2 class="text-xl md:text-2xl font-bold mt-2 text-gray-700">
                        {{ number_format($totalCustomers) }}
                    </h2>

                    <div class="h-1.5 md:h-2 bg-orange-100 rounded mt-3 md:mt-4">
                        <div class="h-1.5 md:h-2 bg-[#F59A40] rounded w-[40%]"></div>
                    </div>
                </div>

            </div>

            <!-- ================= CHART ================= -->
            <div class="bg-white/80 backdrop-blur-sm
                        p-4 md:p-6 rounded-2xl md:rounded-3xl
                        shadow border border-gray-200/50 overflow-hidden">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">

                    <h3 class="font-semibold text-gray-700 text-sm md:text-base">
                        Sales Summary
                    </h3>

                    <select class="text-xs border rounded-lg px-3 py-2 bg-[#F9F9F9] w-full sm:w-auto">
                        <option>This Year</option>
                    </select>

                </div>

                <div class="w-full overflow-x-auto">
                    <div class="min-w-[600px] md:min-w-0">
                        <canvas id="chart" height="100"></canvas>
                    </div>
                </div>

            </div>

            <!-- ================= RECENT ORDERS ================= -->
            <div class="bg-white/80 backdrop-blur-sm
                        p-4 md:p-6 rounded-2xl md:rounded-3xl
                        shadow border border-gray-200/50 overflow-hidden">

                <!-- TOP -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">

                    <h3 class="font-semibold text-sm md:text-base">
                        Recent Orders
                    </h3>

                    <input type="text"
                           placeholder="Enter Keywords..."
                           class="w-full md:w-[250px]
                                  text-xs border rounded-full
                                  px-4 py-2 bg-[#F9F9F9] outline-none">
                </div>

                <!-- MOBILE CARD -->
                <div class="block lg:hidden space-y-4">

                    @foreach($recentOrders as $order)

                    @php
                        $payment = strtolower($order->payment_status);
                        $orderStatus = strtolower($order->order_status);
                    @endphp

                    <div class="border border-gray-200 rounded-2xl p-4 bg-white">

                        <div class="flex items-center gap-3 mb-4">

                            <img src="https://ui-avatars.com/api/?name={{ urlencode($order->nama_pemesan) }}&background=F59A40&color=fff&bold=true"
                                 class="w-12 h-12 rounded-xl">

                            <div class="min-w-0">
                                <p class="font-semibold text-gray-800 truncate">
                                    {{ $order->nama_pemesan }}
                                </p>

                                <p class="text-xs text-gray-500">
                                    #{{ $order->midtrans_order_id }}
                                </p>
                            </div>

                        </div>

                        <div class="space-y-2 text-sm">

                            <div class="flex justify-between gap-3">
                                <span class="text-gray-500">Tanggal</span>
                                <span class="font-medium text-right">
                                    {{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}
                                </span>
                            </div>

                            <div class="flex justify-between gap-3">
                                <span class="text-gray-500">Total</span>
                                <span class="font-bold text-[#F59A40] text-right">
                                    Rp{{ number_format($order->total, 0, ',', '.') }}
                                </span>
                            </div>

                            <div class="flex justify-between items-center gap-3">
                                <span class="text-gray-500">Payment</span>

                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase

                                    @if($payment == 'pending')
                                        bg-yellow-100 text-yellow-600
                                    @elseif($payment == 'paid')
                                        bg-green-100 text-green-600
                                    @elseif($payment == 'expired' || $payment == 'cancelled')
                                        bg-red-100 text-red-600
                                    @else
                                        bg-gray-100 text-gray-600
                                    @endif">

                                    {{ $payment }}

                                </span>
                            </div>

                            <div class="flex justify-between items-center gap-3">
                                <span class="text-gray-500">Status</span>

                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase

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
                            </div>

                        </div>

                    </div>

                    @endforeach

                </div>

                <!-- DESKTOP TABLE -->
                <div class="hidden lg:block overflow-x-auto">

                    <table class="w-full min-w-[1000px]
                                  text-sm text-left
                                  border-separate border-spacing-y-4">

                        <thead>

                            <tr class="bg-[#F2E8DA]/30">

                                <th class="p-4 rounded-l-2xl text-gray-500 font-bold uppercase text-[11px] first:pl-10">
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

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($recentOrders as $order)

                            @php
                                $payment = strtolower($order->payment_status);
                                $orderStatus = strtolower($order->order_status);
                            @endphp

                            <tr class="bg-white hover:bg-gray-50 transition-all shadow-sm">

                                <td class="p-5 first:pl-10 rounded-l-3xl font-bold text-orange-500">
                                    #{{ $order->midtrans_order_id }}
                                </td>

                                <td class="p-5">

                                    <div class="flex items-center gap-3">

                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($order->nama_pemesan) }}&background=F59A40&color=fff&bold=true"
                                             class="w-10 h-10 rounded-2xl">

                                        <span class="font-bold text-gray-700">
                                            {{ $order->nama_pemesan }}
                                        </span>

                                    </div>

                                </td>

                                <td class="p-5 text-gray-500 font-medium">
                                    {{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}
                                </td>

                                <td class="p-5 font-extrabold text-gray-800">
                                    Rp{{ number_format($order->total, 0, ',', '.') }}
                                </td>

                                <td class="p-5">

                                    <span class="px-4 py-1.5 rounded-full text-[10px] font-extrabold uppercase

                                        @if($payment == 'pending')
                                            bg-yellow-100 text-yellow-600
                                        @elseif($payment == 'paid')
                                            bg-green-100 text-green-600
                                        @elseif($payment == 'expired' || $payment == 'cancelled')
                                            bg-red-100 text-red-600
                                        @else
                                            bg-gray-100 text-gray-600
                                        @endif">

                                        {{ $payment }}

                                    </span>

                                </td>

                                <td class="p-5">

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

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <!-- ================= RIGHT SIDEBAR ================= -->
        <div class="xl:col-span-3">

            <div class="bg-white/80 backdrop-blur-sm
                        p-4 md:p-6 rounded-2xl md:rounded-3xl
                        shadow border border-gray-200/50">

                <h3 class="text-sm font-semibold mb-4 text-gray-600">
                    Best Seller Product
                </h3>

                <div class="space-y-4">

                    @foreach($bestProducts as $item)

                    <div class="flex items-center gap-3 bg-[#F9F9F9] p-3 rounded-xl">

                        <img src="{{ asset('image-product/'.$item['image']) }}"
                             class="w-12 h-12 rounded-lg object-cover shrink-0">

                        <div class="flex-1 min-w-0">

                            <p class="text-sm font-medium text-gray-700 truncate">
                                {{ $item['name'] }}
                            </p>

                            <p class="text-xs text-gray-400">
                                {{ $item['qty'] }} Terjual
                            </p>

                        </div>

                        <span class="text-xs text-orange-500 font-semibold shrink-0">
                            +{{ $item['qty'] }}
                        </span>

                    </div>

                    @endforeach

                </div>

            </div>

        </div>

    </div>

</section>

<!-- ================= CHART ================= -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('chart').getContext('2d');

const gradient1 = ctx.createLinearGradient(0, 0, 0, 300);
gradient1.addColorStop(0, "rgba(245,154,64,0.4)");
gradient1.addColorStop(1, "rgba(245,154,64,0)");

const gradient2 = ctx.createLinearGradient(0, 0, 0, 300);
gradient2.addColorStop(0, "rgba(255,138,0,0.4)");
gradient2.addColorStop(1, "rgba(255,138,0,0)");

new Chart(ctx, {
    type: 'line',

    data: {
        labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],

        datasets: [
            {
                label: 'Sales',
                data: @json($monthlySales),
                borderColor: '#F59A40',
                backgroundColor: gradient1,
                fill: true,
                tension: 0.4
            },

            {
                label: 'Orders',
                data: @json($monthlyOrders),
                borderColor: '#FF8A00',
                backgroundColor: gradient2,
                fill: true,
                tension: 0.4
            }
        ]
    },

    options: {
        responsive: true,
        maintainAspectRatio: false,

        plugins: {
            legend: {
                position: 'top'
            }
        },

        scales: {
            x: {
                grid: {
                    display: false
                }
            },

            y: {
                grid: {
                    color: "#eee"
                }
            }
        }
    }
});
</script>

<x-scripts-admin />