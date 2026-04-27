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
