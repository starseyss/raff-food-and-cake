<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Rating;

class PesananController extends Controller
{
    // =========================
    // LIST PESANAN
    // =========================
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->get();

        foreach ($orders as $order) {
            $order->cart_items = $this->decodeCart($order->cart_data);
            $order->rating_data = $this->getRating($order->id);
        }

        return view('landing.pesanan', compact('orders'));
    }

    // =========================
    // DETAIL PESANAN
    // =========================
    public function show($id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $order->cart_items = $this->decodeCart($order->cart_data);
        $order->rating_data = $this->getRating($id);

        return view('landing.detail_pesanan', compact('order'));
    }

    // =========================
    // STORE RATING (FIX PRODUCT-BASED)
    // =========================
    public function rating(Request $request, $id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
            'product_id' => 'required|integer'
        ]);

        // cek sudah pernah rating produk ini dari user ini
        $exists = Rating::where('product_id', $request->product_id)
            ->where('user_id', auth()->id())
            ->exists();

        if ($exists) {
            return back()->with('error', 'Kamu sudah memberi rating untuk produk ini');
        }

        Rating::create([
            'order_id' => $id,
            'product_id' => $request->product_id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Terima kasih atas rating kamu!');
    }

    // =========================
    // GET RATING
    // =========================
    private function getRating($orderId)
    {
        return Rating::where('order_id', $orderId)->first();
    }

    // =========================
    // DECODE CART
    // =========================
    private function decodeCart($cartData)
    {
        if (!$cartData) return [];

        $decoded = json_decode($cartData, true);

        return is_array($decoded) ? $decoded : [];
    }

    // =========================
    // REQUEST REFUND (NEW FLOW)
    // =========================
    public function requestRefund(Request $request, $id)
    {
        $request->validate([
            'no_rek' => 'required|string|max:50',
            'nama_pemilik' => 'required|string|max:100',
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $order = Order::where('id', $id)
            ->where('user_id', auth()->id())
            ->where('payment_status', 'paid')
            ->whereIn('order_status', ['order_created', 'processing'])
            ->firstOrFail();

        // Store image
        $imageName = $order->midtrans_order_id . '_' . time() . '.' . $request->file('bukti_transfer')->getClientOriginalExtension();
        $path = $request->file('bukti_transfer')->storeAs('public/refund-proofs', $imageName);
        $imageUrl = asset('storage/' . str_replace('public/', '', $path));

        // Update order
        $order->update([
            'payment_status' => 'processing_refund',
            'order_status' => 'cancelled',
            'refund_reason' => 'User refund request',
            'refund_bank_no' => $request->no_rek,
            'refund_owner_name' => $request->nama_pemilik,
        ]);

        // Create notification
        $notification = \App\Models\AdminNotification::create([
            'order_id' => $order->id,
            'title' => '🪙 Permintaan Refund - #' . $order->midtrans_order_id,
            'message' => 'User mengajukan refund. Detail: ' . $request->no_rek . ' a/n ' . $request->nama_pemilik,
            'refund_data' => [
                'bank_no' => $request->no_rek,
                'owner_name' => $request->nama_pemilik,
                'proof_url' => $imageUrl,
                'proof_path' => $path,
            ],
        ]);

        // Send Email
        \Illuminate\Support\Facades\Mail::to('raff.support@gmail.com')->send(new \App\Mail\RefundRequestMail($order, $notification));

        // Send WA (simple link for now)
        $waMessage = urlencode("🔴 REFUND REQUEST\n\nOrder: #{$order->midtrans_order_id}\nUser: {$order->nama_pemesan}\nTotal: Rp " . number_format($order->total, 0, ',', '.') . "\n\nBank: {$request->no_rek} a/n {$request->nama_pemilik}\nBukti: {$imageUrl}");
        $waUrl = "https://wa.me/6283878851008?text=" . $waMessage;

        return back()->with([
            'success' => 'Permintaan refund berhasil dikirim! Status: Processing Refund.',
            'wa_url' => $waUrl
        ]);
    }

    // =========================
    // USER CANCEL ORDER (MANUAL REFUND - DEPRECATED)
    // =========================
    public function cancel($id)
    {
        return back()->with('error', 'Gunakan tombol Batalkan Pesanan untuk request refund.');
    }
    // =========================
// PESANAN DITERIMA USER
// =========================
public function terima($id)
{
    $order = Order::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    // hanya bisa diterima jika sedang dikirim
    if (!in_array($order->order_status, ['shipping', 'delivered'])) {
        return back()->with('error', 'Pesanan belum bisa diterima');
    }

    $order->update([
        'order_status' => 'completed'
    ]);

    return back()->with('success', 'Pesanan berhasil diterima');
}
}

