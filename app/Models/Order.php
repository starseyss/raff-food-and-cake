<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'nama_pemesan',
        'nama_penerima',
        'tanggal_penerimaan',
        'no_hp',
        'alamat',
        'catatan',
        'shipping_method',
        'payment_method',
        'cart_data',
        'subtotal',
        'ongkir',
        'total',

        // ✅ STATUS
        'payment_status',
        'order_status',

        // ✅ SHIPPING
        'driver',
        'delivery_time',
        'shipped_at',
        'delivered_at',

        // ✅ MIDTRANS
        'midtrans_order_id',
        'midtrans_transaction_id',

        // ✅ REFUND
        'refund_at',
        'refund_reason',
        'midtrans_response',
    ];

    protected $casts = [
        'refund_at' => 'datetime',
    ];

    /**
     * =========================
     * CHECK IF ORDER CAN BE CANCELLED
     * =========================
     */
    public function isCancellable(): bool
    {
        return in_array($this->order_status, ['order_created', 'processing'])
            && !in_array($this->payment_status, ['cancelled', 'refunded']);
    }

    /**
     * =========================
     * CHECK IF ORDER IS PAID (NEEDS REFUND)
     * =========================
     */
    public function isPaid(): bool
    {
        return $this->payment_status === 'paid';
    }

    /**
     * =========================
     * CHECK IF ORDER IS PENDING (NO REFUND NEEDED)
     * =========================
     */
    public function isPending(): bool
    {
        return in_array($this->payment_status, ['pending', 'expired']);
    }
}
