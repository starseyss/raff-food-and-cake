<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminNotification;
use App\Models\Order;

class AdminNotificationController extends Controller
{
    /**
     * =========================
     * LIST ALL NOTIFICATIONS
     * =========================
     */
    public function index()
    {
        $notifications = AdminNotification::with('order')
            ->latestFirst()
            ->paginate(15);

        $unreadCount = AdminNotification::unread()->count();

        return view('admin.notifications', compact('notifications', 'unreadCount'));
    }

    /**
     * =========================
     * MARK SINGLE NOTIFICATION AS READ
     * =========================
     */
    public function markAsRead($id)
    {
        $notification = AdminNotification::findOrFail($id);
        $notification->markAsRead();

        return back()->with('success', 'Notifikasi ditandai telah dibaca');
    }

    /**
     * =========================
     * MARK ALL NOTIFICATIONS AS READ
     * =========================
     */
    public function markAllAsRead()
    {
        AdminNotification::unread()->update([
            'is_read' => true,
            'read_at' => now(),
        ]);

        return back()->with('success', 'Semua notifikasi ditandai telah dibaca');
    }

    /**
     * =========================
     * GET UNREAD COUNT (JSON - FOR AJAX)
     * =========================
     */
    public function unreadCount()
    {
        $count = AdminNotification::unread()->count();

        return response()->json([
            'count' => $count
        ]);
    }

    /**
     * =========================
     * GET LATEST NOTIFICATIONS (JSON - FOR DROPDOWN)
     * =========================
     */
    public function latest()
    {
        $notifications = AdminNotification::with('order')
            ->latestFirst()
            ->take(5)
            ->get()
            ->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'title' => $notification->title,
                    'message' => $notification->message,
                    'is_read' => $notification->is_read,
                    'order_id' => $notification->order_id,
                    'midtrans_order_id' => $notification->order?->midtrans_order_id,
                    'created_at' => $notification->created_at->diffForHumans(),
                ];
            });

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => AdminNotification::unread()->count(),
        ]);
    }

    /**
     * =========================
     * CREATE NOTIFICATION ON PAYMENT SUCCESS (STATIC HELPER)
     * =========================
     */
    public static function createPaymentNotification(Order $order): void
    {
        // Cek apakah notifikasi untuk order ini sudah ada (hindari duplikat)
        $exists = AdminNotification::where('order_id', $order->id)
            ->where('title', 'like', '%Pembayaran Berhasil%')
            ->exists();

        if ($exists) {
            return;
        }

        AdminNotification::create([
            'order_id' => $order->id,
            'title' => 'Pembayaran Berhasil',
            'message' => "Order #{$order->midtrans_order_id} telah dibayar oleh {$order->nama_pemesan}. Total: Rp " . number_format($order->total, 0, ',', '.'),
            'is_read' => false,
        ]);
    }
}

