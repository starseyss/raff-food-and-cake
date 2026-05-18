<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserOrderNotification;
use Illuminate\Http\Request;

class UserOrderNotificationController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $notifications = UserOrderNotification::where('user_id', $userId)
            ->latestFirst()
            ->paginate(15);

        $unreadCount = UserOrderNotification::where('user_id', $userId)
            ->unread()
            ->count();

        return view('landing.notifikasi', compact('notifications', 'unreadCount'));
    }

    public function markAsRead($id)
    {
        $userId = auth()->id();

        $notification = UserOrderNotification::where('user_id', $userId)
            ->findOrFail($id);

        $notification->markAsRead();

        return back()->with('success', 'Notifikasi ditandai telah dibaca');
    }

    public function markAllAsRead()
    {
        $userId = auth()->id();

        UserOrderNotification::where('user_id', $userId)
            ->unread()
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);

        return back()->with('success', 'Semua notifikasi ditandai telah dibaca');
    }
}

