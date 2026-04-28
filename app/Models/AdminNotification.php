<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminNotification extends Model
{
    protected $fillable = [
        'order_id',
        'title',
        'message',
        'is_read',
        'read_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];

    /**
     * =========================
     * RELATIONSHIP TO ORDER
     * =========================
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * =========================
     * MARK AS READ
     * =========================
     */
    public function markAsRead(): void
    {
        if (!$this->is_read) {
            $this->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
        }
    }

    /**
     * =========================
     * SCOPE: UNREAD ONLY
     * =========================
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * =========================
     * SCOPE: LATEST FIRST
     * =========================
     */
    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}

