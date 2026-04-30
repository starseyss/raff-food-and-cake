<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Produk;
use Carbon\Carbon;

class AnalisisController extends Controller
{
    public function index(Request $request)
    {
        // ================= DATE RANGE =================
        $endDate = Carbon::now();
        $startDate = Carbon::now()->subDays(7);
        
        $prevEndDate = $startDate->copy()->subDay();
        $prevStartDate = $prevEndDate->copy()->subDays(6);

        // ================= TOTAL SALES =================
        $totalSales = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('payment_status', 'paid')
            ->sum('total');
            
        $prevTotalSales = Order::whereBetween('created_at', [$prevStartDate, $prevEndDate])
            ->where('payment_status', 'paid')
            ->sum('total');

        $salesChange = $prevTotalSales > 0 
            ? round(($totalSales - $prevTotalSales) / $prevTotalSales * 100, 1) 
            : 0;

        // ================= TOTAL ORDERS =================
        $totalOrders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->count();
            
        $prevTotalOrders = Order::whereBetween('created_at', [$prevStartDate, $prevEndDate])
            ->count();

        $ordersChange = $prevTotalOrders > 0 
            ? round(($totalOrders - $prevTotalOrders) / $prevTotalOrders * 100, 1) 
            : 0;

        // ================= AVERAGE ORDER VALUE =================
        $avgOrder = $totalOrders > 0 ? round($totalSales / $totalOrders) : 0;
        $prevAvgOrder = $prevTotalOrders > 0 ? round($prevTotalSales / $prevTotalOrders) : 0;
        
        $avgChange = $prevAvgOrder > 0 
            ? round(($avgOrder - $prevAvgOrder) / $prevAvgOrder * 100, 1) 
            : 0;

        // ================= COMPLETED ORDERS =================
        $completedOrders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('order_status', 'delivered')
            ->count();
            
        $totalDelivered = $totalOrders > 0 ? round($completedOrders / $totalOrders * 100) : 0;

// ================= LATE ORDERS =================
        // Late = delivered_at > tanggal_penerimaan
        $lateOrders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->whereNotNull('delivered_at')
            ->whereNotNull('tanggal_penerimaan')
            ->get()
            ->filter(function($order) {
                $deliveredAt = Carbon::parse($order->delivered_at);
                $tanggalPenerimaan = Carbon::parse($order->tanggal_penerimaan);
                return $deliveredAt->greaterThan($tanggalPenerimaan);
            })
            ->count();
            
        $prevLateOrders = Order::whereBetween('created_at', [$prevStartDate, $prevEndDate])
            ->whereNotNull('delivered_at')
            ->whereNotNull('tanggal_penerimaan')
            ->get()
            ->filter(function($order) {
                $deliveredAt = Carbon::parse($order->delivered_at);
                $tanggalPenerimaan = Carbon::parse($order->tanggal_penerimaan);
                return $deliveredAt->greaterThan($tanggalPenerimaan);
            })
            ->count();

        $lateChange = $prevLateOrders > 0 
            ? round(($lateOrders - $prevLateOrders) / $prevLateOrders * 100, 1) 
            : 0;

        // ================= MONTHLY SALES CHART DATA =================
        $monthlySales = [];
        $chartLabels = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthLabel = $month->format('M');
            $chartLabels[] = $monthLabel;
            
            $monthlySales[] = Order::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->where('payment_status', 'paid')
                ->sum('total');
        }

        // ================= SALES BY CATEGORY =================
        $categorySales = [];
        $categoryNames = ['Masakan', 'Kue Kering', 'Minuman', 'Lainnya'];
        
        // Get all paid orders
        $categoryOrders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('payment_status', 'paid')
            ->get();
            
        $categoryTotals = [
            'Masakan' => 0,
            'Kue Kering' => 0,
            'Minuman' => 0,
            'Lainnya' => 0
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
                
                // Try to find product category
                $product = Produk::where('nama_produk', $productName)->first();
                $kategori = $product ? $product->kategori : null;
                
                // Fallback: guess category from product name
                if (!$kategori) {
                    if (stripos($productName, 'kue') !== false || stripos($productName, 'cookies') !== false) {
                        $kategori = 'Kue Kering';
                    } elseif (stripos($productName, 'minum') !== false || stripos($productName, 'es') !== false || stripos($productName, 'jus') !== false) {
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
                'percentage' => $percentage
            ];
        }

        // ================= SALES BY AREA =================
        $areaSales = [];
        
        $ordersWithAddress = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('payment_status', 'paid')
            ->whereNotNull('alamat')
            ->get();
            
        $areaTotals = [];
        
        foreach ($ordersWithAddress as $order) {
            $alamat = $order->alamat;
            $total = $order->total;
            
            // Extract area (e.g., "Bogor Tengah" from address)
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
        
        // Sort by value descending
        arsort($areaTotals);
        
        $areaSales = [];
        foreach (array_slice($areaTotals, 0, 5, true) as $area => $value) {
            $areaSales[] = [
                'area' => $area,
                'value' => $value
            ];
        }

        // ================= TOP SELLING PRODUCTS =================
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
                'image' => $product ? $product->foto : 'default.png'
            ];
        }

        // ================= DRIVER PERFORMANCE =================
        $driverPerformance = [];
        
        $ordersWithDriver = Order::whereBetween('created_at', [$startDate, $endDate])
            ->whereNotNull('driver')
            ->where('order_status', 'delivered')
            ->get();
            
        $driverRatings = [];
        
        // Since driver field doesn't have rating, we'll use delivery performance
        // For now, generate sample data or use order count as proxy
        $driverCounts = [];
        
        foreach ($ordersWithDriver as $order) {
            $driver = $order->driver;
            if (!$driver) continue;
            
            if (!isset($driverCounts[$driver])) {
                $driverCounts[$driver] = 0;
            }
            $driverCounts[$driver]++;
        }
        
        arsort($driverCounts);
        
        // For demo, we'll show sample driver names with generated ratings
        // In production, you'd have a driver table with ratings
        $sampleDrivers = array_slice($driverCounts, 0, 5, true);
        
        foreach ($sampleDrivers as $driver => $count) {
            // Generate random rating for demo (4.0 - 5.0)
            $rating = number_format(4.0 + (lcg_value() * 1.0), 1);
            $driverPerformance[] = [
                'name' => $driver,
                'rating' => $rating,
                'orders' => $count
            ];
        }

        // ================= FORMAT DATE RANGE =================
        $dateRange = $startDate->format('d M') . ' - ' . $endDate->format('d M Y');
        $prevDateRange = $prevStartDate->format('d M') . ' - ' . $prevEndDate->format('d M Y');

        // ================= INSIGHTS =================
        $insights = [];
        
        if ($salesChange > 0) {
            $insights[] = [
                'type' => 'success',
                'title' => 'Penjualan meningkat ' . abs($salesChange) . '%',
                'desc' => 'Dibandingkan periode lalu...'
            ];
        } elseif ($salesChange < 0) {
            $insights[] = [
                'type' => 'warning',
                'title' => 'Penjualan menurun ' . abs($salesChange) . '%',
                'desc' => 'Dibandingkan periode lalu...'
            ];
        }
        
        if ($lateOrders > 0) {
            $latePercentage = $totalOrders > 0 ? round($lateOrders / $totalOrders * 100) : 0;
            $insights[] = [
                'type' => 'warning',
                'title' => 'Perhatikan order terlambat',
                'desc' => 'Ada ' . $lateOrders . ' order (' . $latePercentage . '%) yang terlambat.'
            ];
        }
        
        if (!empty($topProducts) && $topProducts[0]['qty'] > 10) {
            $insights[] = [
                'type' => 'info',
                'title' => $topProducts[0]['name'] . ' paling laris',
                'desc' => 'Menu ini menyumbang ' . $topProducts[0]['qty'] . ' pesanan.'
            ];
        }

        // ================= COMPACT ALL VARIABLES =================
        return view('admin.analisis', compact(
            // Date ranges
            'dateRange',
            'prevDateRange',
            
            // Summary cards
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
            
            // Chart data
            'chartLabels',
            'monthlySales',
            
            // Category data
            'categorySales',
            'totalCategorySales',
            
            // Area data
            'areaSales',
            
            // Products
            'topProducts',
            
            // Driver
            'driverPerformance',
            
            // Insights
            'insights'
        ));
    }
}
