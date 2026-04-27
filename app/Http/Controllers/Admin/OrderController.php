<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * =========================
     * LIST ORDER + STATISTIK
     * =========================
     */
    public function index()
    {
        $orders = DB::table('orders')
            ->orderBy('created_at', 'desc')
            ->get();

        $stats = [
            // TOTAL ORDER
            'total_orders' => DB::table('orders')->count(),

            // BELUM BAYAR
            'pending_orders' => DB::table('orders')
                ->where('payment_status', 'pending')
                ->count(),

            // DIPROSES
            'processing' => DB::table('orders')
                ->where('order_status', 'processing')
                ->count(),

            // DIKIRIM
            'shipped' => DB::table('orders')
                ->where('order_status', 'shipped')
                ->count(),

            // SAMPAI (BELUM DIKONFIRMASI USER)
            'delivered' => DB::table('orders')
                ->where('order_status', 'delivered')
                ->count(),

            // SELESAI (SUDAH DIKLIK USER)
            'completed' => DB::table('orders')
                ->where('order_status', 'completed')
                ->count(),

            // DIBATALKAN
            'cancelled' => DB::table('orders')
                ->where('order_status', 'cancelled')
                ->count(),

            // TOTAL PENDAPATAN
            'total_revenue' => DB::table('orders')
                ->where('payment_status', 'paid')
                ->sum('total'),

            // ORDER HARI INI
            'today_orders' => DB::table('orders')
                ->whereDate('created_at', today())
                ->count(),

            // PENDAPATAN HARI INI
            'today_revenue' => DB::table('orders')
                ->whereDate('created_at', today())
                ->where('payment_status', 'paid')
                ->sum('total'),
        ];

        return view('admin.list-order', compact('orders', 'stats'));
    }

    /**
     * =========================
     * UPDATE STATUS ORDER (ADMIN)
     * =========================
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'order_status' => 'required|in:order_created,processing,packed,shipped,delivered,completed,cancelled'
        ]);

        DB::table('orders')
            ->where('id', $id)
            ->update([
                'order_status' => $request->order_status,
                'updated_at'   => now()
            ]);

        return back()->with('success', 'Status berhasil diupdate');
    }

    /**
     * =========================
     * USER KONFIRMASI PESANAN DITERIMA
     * =========================
     */
    public function terima($id)
    {
        $order = DB::table('orders')->where('id', $id)->first();

        if (!$order) {
            return back()->with('error', 'Order tidak ditemukan');
        }

        // hanya bisa dikonfirmasi jika sudah delivered
        if ($order->order_status !== 'delivered') {
            return back()->with('error', 'Pesanan belum sampai');
        }

        DB::table('orders')
            ->where('id', $id)
            ->update([
                'order_status' => 'completed',
                'updated_at'   => now()
            ]);

        return back()->with('success', 'Pesanan berhasil dikonfirmasi');
    }
    public function cancel($id)
    {
        $paymentController = new \App\Http\Controllers\PaymentController();
        $result = $paymentController->cancelOrder($id);

        if ($result->success) {
            return back()->with('success', $result->message);
        } else {
            return back()->with('error', $result->message);
        }
    }

    /**
     * =========================
     * SHIPPING MANAGEMENT
     * =========================
     */
    public function shipping(Request $request)
    {
        $query = DB::table('orders')
            ->whereIn('order_status', ['packed', 'shipped', 'delivered', 'completed'])
            ->where('payment_status', 'paid');

        // Filter: status
        if ($request->filled('status')) {
            $query->where('order_status', $request->status);
        }

        // Filter: date (tanggal penerimaan)
        if ($request->filled('date')) {
            $query->whereDate('tanggal_penerimaan', $request->date);
        }

        // Filter: driver
        if ($request->filled('driver')) {
            $query->where('driver', $request->driver);
        }

        // Filter: search (nama / order id)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_pemesan', 'like', "%{$search}%")
                  ->orWhere('nama_penerima', 'like', "%{$search}%")
                  ->orWhere('midtrans_order_id', 'like', "%{$search}%");
            });
        }

        $orders = $query->orderBy('tanggal_penerimaan', 'asc')
                        ->orderBy('delivery_time', 'asc')
                        ->get();

        $stats = [
            'scheduled'     => DB::table('orders')
                ->where('order_status', 'packed')
                ->where('payment_status', 'paid')
                ->count(),
            'ready'         => DB::table('orders')
                ->where('order_status', 'packed')
                ->whereNotNull('driver')
                ->where('payment_status', 'paid')
                ->count(),
            'on_delivery'   => DB::table('orders')
                ->where('order_status', 'shipped')
                ->where('payment_status', 'paid')
                ->count(),
            'delivered'     => DB::table('orders')
                ->whereIn('order_status', ['delivered', 'completed'])
                ->where('payment_status', 'paid')
                ->count(),
            'delivered_today' => DB::table('orders')
                ->whereIn('order_status', ['delivered', 'completed'])
                ->whereDate('delivered_at', today())
                ->where('payment_status', 'paid')
                ->count(),
        ];

        $drivers = DB::table('orders')->whereNotNull('driver')->select('driver')->distinct()->pluck('driver');

        return view('admin.shipping', compact('orders', 'stats', 'drivers'));
    }

    /**
     * =========================
     * ASSIGN DRIVER
     * =========================
     */
    public function assignDriver(Request $request, $id)
    {
        $request->validate([
            'driver' => 'required|string|max:100',
            'delivery_time' => 'required|string|max:20',
        ]);

        $order = DB::table('orders')->where('id', $id)->first();

        if (!$order) {
            return back()->with('error', 'Order tidak ditemukan');
        }

        if ($order->order_status !== 'packed') {
            return back()->with('error', 'Order belum siap dikirim (status: ' . $order->order_status . ')');
        }

        DB::table('orders')->where('id', $id)->update([
            'driver' => $request->driver,
            'delivery_time' => $request->delivery_time,
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Driver berhasil di-assign');
    }

    /**
     * =========================
     * START DELIVERY
     * =========================
     */
    public function startDelivery($id)
    {
        $order = DB::table('orders')->where('id', $id)->first();

        if (!$order) {
            return back()->with('error', 'Order tidak ditemukan');
        }

        if ($order->order_status !== 'packed') {
            return back()->with('error', 'Order belum siap dikirim');
        }

        DB::table('orders')->where('id', $id)->update([
            'order_status' => 'shipped',
            'shipped_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Pengiriman dimulai - Order berstatus Shipped');
    }

    /**
     * =========================
     * MARK DELIVERED
     * =========================
     */
    public function markDelivered($id)
    {
        $order = DB::table('orders')->where('id', $id)->first();

        if (!$order) {
            return back()->with('error', 'Order tidak ditemukan');
        }

        if ($order->order_status !== 'shipped') {
            return back()->with('error', 'Order belum dalam pengiriman');
        }

        DB::table('orders')->where('id', $id)->update([
            'order_status' => 'delivered',
            'delivered_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Pesanan berhasil ditandai sebagai Delivered');
    }

    /**
     * =========================
     * LIST PAYMENT + STATISTIK
     * =========================
     */
    public function paymentList()
    {
        $orders = DB::table('orders')
            ->orderBy('created_at', 'desc')
            ->get();

        $paymentStats = [
            'total_transaction' => DB::table('orders')->count(),
            'pending' => DB::table('orders')
                ->where('payment_status', 'pending')
                ->count(),
            'paid' => DB::table('orders')
                ->where('payment_status', 'paid')
                ->count(),
            'failed_expired' => DB::table('orders')
                ->whereIn('payment_status', ['expired', 'cancelled', 'refund_failed'])
                ->count(),
        ];

        return view('admin.payment-list', compact('orders', 'paymentStats'));
    }
}
