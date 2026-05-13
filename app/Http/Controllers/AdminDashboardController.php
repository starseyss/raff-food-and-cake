<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Produk;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // ================= TOTAL SALES =================
        $totalSales = Order::where('payment_status', 'paid')->sum('total');

        // ================= TOTAL ORDERS =================
        $totalOrders = Order::count();

        // ================= TOTAL CUSTOMER =================
        $totalCustomers = Order::distinct('nama_pemesan')->count('nama_pemesan');

        // ================= BEST SELLER (SAMAKAN DENGAN HomeController) =================
        $productCounts = [];

        $orders = Order::where('payment_status', 'paid')->get();

        foreach ($orders as $order) {
            $items = json_decode($order->cart_data, true);

            if (!$items) continue;

            foreach ($items as $item) {
                // HomeController pakai: $item['id'] untuk total_terjual
                $productId = $item['id'] ?? null;
                $qty = $item['qty'] ?? 1;

                if ($productId === null) continue;

                if (!isset($productCounts[$productId])) {
                    $productCounts[$productId] = 0;
                }

                $productCounts[$productId] += $qty;
            }
        }

        arsort($productCounts);

        $bestProducts = [];

        foreach (array_slice($productCounts, 0, 5, true) as $productId => $qty) {
            $product = Produk::find($productId);

            $bestProducts[] = [
                'name' => $product ? $product->nama_produk : 'Produk',
                'qty' => $qty,
                'image' => $product ? $product->foto : 'default.png'
            ];
        }

        // ================= RECENT ORDERS =================
        $recentOrders = Order::latest()->take(7)->get();

        // ================= CHART =================
        $monthlySales = [];
        $monthlyOrders = [];

        for ($i = 1; $i <= 12; $i++) {

            $monthlySales[] = Order::whereMonth('created_at', $i)
                ->where('payment_status', 'paid')
                ->sum('total');

            $monthlyOrders[] = Order::whereMonth('created_at', $i)
                ->count();
        }

        return view('admin.dashboard', compact(
            'totalSales',
            'totalOrders',
            'totalCustomers',
            'bestProducts',
            'recentOrders',
            'monthlySales',
            'monthlyOrders'
        ));
    }
}