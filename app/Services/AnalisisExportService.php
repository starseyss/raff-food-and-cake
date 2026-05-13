<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Produk;
use Carbon\Carbon;

class AnalisisExportService
{
    public function getAnalisisDataForMonth(int $year, int $month): array
    {
        $startDate = Carbon::createFromDate($year, $month, 1)->startOfDay();
        $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth()->endOfDay();

        // Previous period with same length
        $days = $startDate->diffInDays($endDate) + 1;
        $prevEndDate = $startDate->copy()->subDay()->endOfDay();
        $prevStartDate = $prevEndDate->copy()->subDays($days - 1)->startOfDay();

        $totalSales = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('payment_status', 'paid')
            ->sum('total');

        $prevTotalSales = Order::whereBetween('created_at', [$prevStartDate, $prevEndDate])
            ->where('payment_status', 'paid')
            ->sum('total');

        $salesChange = $prevTotalSales > 0
            ? round(($totalSales - $prevTotalSales) / $prevTotalSales * 100, 1)
            : 0;

        $totalOrders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $prevTotalOrders = Order::whereBetween('created_at', [$prevStartDate, $prevEndDate])
            ->count();

        $ordersChange = $prevTotalOrders > 0
            ? round(($totalOrders - $prevTotalOrders) / $prevTotalOrders * 100, 1)
            : 0;

        $avgOrder = $totalOrders > 0 ? round($totalSales / $totalOrders) : 0;
        $prevAvgOrder = $prevTotalOrders > 0 ? round($prevTotalSales / $prevTotalOrders) : 0;

        $avgChange = $prevAvgOrder > 0
            ? round(($avgOrder - $prevAvgOrder) / $prevAvgOrder * 100, 1)
            : 0;

        $completedOrders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('order_status', 'delivered')
            ->count();

        $totalDelivered = $totalOrders > 0 ? round($completedOrders / $totalOrders * 100) : 0;

        $lateOrders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->whereNotNull('delivered_at')
            ->whereNotNull('tanggal_penerimaan')
            ->get()
            ->filter(function ($order) {
                $deliveredAt = Carbon::parse($order->delivered_at);
                $tanggalPenerimaan = Carbon::parse($order->tanggal_penerimaan);
                return $deliveredAt->greaterThan($tanggalPenerimaan);
            })
            ->count();

        $prevLateOrders = Order::whereBetween('created_at', [$prevStartDate, $prevEndDate])
            ->whereNotNull('delivered_at')
            ->whereNotNull('tanggal_penerimaan')
            ->get()
            ->filter(function ($order) {
                $deliveredAt = Carbon::parse($order->delivered_at);
                $tanggalPenerimaan = Carbon::parse($order->tanggal_penerimaan);
                return $deliveredAt->greaterThan($tanggalPenerimaan);
            })
            ->count();

        $lateChange = $prevLateOrders > 0
            ? round(($lateOrders - $prevLateOrders) / $prevLateOrders * 100, 1)
            : 0;

        $latePercentage = $totalOrders > 0 ? round($lateOrders / $totalOrders * 100) : 0;

        // Category sales
        $categorySales = [];
        $categoryNames = ['Masakan', 'Kue Kering', 'Minuman', 'Lainnya'];
        $categoryOrders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('payment_status', 'paid')
            ->get();

        $categoryTotals = [
            'Masakan' => 0,
            'Kue Kering' => 0,
            'Minuman' => 0,
            'Lainnya' => 0,
        ];

        $totalCategorySales = 0;

        foreach ($categoryOrders as $order) {
            $items = json_decode($order->cart_data, true);
            if (!$items) continue;

            foreach ($items as $item) {
                $productName = $item['name'] ?? 'Unknown';
                $price = $item['price'] ?? 0;
                $qty = $item['qty'] ?? 1;
                $subtotal = $price * $qty;

                $product = Produk::where('nama_produk', $productName)->first();
                $kategori = $product ? $product->kategori : null;

                if (!$kategori) {
                    if (stripos($productName, 'kue') !== false || stripos($productName, 'cookies') !== false) {
                        $kategori = 'Kue Kering';
                    } elseif (
                        stripos($productName, 'minum') !== false ||
                        stripos($productName, 'es') !== false ||
                        stripos($productName, 'jus') !== false
                    ) {
                        $kategori = 'Minuman';
                    } else {
                        $kategori = 'Masakan';
                    }
                }

                if (isset($categoryTotals[$kategori])) {
                    $categoryTotals[$kategori] += $subtotal;
                } else {
                    $categoryTotals['Lainnya'] += $subtotal;
                }
                $totalCategorySales += $subtotal;
            }
        }

        foreach ($categoryNames as $cat) {
            $value = $categoryTotals[$cat] ?? 0;
            $percentage = $totalCategorySales > 0 ? round($value / $totalCategorySales * 100) : 0;
            $categorySales[] = [
                'name' => $cat,
                'value' => $value,
                'percentage' => $percentage,
            ];
        }

        // Area sales (top 5)
        $ordersWithAddress = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('payment_status', 'paid')
            ->whereNotNull('alamat')
            ->get();

        $areaTotals = [];
        foreach ($ordersWithAddress as $order) {
            $alamat = $order->alamat;
            $total = $order->total;

            $area = 'Lainnya';
            $alamatLower = strtolower($alamat);

            if (stripos($alamatLower, 'bogor tengah') !== false) {
                $area = 'Bogor Tengah';
            } elseif (stripos($alamatLower, 'bogor timur') !== false) {
                $area = 'Bogor Timur';
            } elseif (stripos($alamatLower, 'bogor barat') !== false) {
                $area = 'Bogor Barat';
            } elseif (stripos($alamatLower, 'bogor utara') !== false) {
                $area = 'Bogor Utara';
            } elseif (stripos($alamatLower, 'bogor selatan') !== false) {
                $area = 'Bogor Selatan';
            }

            if (!isset($areaTotals[$area])) {
                $areaTotals[$area] = 0;
            }
            $areaTotals[$area] += $total;
        }

        arsort($areaTotals);
        $areaSales = [];
        foreach (array_slice($areaTotals, 0, 5, true) as $area => $value) {
            $areaSales[] = ['area' => $area, 'value' => $value];
        }

        // Top products
        $productCounts = [];
        foreach ($categoryOrders as $order) {
            $items = json_decode($order->cart_data, true);
            if (!$items) continue;

            foreach ($items as $item) {
                $name = $item['name'] ?? 'Produk';
                $qty = $item['qty'] ?? 1;

                if (!isset($productCounts[$name])) {
                    $productCounts[$name] = 0;
                }
                $productCounts[$name] += $qty;
            }
        }

        arsort($productCounts);
        $topProducts = [];
        foreach (array_slice($productCounts, 0, 5, true) as $name => $qty) {
            $product = Produk::where('nama_produk', $name)->first();
            $topProducts[] = [
                'name' => $name,
                'qty' => $qty,
                'image' => $product ? $product->foto : 'default.png',
            ];
        }

        // order detail list (daftar order yang banyak)
        $orders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('payment_status', 'paid')
            ->orderBy('created_at', 'desc')
            ->get(['id','created_at','total','payment_status','order_status']);

        // Driver performance (top 5, rating demo)

        $driverPerformance = [];
        $ordersWithDriver = Order::whereBetween('created_at', [$startDate, $endDate])
            ->whereNotNull('driver')
            ->where('order_status', 'delivered')
            ->get();

        $driverCounts = [];
        foreach ($ordersWithDriver as $order) {
            $driver = $order->driver;
            if (!$driver) continue;
            if (!isset($driverCounts[$driver])) $driverCounts[$driver] = 0;
            $driverCounts[$driver]++;
        }

        arsort($driverCounts);
        $sampleDrivers = array_slice($driverCounts, 0, 5, true);

        foreach ($sampleDrivers as $driver => $count) {
            $rating = number_format(4.0 + (lcg_value() * 1.0), 1);
            $driverPerformance[] = [
                'name' => $driver,
                'rating' => $rating,
                'orders' => $count,
            ];
        }

        $dateRangeLabel = $startDate->format('d M Y') . ' - ' . $endDate->format('d M Y');

        // Insights

        $insights = [];
        if ($salesChange > 0) {
            $insights[] = [
                'type' => 'success',
                'title' => 'Penjualan meningkat ' . abs($salesChange) . '%',
                'desc' => 'Dibandingkan periode lalu...',
            ];
        } elseif ($salesChange < 0) {
            $insights[] = [
                'type' => 'warning',
                'title' => 'Penjualan menurun ' . abs($salesChange) . '%',
                'desc' => 'Dibandingkan periode lalu...',
            ];
        }

        if ($lateOrders > 0) {
            $insights[] = [
                'type' => 'warning',
                'title' => 'Perhatikan order terlambat',
                'desc' => 'Ada ' . $lateOrders . ' order (' . $latePercentage . '%) yang terlambat.',
            ];
        }

        if (!empty($topProducts) && $topProducts[0]['qty'] > 10) {
            $insights[] = [
                'type' => 'info',
                'title' => $topProducts[0]['name'] . ' paling laris',
                'desc' => 'Menu ini menyumbang ' . $topProducts[0]['qty'] . ' pesanan.',
            ];
        }

        // Payment management (ambil subset untuk PDF)
        $paymentBaseQuery = Order::whereBetween('created_at', [$startDate, $endDate]);

        $paymentStats = [
            'total_transaction' => (clone $paymentBaseQuery)->count(),
            'pending' => (clone $paymentBaseQuery)->where('payment_status', 'pending')->count(),
            'paid' => (clone $paymentBaseQuery)->where('payment_status', 'paid')->count(),
            'failed_expired' => (clone $paymentBaseQuery)->whereIn('payment_status', ['expired', 'cancelled', 'refunded'])->count(),
        ];

        $ordersPayment = (clone $paymentBaseQuery)
            ->orderBy('created_at', 'desc')
            ->limit(30)
            ->get([
                'id',
                'midtrans_order_id',
                'nama_pemesan',
                'payment_method',
                'payment_status',
                'total',
                'created_at',
            ]);

        // Product snapshot (ringkas, biar mirip product.blade.php)
        $productTotal = Produk::count();
        $productActive = Produk::where('is_available', 1)->count();
        $productUnavailable = Produk::where('is_available', 0)->count();

        // best seller product (pakai qty dari cart_data pada periode bulan ini)
        $bestSellerId = null;
        $productCountsForBest = [];
        foreach ($categoryOrders as $o) {
            $items = json_decode($o->cart_data, true);
            if (!$items) continue;
            foreach ($items as $it) {
                $name = $it['name'] ?? null;
                if (!$name) continue;
                $productCountsForBest[$name] = ($productCountsForBest[$name] ?? 0) + ($it['qty'] ?? 1);
            }
        }
        arsort($productCountsForBest);
        if (!empty($productCountsForBest)) {
            $bestSellerName = array_key_first($productCountsForBest);
            $bestSellerProduk = Produk::where('nama_produk', $bestSellerName)->first();
            $bestSellerId = $bestSellerProduk ? $bestSellerProduk->id : null;
        }

        $bestSellerName = $bestSellerId
            ? (Produk::find($bestSellerId)?->nama_produk)
            : (array_key_first($productCountsForBest) ?? '-');

        // Dashboard snapshot yang paling relevan (jumlah transaksi bayar bulan ini)
        $dashboardMonthlySales = [];
        for ($i = 1; $i <= 12; $i++) {
            $dashboardMonthlySales[] = Order::whereYear('created_at', $year)
                ->whereMonth('created_at', $i)
                ->where('payment_status', 'paid')
                ->sum('total');
        }

        // Order management snapshot (mirip list-order.blade.php)
        $ordersManagement = Order::whereBetween('created_at', [$startDate, $endDate]);
        $statsOrders = [
            'total_orders' => (clone $ordersManagement)->count(),
            'pending_orders' => (clone $ordersManagement)->where('order_status', 'order_created')->count(),
            'processing' => (clone $ordersManagement)->where('order_status', 'processing')->count(),
            'completed' => (clone $ordersManagement)->where('order_status', 'delivered')->count(),
            'cancelled' => (clone $ordersManagement)->where('order_status', 'cancelled')->count(),
        ];

        return compact(
            'startDate',
            'endDate',
            'dateRangeLabel',
            'totalSales',
            'salesChange',
            'totalOrders',
            'ordersChange',
            'avgOrder',
            'avgChange',
            'completedOrders',
            'totalDelivered',
            'lateOrders',
            'lateChange',
            'latePercentage',
            'categorySales',
            'totalCategorySales',
            'areaSales',
            'topProducts',
            'driverPerformance',
            'insights',
            'orders',
            'paymentStats',
            'ordersPayment',
            'productTotal',
            'productActive',
            'productUnavailable',
            'bestSellerName',
            'statsOrders',
            'dashboardMonthlySales'
        );
    }
}

