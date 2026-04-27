<x-admin-header />



<section class="ml-[90px] p-6 bg-[#F6F6F6] min-h-[calc(100vh-120px)]">



    <!-- ================= TOP ================= -->

    <div class="grid grid-cols-12 gap-6">



        <!-- LEFT CONTENT -->

        <div class="col-span-9 space-y-6">



            <!-- CARDS -->

            <div class="grid grid-cols-3 gap-6">



                <!-- TOTAL SALES -->

<div class="bg-gradient-to-r from-[#FF8A00] to-[#F59A40]

            p-6 rounded-[25px] text-white shadow-sm">



    <p class="text-xs opacity-80">Total Sales</p>



    <h2 class="text-2xl font-bold mt-2">

        Rp{{ number_format($totalSales,0,',','.') }}

    </h2>



    <div class="mt-4 h-[6px] bg-white/30 rounded-full">

        <div class="h-[6px] bg-white rounded-full w-[70%]"></div>

    </div>



</div>



                <!-- TOTAL ORDERS -->

                <div class="bg-white/80 backdrop-blur-sm p-6 rounded-3xl shadow border border-gray-200/50">



                    <p class="text-sm text-gray-400">Total Orders</p>



                    <h2 class="text-2xl font-bold mt-2 text-gray-700">

                        {{ number_format($totalOrders,0,',','.') }}

                    </h2>



                    <div class="h-2 bg-orange-100 rounded mt-4">

                        <div class="h-2 bg-[#F59A40] rounded w-[50%]"></div>

                    </div>

                </div>



                <!-- CUSTOMER -->

                <div class="bg-white/80 backdrop-blur-sm p-6 rounded-3xl shadow border border-gray-200/50">



                    <p class="text-sm text-gray-400">Customer</p>



                    <h2 class="text-2xl font-bold mt-2 text-gray-700">

                        {{ number_format($totalCustomers) }}

                    </h2>



                    <div class="h-2 bg-orange-100 rounded mt-4">

                        <div class="h-2 bg-[#F59A40] rounded w-[40%]"></div>

                    </div>

                </div>



            </div>



            <!-- ================= CHART ================= -->

            <div class="bg-white/80 backdrop-blur-sm p-6 rounded-3xl shadow border border-gray-200/50">



                <div class="flex justify-between items-center mb-4">

                    <h3 class="font-semibold text-gray-700">Sales Summary</h3>



                    <select class="text-xs border rounded px-3 py-1 bg-[#F9F9F9]">

                        <option>This Year</option>

                    </select>

                </div>



                <canvas id="chart" height="100"></canvas>



            </div>



            <!-- ================= RECENT ORDERS ================= -->

            <div class="bg-white/80 backdrop-blur-sm p-6 rounded-3xl shadow border border-gray-200/50">



                <div class="flex justify-between mb-4">

                    <h3 class="font-semibold">Recent Orders</h3>



                    <input type="text"

                           placeholder="Enter Keywords..."

                           class="text-xs border rounded-full px-4 py-1 bg-[#F9F9F9]">

                </div>



            <table class="w-full text-sm text-left border-separate border-spacing-y-4">

                <thead>

                    <tr class="bg-[#F2E8DA]/30">

                        <th class="p-4 rounded-l-2xl text-gray-500 font-bold uppercase text-[11px] first:pl-10">Order ID</th>

                        <th class="p-4 text-gray-500 font-bold uppercase text-[11px]">Customer</th>

                        <th class="p-4 text-gray-500 font-bold uppercase text-[11px]">Date</th>

                        <th class="p-4 text-gray-500 font-bold uppercase text-[11px]">Amount</th>

                        <th class="p-4 text-gray-500 font-bold uppercase text-[11px]">Payment</th>

                        <th class="p-4 text-gray-500 font-bold uppercase text-[11px]">Status</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($recentOrders as $order)

                    <tr class="bg-white hover:bg-gray-50 transition-all shadow-sm">

                        <td class="p-5 first:pl-10 rounded-l-3xl font-bold text-orange-500">#{{ $order->midtrans_order_id }}</td>

                        <td class="p-5">

                            <div class="flex items-center gap-3">

                                <img src="https://ui-avatars.com/api/?name={{ urlencode($order->nama_pemesan) }}&background=F59A40&color=fff&bold=true" class="w-10 h-10 rounded-2xl" alt="avatar">

                                <span class="font-bold text-gray-700">{{ $order->nama_pemesan }}</span>

                            </div>

                        </td>

                        <td class="p-5 text-gray-500 font-medium">{{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}</td>

                        <td class="p-5 font-extrabold text-gray-800">Rp{{ number_format($order->total, 0, ',', '.') }}</td>

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

    @else

        bg-gray-100 text-gray-600

    @endif

">

    {{ $payment }}

</span>

</td>

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



    @elseif($orderStatus == 'delivered')

        bg-green-100 text-green-600



            @elseif($orderStatus == 'completed')

        bg-green-100 text-green-600



    @elseif($orderStatus == 'cancelled')

        bg-red-100 text-red-600



    @else

        bg-gray-100 text-gray-600

    @endif

">

    {{ str_replace('_', ' ', $orderStatus) }}

</span>

</td>



</tr>

                        @endforeach

                    </tbody>



                </table>



            </div>



        </div>



        <!-- ================= RIGHT SIDEBAR ================= -->

        <div class="col-span-3">



            <div class="bg-white/80 backdrop-blur-sm p-6 rounded-3xl shadow border border-gray-200/50">



                <h3 class="text-sm font-semibold mb-4 text-gray-600">

                    Best Seller Product

                </h3>



@foreach($bestProducts as $item)

<div class="flex items-center gap-3 mb-4 bg-[#F9F9F9] p-3 rounded-xl">



    <!-- IMAGE -->

    <img src="{{ asset('image-product/'.$item['image']) }}"

         class="w-12 h-12 rounded-lg object-cover">



    <!-- TEXT -->

    <div class="flex-1">

        <p class="text-sm font-medium text-gray-700">

            {{ $item['name'] }}

        </p>

        <p class="text-xs text-gray-400">

            {{ $item['qty'] }} Terjual

        </p>

    </div>



    <!-- BADGE -->

    <span class="text-xs text-orange-500 font-semibold">

        +{{ $item['qty'] }}

    </span>



</div>

@endforeach



            </div>



        </div>



    </div>

            </div> <!-- END SLOT -->

    </div> <!-- END RIGHT -->

</div> <!-- END WRAPPER -->



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

        plugins: {

            legend: {

                position: 'top'

            }

        },

        scales: {

            x: { grid: { display: false }},

            y: { grid: { color: "#eee" }}

        }

    }

});

</script>



<x-scripts-admin />