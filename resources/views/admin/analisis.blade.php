<x-admin-header />
<div class="bg-[#F4F7FE] p-8 min-h-screen font-sans text-gray-700">
    
<div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4 mb-6">
    
    <div>
        <h1 class="text-xl lg:text-2xl font-bold text-gray-800">Analysis</h1>
        <p class="text-xs lg:text-sm text-gray-500">Ringkasan performa bisnis dan penjualan</p>
    </div>

    <div class="flex flex-col sm:flex-row gap-2 sm:gap-4 w-full lg:w-auto">
        
        <div class="flex items-center justify-between sm:justify-start bg-white px-3 py-2 rounded-xl border border-gray-200 shadow-sm w-full sm:w-auto">
            <span class="mr-2 text-gray-400">📅</span>
            <span class="text-xs lg:text-sm font-medium">{{ $dateRange }}</span>
            <span class="ml-2 text-xs">▼</span>
        </div>

        <button class="flex items-center justify-center bg-white px-3 py-2 rounded-xl border border-gray-200 shadow-sm hover:bg-gray-50 w-full sm:w-auto">
            <span class="mr-2">📥</span>
            <span class="text-xs lg:text-sm font-medium">Export</span>
        </button>

    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3 lg:gap-4 mb-6">    
    {{-- Total Penjualan --}}
    <div class="col-span-1 lg:col-span-2 bg-white p-4 lg:p-6 rounded-3xl shadow-sm border border-gray-100">
        <div class="flex items-center gap-3 mb-2">
            <div class="p-2 bg-orange-100 rounded-lg text-orange-500 text-xl">💰</div>
            <div>
                <p class="text-xs text-gray-400">Total Penjualan</p>
                <div class="flex items-center gap-1">
                    <span class="font-bold">Rp {{ number_format($totalSales, 0, ',', '.') }}</span>
                    @if($salesChange >= 0)
                    <span class="text-[10px] text-green-500 font-bold">▲ {{ $salesChange }}%</span>
                    @else
                    <span class="text-[10px] text-red-500 font-bold">▼ {{ abs($salesChange) }}%</span>
                    @endif
                </div>
            </div>
        </div>
        <p class="text-[10px] text-gray-400">vs {{ $prevDateRange }}</p>
    </div>

    {{-- Total Order --}}
    <div class="col-span-1 lg:col-span-2 bg-white p-4 lg:p-6 rounded-3xl shadow-sm border border-gray-100">
        <div class="flex items-center gap-3 mb-2">
            <div class="p-2 bg-orange-50 rounded-lg text-orange-400 text-xl">🛒</div>
            <div>
                <p class="text-xs text-gray-400">Total Order</p>
                <div class="flex items-center gap-1">
                    <span class="font-bold">{{ $totalOrders }}</span>
                    @if($ordersChange >= 0)
                    <span class="text-[10px] text-green-500 font-bold">▲ {{ $ordersChange }}%</span>
                    @else
                    <span class="text-[10px] text-red-500 font-bold">▼ {{ abs($ordersChange) }}%</span>
                    @endif
                </div>
            </div>
        </div>
        <p class="text-[10px] text-gray-400">vs {{ $prevDateRange }}</p>
    </div>

    {{-- Rata-rata Order --}}
    <div class="col-span-1 lg:col-span-2 bg-white p-4 lg:p-6 rounded-3xl shadow-sm border border-gray-100">
        <div class="flex items-center gap-3 mb-2">
            <div class="p-2 bg-purple-50 rounded-lg text-purple-500 text-xl">📈</div>
            <div>
                <p class="text-xs text-gray-400">Rata-rata Order</p>
                <div class="flex items-center gap-1">
                    <span class="font-bold">Rp {{ number_format($avgOrder, 0, ',', '.') }}</span>
                    @if($avgChange >= 0)
                    <span class="text-[10px] text-green-500 font-bold">▲ {{ $avgChange }}%</span>
                    @else
                    <span class="text-[10px] text-red-500 font-bold">▼ {{ abs($avgChange) }}%</span>
                    @endif
                </div>
            </div>
        </div>
        <p class="text-[10px] text-gray-400">vs {{ $prevDateRange }}</p>
    </div>

    {{-- Order Selesai --}}
    <div class="col-span-1 lg:col-span-2 bg-white p-4 lg:p-6 rounded-3xl shadow-sm border border-gray-100">
        <div class="flex items-center gap-3 mb-2">
            <div class="p-2 bg-green-50 rounded-lg text-green-500 text-xl">✅</div>
            <div>
                <p class="text-xs text-gray-400">Order Selesai</p>
                <div class="flex items-center gap-1">
                    <span class="font-bold">{{ $completedOrders }}</span>
                    <span class="text-[10px] text-green-500 font-bold">● {{ $totalDelivered }}%</span>
                </div>
            </div>
        </div>
        <p class="text-[10px] text-gray-400">vs {{ $prevDateRange }}</p>
    </div>

    {{-- Order Terlambat --}}
    <div class="col-span-1 lg:col-span-2 bg-white p-4 lg:p-6 rounded-3xl shadow-sm border border-gray-100">
        <div class="flex items-center gap-3 mb-2">
            <div class="p-2 bg-red-50 rounded-lg text-red-500 text-xl">📦</div>
            <div>
                <p class="text-xs text-gray-400">Order Terlambat</p>
                <div class="flex items-center gap-1">
                    <span class="font-bold">{{ $lateOrders }}</span>
                    @if($lateChange >= 0)
                    <span class="text-[10px] text-red-500 font-bold">▲ {{ $lateChange }}%</span>
                    @else
                    <span class="text-[10px] text-green-500 font-bold">▼ {{ abs($lateChange) }}%</span>
                    @endif
                </div>
            </div>
        </div>
        <p class="text-[10px] text-gray-400">vs {{ $prevDateRange }}</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <div class="col-span-1 lg:col-span-2 bg-white p-4 lg:p-6 rounded-3xl shadow-sm border border-gray-100">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-bold">Grafik Penjualan</h3>
            <select class="text-xs bg-gray-50 border border-gray-200 rounded px-2 py-1">
                <option>Per hari</option>
            </select>
        </div>
        <div class="h-48 w-full bg-gray-50 rounded-xl flex items-end p-4 relative overflow-hidden">
            {{-- Simple chart bars using HTML/CSS --}}
            <div class="absolute inset-0 flex items-end justify-around px-4 pb-8 gap-2">
                @foreach($monthlySales as $index => $sale)
<div class="flex flex-col items-center flex-1">
                    <div class="w-full bg-orange-500 rounded-t hover:bg-orange-600 transition-colors" 
                         style="height: {{ $totalSales > 0 && max($monthlySales) > 0 ? round($sale / max($monthlySales) * 100) : 0 }}%"
                         title="Rp {{ number_format($sale, 0, ',', '.') }}"></div>
                </div>
                @endforeach
            </div>
            <div class="w-full h-px bg-gray-200 absolute bottom-12"></div>
            <div class="w-full h-px bg-gray-200 absolute bottom-24"></div>
        </div>
        <div class="flex justify-around mt-2 text-xs text-gray-500">
            @foreach($chartLabels as $label)
            <span>{{ $label }}</span>
            @endforeach
        </div>
    </div>

    <div class="bg-white p-4 lg:p-6 rounded-3xl shadow-sm border border-gray-100">
        <h3 class="font-bold mb-4">Penjualan Berdasarkan Kategori</h3>
        <div class="flex flex-col items-center">
            <div class="w-32 h-32 rounded-full border-[15px] border-orange-500 mb-4 flex items-center justify-center">
            </div>
            <div class="w-full space-y-2">
                @foreach($categorySales as $cat)
                <div class="flex justify-between text-xs items-center">
                    <div class="flex items-center">
                        @if($cat['name'] === 'Masakan')
                        <span class="w-2 h-2 bg-yellow-400 rounded-full mr-2"></span>
                        @elseif($cat['name'] === 'Kue Kering')
                        <span class="w-2 h-2 bg-orange-500 rounded-full mr-2"></span>
                        @elseif($cat['name'] === 'Minuman')
                        <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                        @else
                        <span class="w-2 h-2 bg-gray-400 rounded-full mr-2"></span>
                        @endif
                        {{ $cat['name'] }}
                    </div>
                    <span class="font-bold">Rp {{ number_format($cat['value'], 0, ',', '.') }} ({{ $cat['percentage'] }}%)</span>
                </div>
                @endforeach
                <div class="flex justify-between text-xs items-center text-gray-400 border-t pt-2">
                    <span>Total</span>
                    <span class="font-bold text-gray-800">Rp {{ number_format($totalCategorySales, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6 text-sm">

    {{-- Penjualan Per Area --}}
    <div class="bg-white p-5 rounded-3xl shadow-sm border border-gray-100">

        <div class="flex justify-between items-center mb-4">
            <h3 class="font-bold">Penjualan Per Area</h3>
            <span class="text-[10px] bg-gray-100 px-2 py-1 rounded">Top 5 Area ▼</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[400px]">

                <thead class="bg-orange-50 text-[10px] text-gray-500 uppercase">
                    <tr>
                        <th class="p-2 text-left">Area</th>
                        <th class="p-2 text-right">Penjualan</th>
                    </tr>
                </thead>

                <tbody class="text-xs">
                    @forelse($areaSales as $area)
                    <tr class="border-b border-gray-50">
                        <td class="p-2">{{ $area['area'] }}</td>
                        <td class="p-2 text-right font-bold">
                            Rp {{ number_format($area['value'], 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr class="border-b border-gray-50">
                        <td class="p-2 text-gray-400" colspan="2">
                            Belum ada data
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <button class="mt-4 text-blue-500 text-xs font-bold">
            Lihat semua area →
        </button>
    </div>

    {{-- Menu Terlaris --}}
    <div class="bg-white p-5 rounded-3xl shadow-sm border border-gray-100">

        <div class="flex justify-between items-center mb-4">
            <h3 class="font-bold">Menu Terlaris</h3>
            <span class="text-[10px] bg-gray-100 px-2 py-1 rounded">Top 5 Menu ▼</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[400px]">

                <thead class="bg-orange-50 text-[10px] text-gray-500">
                    <tr>
                        <th class="p-2 text-left uppercase">Menu</th>
                        <th class="p-2 text-right uppercase">Terjual</th>
                    </tr>
                </thead>

                <tbody class="text-xs">
                    @forelse($topProducts as $product)
                    <tr class="border-b border-gray-50">
                        <td class="p-2">{{ $product['name'] }}</td>
                        <td class="p-2 text-right font-bold">{{ $product['qty'] }}</td>
                    </tr>
                    @empty
                    <tr class="border-b border-gray-50">
                        <td class="p-2 text-gray-400" colspan="2">
                            Belum ada data
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <button class="mt-4 text-blue-500 text-xs font-bold">
            Lihat semua menu →
        </button>
    </div>

    {{-- Performa Driver --}}
    <div class="bg-white p-5 rounded-3xl shadow-sm border border-gray-100">

        <div class="flex justify-between items-center mb-4">
            <h3 class="font-bold">Performa Driver</h3>
            <span class="text-[10px] bg-gray-100 px-2 py-1 rounded">Top 5 Driver ▼</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[400px]">

                <thead class="bg-orange-50 text-[10px] text-gray-500">
                    <tr>
                        <th class="p-2 text-left">DRIVER</th>
                        <th class="p-2 text-right">RATING</th>
                    </tr>
                </thead>

                <tbody class="text-xs">
                    @forelse($driverPerformance as $driver)
                    <tr>
                        <td class="p-2">{{ $driver['name'] }}</td>
                        <td class="p-2 text-right font-bold text-yellow-500">
                            ★ {{ $driver['rating'] }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="p-2 text-gray-400" colspan="2">
                            Belum ada data
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <button class="mt-4 text-blue-500 text-xs font-bold">
            Lihat semua driver →
        </button>
    </div>

</div>
{{-- Insights Section --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse($insights as $insight)
        @if($insight['type'] === 'success')
        <div class="bg-green-50 p-4 rounded-2xl border border-green-100 flex gap-3 items-center">
            <div class="w-10 h-10 bg-green-200 rounded-full flex items-center justify-center">✓</div>
            <div>
                <p class="text-green-700 font-bold text-xs">{{ $insight['title'] }}</p>
                <p class="text-[10px] text-green-600">{{ $insight['desc'] }}</p>
            </div>
        </div>
        @elseif($insight['type'] === 'warning')
        <div class="bg-orange-50 p-4 rounded-2xl border border-orange-100 flex gap-3 items-center">
            <div class="w-10 h-10 bg-orange-200 rounded-full flex items-center justify-center">⚠</div>
            <div>
                <p class="text-orange-700 font-bold text-xs">{{ $insight['title'] }}</p>
                <p class="text-[10px] text-orange-600">{{ $insight['desc'] }}</p>
            </div>
        </div>
        @else
        <div class="bg-purple-50 p-4 rounded-2xl border border-purple-100 flex gap-3 items-center">
            <div class="w-10 h-10 bg-purple-200 rounded-full flex items-center justify-center">ℹ</div>
            <div>
                <p class="text-purple-700 font-bold text-xs">{{ $insight['title'] }}</p>
                <p class="text-[10px] text-purple-600">{{ $insight['desc'] }}</p>
            </div>
        </div>
        @endif
    @empty
    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-200 flex gap-3 items-center col-span-3">
        <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center">📊</div>
        <div>
            <p class="text-gray-700 font-bold text-xs">Belum ada insight</p>
            <p class="text-[10px] text-gray-500">Data akan muncul setelah ada transaksi.</p>
        </div>
    </div>
    @endforelse
</div>
</div>

<x-scripts-admin />
