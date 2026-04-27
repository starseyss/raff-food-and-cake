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
        $orders = Order::latest()->get();

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
        $order = Order::findOrFail($id);

        $order->cart_items = $this->decodeCart($order->cart_data);
        $order->rating_data = $this->getRating($id);

        return view('landing.detail_pesanan', compact('order'));
    }

    // =========================
    // STORE RATING (FIX PRODUCT-BASED)
    // =========================
    public function rating(Request $request, $id)
    {
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
    'product_id' => $request->product_id, // 🔥 tambah ini
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
    // USER CANCEL ORDER
    // =========================
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
}
