<x-admin-header />

<div class="bg-[#F5F7FB] min-h-screen p-6 lg:p-8">

    <!-- ================= WRAPPER ================= -->
    <div class="bg-white border border-gray-200 rounded-[40px]
                p-5 lg:p-8 shadow-sm">

        <!-- ================= TOP HEADER ================= -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5 mb-8">

            <!-- LEFT -->
            <div class="flex items-start gap-4">

                <div class="w-16 h-16 rounded-2xl bg-[#FFF3E8]
                            flex items-center justify-center
                            text-[#F59A40] text-4xl">
                    📊
                </div>

                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900">
                        Analysis
                    </h1>

                    <p class="text-sm text-gray-500 mt-1">
                        Ringkasan performa bisnis dan penjualan
                    </p>
                </div>

            </div>

            <!-- RIGHT -->
            <div class="flex flex-col sm:flex-row gap-3">

                <!-- DATE (FILTER) -->
                <form method="GET" action="{{ route('admin.analisis') }}" class="bg-white border border-gray-200
                            rounded-2xl px-5 py-3
                            flex items-center gap-3 shadow-sm">

                    <span class="text-lg">📅</span>

                    <input type="date" name="from" value="{{ request('from') }}"
                        class="bg-white border border-gray-200 rounded-xl px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-orange-400">

                    <span class="text-xs text-gray-400">sampai</span>

                    <input type="date" name="to" value="{{ request('to') }}"
                        class="bg-white border border-gray-200 rounded-xl px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-orange-400">

                    <span class="text-xs text-gray-400">▾</span>

                    <button type="submit" class="ml-2 px-4 py-2 bg-orange-100 text-orange-600 rounded-xl text-sm font-semibold hover:bg-orange-200 transition">
                        Terapkan
                    </button>
                </form>

                <!-- EXPORT -->
                <button
                    class="bg-white border border-gray-200
                           rounded-2xl px-5 py-3
                           flex items-center gap-3
                           hover:bg-gray-50 transition shadow-sm">

                    <span>📥</span>

                    <span class="text-sm font-semibold">
                        Export Laporan
                    </span>

                </button>


            </div>

        </div>

        <!-- ================= STATS ================= -->
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-4 mb-8">

            <!-- CARD -->
            <div class="bg-white border border-gray-200 rounded-3xl
                        p-5 shadow-sm">

                <div class="flex gap-4">

                    <div class="w-14 h-14 rounded-2xl
                                bg-orange-100 text-orange-500
                                flex items-center justify-center text-2xl">
                        💰
                    </div>

                    <div>

                        <p class="text-xs text-gray-400">
                            Total Penjualan
                        </p>

                        <h3 class="text-2xl font-extrabold text-gray-800 mt-1">
                            Rp {{ number_format($totalSales, 0, ',', '.') }}
                        </h3>

                        <div class="flex items-center gap-2 mt-1">

                            @if($salesChange >= 0)
                                <span class="text-[11px] text-green-500 font-bold">
                                    ▲ {{ $salesChange }}%
                                </span>
                            @else
                                <span class="text-[11px] text-red-500 font-bold">
                                    ▼ {{ abs($salesChange) }}%
                                </span>
                            @endif

                        </div>

                        <p class="text-[11px] text-gray-400 mt-1">
                            vs {{ $prevDateRange }}
                        </p>

                    </div>

                </div>

            </div>

            <!-- TOTAL ORDER -->
            <div class="bg-white border border-gray-200 rounded-3xl
                        p-5 shadow-sm">

                <div class="flex gap-4">

                    <div class="w-14 h-14 rounded-2xl
                                bg-orange-50 text-orange-400
                                flex items-center justify-center text-2xl">
                        🛒
                    </div>

                    <div>

                        <p class="text-xs text-gray-400">
                            Total Order
                        </p>

                        <h3 class="text-2xl font-extrabold text-gray-800 mt-1">
                            {{ $totalOrders }}
                        </h3>

                        <div class="flex items-center gap-2 mt-1">

                            @if($ordersChange >= 0)
                                <span class="text-[11px] text-green-500 font-bold">
                                    ▲ {{ $ordersChange }}%
                                </span>
                            @else
                                <span class="text-[11px] text-red-500 font-bold">
                                    ▼ {{ abs($ordersChange) }}%
                                </span>
                            @endif

                        </div>

                        <p class="text-[11px] text-gray-400 mt-1">
                            vs {{ $prevDateRange }}
                        </p>

                    </div>

                </div>

            </div>

            <!-- AVG -->
            <div class="bg-white border border-gray-200 rounded-3xl
                        p-5 shadow-sm">

                <div class="flex gap-4">

                    <div class="w-14 h-14 rounded-2xl
                                bg-purple-50 text-purple-500
                                flex items-center justify-center text-2xl">
                        📈
                    </div>

                    <div>

                        <p class="text-xs text-gray-400">
                            Rata-rata Order
                        </p>

                        <h3 class="text-2xl font-extrabold text-gray-800 mt-1">
                            Rp {{ number_format($avgOrder, 0, ',', '.') }}
                        </h3>

                        <div class="flex items-center gap-2 mt-1">

                            @if($avgChange >= 0)
                                <span class="text-[11px] text-green-500 font-bold">
                                    ▲ {{ $avgChange }}%
                                </span>
                            @else
                                <span class="text-[11px] text-red-500 font-bold">
                                    ▼ {{ abs($avgChange) }}%
                                </span>
                            @endif

                        </div>

                        <p class="text-[11px] text-gray-400 mt-1">
                            vs {{ $prevDateRange }}
                        </p>

                    </div>

                </div>

            </div>

            <!-- ORDER SELESAI -->
            <div class="bg-white border border-gray-200 rounded-3xl
                        p-5 shadow-sm">

                <div class="flex gap-4">

                    <div class="w-14 h-14 rounded-2xl
                                bg-green-50 text-green-500
                                flex items-center justify-center text-2xl">
                        ✅
                    </div>

                    <div>

                        <p class="text-xs text-gray-400">
                            Order Selesai
                        </p>

                        <h3 class="text-2xl font-extrabold text-gray-800 mt-1">
                            {{ $completedOrders }}
                        </h3>

                        <div class="flex items-center gap-2 mt-1">

                            <span class="text-[11px] text-green-500 font-bold">
                                ● {{ $totalDelivered }}%
                            </span>

                        </div>

                        <p class="text-[11px] text-gray-400 mt-1">
                            vs {{ $prevDateRange }}
                        </p>

                    </div>

                </div>

            </div>

            <!-- TERLAMBAT -->
            <div class="bg-white border border-gray-200 rounded-3xl
                        p-5 shadow-sm">

                <div class="flex gap-4">

                    <div class="w-14 h-14 rounded-2xl
                                bg-red-50 text-red-500
                                flex items-center justify-center text-2xl">
                        📦
                    </div>

                    <div>

                        <p class="text-xs text-gray-400">
                            Order Terlambat
                        </p>

                        <h3 class="text-2xl font-extrabold text-gray-800 mt-1">
                            {{ $lateOrders }}
                        </h3>

                        <div class="flex items-center gap-2 mt-1">

                            @if($lateChange >= 0)
                                <span class="text-[11px] text-red-500 font-bold">
                                    ▲ {{ $lateChange }}%
                                </span>
                            @else
                                <span class="text-[11px] text-green-500 font-bold">
                                    ▼ {{ abs($lateChange) }}%
                                </span>
                            @endif

                        </div>

                        <p class="text-[11px] text-gray-400 mt-1">
                            vs {{ $prevDateRange }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

        <!-- ================= CHART + DONUT ================= -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">

            <!-- GRAFIK -->
            <div class="xl:col-span-2 bg-white border border-gray-200
                        rounded-[32px] p-6 shadow-sm">

                <div class="flex items-center justify-between mb-6">

                    <h3 class="font-bold text-lg">
                        Grafik Penjualan
                    </h3>

                    <select class="bg-gray-50 border border-gray-200
                                   rounded-xl px-3 py-2 text-sm">

                        <option>Per hari</option>

                    </select>

                </div>

                <!-- LEGEND -->
                <div class="flex gap-6 mb-6 text-sm">

                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-orange-500"></div>
                        <span class="text-gray-500">Penjualan (Rp)</span>
                    </div>

                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-purple-500"></div>
                        <span class="text-gray-500">Order</span>
                    </div>

                </div>

                <!-- CHART -->
                <div class="h-[280px] relative">

                    <!-- GRID -->
                    <div class="absolute inset-0 flex flex-col justify-between">

                        <div class="border-b border-dashed border-gray-200"></div>
                        <div class="border-b border-dashed border-gray-200"></div>
                        <div class="border-b border-dashed border-gray-200"></div>
                        <div class="border-b border-dashed border-gray-200"></div>
                        <div class="border-b border-dashed border-gray-200"></div>

                    </div>

                    <!-- BARS -->
                    <div class="absolute inset-0 flex items-end gap-3">

                        @foreach($monthlySales as $sale)

                        <div class="flex-1 flex flex-col justify-end h-full">

                            <div class="bg-gradient-to-t from-orange-500 to-orange-300
                                        rounded-t-2xl"
                                 style="height:
                                 {{ max($monthlySales) > 0 ? ($sale / max($monthlySales)) * 100 : 0 }}%">
                            </div>

                        </div>

                        @endforeach

                    </div>

                </div>

                <!-- LABEL -->
                <div class="grid grid-cols-7 mt-4 text-xs text-gray-400">

                    @foreach($chartLabels as $label)
                        <div class="text-center">{{ $label }}</div>
                    @endforeach

                </div>

            </div>

            <!-- DONUT -->
            <div class="bg-white border border-gray-200
                        rounded-[32px] p-6 shadow-sm">

                <h3 class="font-bold text-lg mb-8">
                    Penjualan Berdasarkan Kategori
                </h3>

                <!-- DONUT -->
                <div class="flex justify-center mb-8">

                    <div class="relative w-52 h-52 rounded-full
                                bg-[conic-gradient(#FBBF24_0deg_126deg,#F97316_126deg_216deg,#EC4899_216deg_288deg,#8B5CF6_288deg_342deg,#3B82F6_342deg_360deg)]">

                        <div class="absolute inset-[38px]
                                    bg-white rounded-full">
                        </div>

                    </div>

                </div>

                <!-- LIST -->
                <div class="space-y-4">

                    @foreach($categorySales as $cat)

                    <div class="flex items-center justify-between">

                        <div class="flex items-center gap-3">

                            <div class="w-3 h-3 rounded-full bg-orange-400"></div>

                            <span class="text-sm text-gray-700">
                                {{ $cat['name'] }}
                            </span>

                        </div>

                        <div class="text-right">

                            <div class="text-sm font-bold text-gray-800">
                                Rp {{ number_format($cat['value'], 0, ',', '.') }}
                            </div>

                            <div class="text-xs text-gray-400">
                                {{ $cat['percentage'] }}%
                            </div>

                        </div>

                    </div>

                    @endforeach

                </div>

                <!-- TOTAL -->
                <div class="border-t border-gray-200 mt-6 pt-4
                            flex items-center justify-between">

                    <span class="text-gray-400 text-sm">
                        Total
                    </span>

                    <span class="font-bold text-lg text-gray-800">
                        Rp {{ number_format($totalCategorySales, 0, ',', '.') }}
                    </span>

                </div>

            </div>

        </div>

        <!-- ================= TABLES ================= -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">

            <!-- AREA -->
            <div class="bg-white border border-gray-200
                        rounded-[32px] p-5 shadow-sm">

                <div class="flex items-center justify-between mb-5">

                    <h3 class="font-bold text-lg">
                        Penjualan Per Area
                    </h3>

                    <span class="text-[11px] bg-gray-100
                                 px-3 py-1 rounded-full">
                        Top 5 Area ▼
                    </span>

                </div>

                <table class="w-full">

                    <thead class="bg-orange-50 text-[11px] text-gray-500">

                        <tr>
                            <th class="p-3 text-left">Area</th>
                            <th class="p-3 text-right">Penjualan</th>
                        </tr>

                    </thead>

                    <tbody class="text-sm">

                        @foreach($areaSales as $area)

                        <tr class="border-b border-gray-100">

                            <td class="p-3">
                                {{ $area['area'] }}
                            </td>

                            <td class="p-3 text-right font-bold">
                                Rp {{ number_format($area['value'],0,',','.') }}
                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

                <button class="mt-5 text-blue-500 text-sm font-semibold">
                    Lihat semua area →
                </button>

            </div>

            <!-- MENU -->
            <div class="bg-white border border-gray-200
                        rounded-[32px] p-5 shadow-sm">

                <div class="flex items-center justify-between mb-5">

                    <h3 class="font-bold text-lg">
                        Menu Terlaris
                    </h3>

                    <span class="text-[11px] bg-gray-100
                                 px-3 py-1 rounded-full">
                        Top 5 Menu ▼
                    </span>

                </div>

                <table class="w-full">

                    <thead class="bg-orange-50 text-[11px] text-gray-500">

                        <tr>
                            <th class="p-3 text-left">Menu</th>
                            <th class="p-3 text-right">Terjual</th>
                        </tr>

                    </thead>

                    <tbody class="text-sm">

                        @foreach($topProducts as $product)

                        <tr class="border-b border-gray-100">

                            <td class="p-3">
                                {{ $product['name'] }}
                            </td>

                            <td class="p-3 text-right font-bold">
                                {{ $product['qty'] }}
                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

                <button class="mt-5 text-blue-500 text-sm font-semibold">
                    Lihat semua menu →
                </button>

            </div>

            <!-- DRIVER -->
            <div class="bg-white border border-gray-200
                        rounded-[32px] p-5 shadow-sm">

                <div class="flex items-center justify-between mb-5">

                    <h3 class="font-bold text-lg">
                        Performa Driver
                    </h3>

                    <span class="text-[11px] bg-gray-100
                                 px-3 py-1 rounded-full">
                        Top 5 Driver ▼
                    </span>

                </div>

                <table class="w-full">

                    <thead class="bg-orange-50 text-[11px] text-gray-500">

                        <tr>
                            <th class="p-3 text-left">Driver</th>
                            <th class="p-3 text-right">Rating</th>
                        </tr>

                    </thead>

                    <tbody class="text-sm">

                        @foreach($driverPerformance as $driver)

                        <tr class="border-b border-gray-100">

                            <td class="p-3">
                                {{ $driver['name'] }}
                            </td>

                            <td class="p-3 text-right font-bold text-yellow-500">
                                ★ {{ $driver['rating'] }}
                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

                <button class="mt-5 text-blue-500 text-sm font-semibold">
                    Lihat semua driver →
                </button>

            </div>

        </div>

        <!-- ================= INSIGHT ================= -->
        <div class="bg-white border border-gray-200
                    rounded-[32px] p-6 shadow-sm">

            <h3 class="font-bold text-lg mb-5">
                Insight Minggu Ini
            </h3>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

                @foreach($insights as $insight)

                    @if($insight['type'] === 'success')

                    <div class="bg-green-50 border border-green-100
                                rounded-2xl p-5 flex gap-4">

                        <div class="w-12 h-12 rounded-full
                                    bg-green-200 flex items-center
                                    justify-center text-green-700">
                            ↑
                        </div>

                        <div>

                            <h4 class="font-bold text-green-700 text-sm">
                                {{ $insight['title'] }}
                            </h4>

                            <p class="text-xs text-green-600 mt-1">
                                {{ $insight['desc'] }}
                            </p>

                        </div>

                    </div>

                    @elseif($insight['type'] === 'warning')

                    <div class="bg-orange-50 border border-orange-100
                                rounded-2xl p-5 flex gap-4">

                        <div class="w-12 h-12 rounded-full
                                    bg-orange-200 flex items-center
                                    justify-center text-orange-700">
                            ⚠
                        </div>

                        <div>

                            <h4 class="font-bold text-orange-700 text-sm">
                                {{ $insight['title'] }}
                            </h4>

                            <p class="text-xs text-orange-600 mt-1">
                                {{ $insight['desc'] }}
                            </p>

                        </div>

                    </div>

                    @else

                    <div class="bg-purple-50 border border-purple-100
                                rounded-2xl p-5 flex gap-4">

                        <div class="w-12 h-12 rounded-full
                                    bg-purple-200 flex items-center
                                    justify-center text-purple-700">
                            ✦
                        </div>

                        <div>

                            <h4 class="font-bold text-purple-700 text-sm">
                                {{ $insight['title'] }}
                            </h4>

                            <p class="text-xs text-purple-600 mt-1">
                                {{ $insight['desc'] }}
                            </p>

                        </div>

                    </div>

                    @endif

                @endforeach

            </div>

        </div>

    </div>

</div>

<x-scripts-admin />