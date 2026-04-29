<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Http\Controllers\Admin\AdminNotificationController;

class PaymentController extends Controller
{
    // ================= BAYAR (SNAP TOKEN) =================
    public function bayar(Request $request)
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // --- MODE RETRY (User klik bayar lagi dari halaman riwayat) ---
        if ($request->order_id) {
            $order = Order::find($request->order_id);

            if (!$order) {
                return response()->json(['error' => 'Order tidak ditemukan'], 404);
            }

        if (!in_array($order->payment_status, ['pending', 'expired'])) {
                return response()->json([
                    'error' => 'Status pesanan tidak memungkinkan untuk dibayar lagi. Status saat ini: ' . $order->payment_status
                ], 400);
            }

            // Always generate NEW midtrans_order_id for retry attempts
            $midtransOrderId = 'RETRY-ODR-' . $order->id . '-' . now()->format('His') . rand(1000, 9999);
            $order->midtrans_order_id = $midtransOrderId;
            $order->save();
            
            \Log::info('PAYMENT RETRY ATTEMPT', [
                'order_id' => $order->id,
                'new_midtrans_order_id' => $midtransOrderId,
                'previous_id' => $order->getOriginal('midtrans_order_id')
            ]);

            $items = json_decode($order->cart_data, true) ?? [];
            $midtrans_items = [];
            foreach ($items as $item) {
                $midtrans_items[] = [
                    'id' => $item['id'] ?? rand(1000, 9999),
                    'price' => (int) $item['price'],
                    'quantity' => (int) $item['qty'],
                    'name' => $item['name']
                ];
            }

            if ($order->ongkir > 0) {
                $midtrans_items[] = [
                    'id' => 'ONGKIR',
                    'price' => (int) $order->ongkir,
                    'quantity' => 1,
                    'name' => 'Ongkir'
                ];
            }

            $params = [
                'transaction_details' => [
                    'order_id' => $midtransOrderId,
                    'gross_amount' => (int) $order->total,
                ],
                'item_details' => $midtrans_items,
                'customer_details' => [
                    'first_name' => $order->nama_pemesan,
                    'phone' => $order->no_hp,
                ],
                'callbacks' => [
                    'finish' => url('/payment-success'),
                ],
            ];

            try {
                $snapToken = Snap::getSnapToken($params);
                return response()->json(['snap_token' => $snapToken]);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }

        // ================= MODE PESANAN BARU =================
        $cart = $request->cart;

        if (!$cart || empty($cart)) {
            return response()->json(['error' => 'Cart kosong'], 400);
        }

        $items = [];
        $subtotal = 0;

        foreach ($cart as $item) {
            $price = (int) $item['price'];
            $qty = (int) $item['qty'];
            $totalItem = $price * $qty;
            $subtotal += $totalItem;

            $items[] = [
                'id' => $item['id'] ?? rand(1000, 9999),
                'price' => $price,
                'quantity' => $qty,
                'name' => $item['name']
            ];
        }

        $ongkir = 0;
        if ($request->shipping_method === 'gosend') {
            $ongkir = 15000;
            $items[] = [
                'id' => 'ONGKIR',
                'price' => 15000,
                'quantity' => 1,
                'name' => 'Ongkir GoSend'
            ];
        }

        $total = $subtotal + $ongkir;
        $order_id = 'ODR-' . time() . '-' . rand(1000, 9999);

        DB::table('orders')->insert([
            'user_id' => auth()->id(),
            'nama_pemesan' => $request->nama,
            'nama_penerima' => $request->nama_penerima,
            'tanggal_penerimaan' => $request->tanggal_penerimaan,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'catatan' => $request->catatan,
            'shipping_method' => $request->shipping_method,
            'payment_method' => $request->payment_method,
            'cart_data' => json_encode($cart),
            'subtotal' => $subtotal,
            'ongkir' => $ongkir,
            'total' => $total,
            'payment_status' => 'pending',
            'order_status' => 'order_created',
            'midtrans_order_id' => $order_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $map = [
            'bca' => 'bca_va',
            'bri' => 'bri_va',
            'bni' => 'bni_va',
            'permata' => 'permata_va',
            'mandiri' => 'echannel',
            'gopay' => 'gopay',
            'dana' => 'dana',
            'qris' => 'qris',
            'visa' => 'credit_card',
            'seabank' => 'bank_transfer',
        ];

        if (!isset($map[$request->payment_method])) {
            return response()->json(['error' => 'Metode pembayaran tidak valid'], 400);
        }

        $paymentType = $map[$request->payment_method];

        $params = [
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => $total,
            ],
            'item_details' => $items,
            'customer_details' => [
                'first_name' => $request->nama,
                'phone' => $request->no_hp,
            ],
            'enabled_payments' => [$paymentType],
            'callbacks' => [
                'finish' => url('/payment-success'),
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['snap_token' => $snapToken]);
    }

    // ================= CALLBACK MIDTRANS =================
    public function callback(Request $request)
    {
        \Log::info('MIDTRANS CALLBACK (redirect only):', $request->all());
        return response()->json(['message' => 'ok'], 200);
    }

    // ================= CANCEL ORDER + REFUND =================
   public function cancelOrder($orderId)
{
    $order = Order::find($orderId);

    if (!$order) {
        return (object)[
            'success' => false,
            'message' => 'Order tidak ditemukan'
        ];
    }

    \Log::info('CANCEL ORDER DEBUG', [
        'order_id' => $order->id,
        'payment_status' => $order->payment_status,
        'midtrans_order_id' => $order->midtrans_order_id
    ]);

    // ================= 1. KONDISI: SUDAH DIBAYAR (REFUND) =================
    if ($order->payment_status === 'paid') {
        // Gunakan transaction_id jika ada (dari callback), fallback ke order_id
        $identifier = $order->midtrans_transaction_id ?: $order->midtrans_order_id;

        $refundResponse = $this->midtransRefund($order); // Kirim seluruh objek $order

        \Log::info('MIDTRANS REFUND RESPONSE', [
            'order_id' => $order->id,
            'response' => $refundResponse
        ]);

        if (isset($refundResponse->status_code) && in_array((string)$refundResponse->status_code, ['200', '201'])) {
            $order->update([
                'payment_status' => 'refunded',
                'order_status' => 'cancelled',
                'refund_at' => now(),
                'midtrans_response' => json_encode($refundResponse)
            ]);

            return (object)[
                'success' => true,
                'message' => 'Refund berhasil diproses'
            ];
        }

        return (object)[
            'success' => false,
            'message' => 'Refund gagal: ' . ($refundResponse->status_message ?? 'Unknown Error')
        ];
    }

    // ================= 2. KONDISI: MASIH PENDING (CANCEL) =================
    if ($order->payment_status === 'pending') {
        $cancelResponse = $this->midtransCancel($order->midtrans_order_id);

        \Log::info('MIDTRANS CANCEL RESPONSE', [
            'order_id' => $order->id,
            'response' => $cancelResponse
        ]);

        $order->update([
            'payment_status' => 'cancelled',
            'order_status' => 'cancelled'
        ]);

        return (object)[
            'success' => true,
            'message' => 'Pesanan berhasil dibatalkan'
        ];
    }

    // ================= 3. KONDISI: SUDAH EXPIRED =================
    if ($order->payment_status === 'expired') {
        $order->update([
            'order_status' => 'cancelled'
        ]);

        return (object)[
            'success' => true,
            'message' => 'Pesanan expired'
        ];
    }

    // ================= 4. KONDISI: SUDAH REFUNDED =================
    if ($order->payment_status === 'refunded') {
        return (object)[
            'success' => false,
            'message' => 'Pesanan sudah direfund sebelumnya'
        ];
    }

    // ================= DEFAULT: STATUS LAINNYA =================
    return (object)[
        'success' => false,
        'message' => 'Status tidak didukung untuk pembatalan'
    ];
}
   private function midtransRefund($order) // Parameter diubah menjadi $order
{
    $serverKey = config('services.midtrans.server_key');
    $isProduction = config('services.midtrans.is_production', false);

    // Ambil ID Transaksi (Prioritas transaction_id, fallback ke order_id)
    $id = $order->midtrans_transaction_id ?: $order->midtrans_order_id;

    $baseUrl = $isProduction
        ? 'https://api.midtrans.com'
        : 'https://api.sandbox.midtrans.com';

    $url = $baseUrl . '/v2/' . $id . '/refund';

    $headers = [
        'Authorization: Basic ' . base64_encode($serverKey . ':'),
        'Content-Type: application/json',
        'Accept: application/json'
    ];

    $body = json_encode([
        'refund_key' => 'REFUND-' . $order->id . '-' . time(), // Gunakan ID asli order agar unik
        'amount' => (int) $order->total, // Sekarang $order->total sudah terbaca
        'reason' => 'User cancelled order'
    ]);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($curlError) {
        \Log::error('MIDTRANS CURL ERROR:', ['error' => $curlError]);
        return (object) [
            'status_code' => 500,
            'status_message' => 'Curl Error: ' . $curlError
        ];
    }

    $decoded = json_decode($response);

    \Log::info('MIDTRANS REFUND RESPONSE:', [
        'order_id' => $order->id,
        'midtrans_id' => $id,
        'http_code' => $httpCode,
        'response' => $decoded
    ]);

    return $decoded;
}

    private function checkMidtransStatus($orderId)
    {
        $serverKey = config('services.midtrans.server_key');
        $isProduction = config('services.midtrans.is_production', false);

        $baseUrl = $isProduction
            ? 'https://api.midtrans.com'
            : 'https://api.sandbox.midtrans.com';

        $url = $baseUrl . '/v2/' . $orderId . '/status';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Basic ' . base64_encode($serverKey . ':'),
            'Accept: application/json'
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            \Log::error('MIDTRANS CHECK STATUS CURL ERROR:', ['error' => $curlError]);
            return null;
        }

        $decoded = json_decode($response, true);

        \Log::info('MIDTRANS CHECK STATUS RESPONSE:', [
            'order_id' => $orderId,
            'http_code' => $httpCode,
            'response' => $decoded
        ]);

        if ($httpCode == 200 && isset($decoded['transaction_status'])) {
            return [
                'status_code' => 200,
                'transaction_status' => $decoded['transaction_status'],
                'data' => $decoded
            ];
        }

        \Log::info('MIDTRANS DEBUG', [
            'server_key' => substr($serverKey, 0, 15),
            'is_production' => $isProduction,
            'base_url' => $baseUrl,
            'url' => $url,
        ]);

        return null;
    }

    private function midtransCancel($transactionId)
    {
        $serverKey = config('services.midtrans.server_key');
        $isProduction = config('services.midtrans.is_production', false);

        $baseUrl = $isProduction
            ? 'https://api.midtrans.com'
            : 'https://api.sandbox.midtrans.com';

        $url = $baseUrl . '/v2/' . $transactionId . '/cancel';

        $headers = [
            'Authorization: Basic ' . base64_encode($serverKey . ':'),
            'Content-Type: application/json',
            'Accept: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            \Log::error('MIDTRANS CANCEL CURL ERROR:', ['error' => $curlError]);
            return (object) [
                'status_code' => 500,
                'status_message' => 'Curl Error: ' . $curlError
            ];
        }

        $decoded = json_decode($response);

        \Log::info('MIDTRANS CANCEL RESPONSE:', [
            'transaction_id' => $transactionId,
            'http_code' => $httpCode,
            'response' => $decoded
        ]);

        return $decoded;
    }

    // ================= WEBHOOK NOTIFICATION =================
    public function notification(Request $request)
    {
        if ($request->isMethod('get')) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Webhook aktif'
            ]);
        }

        \Log::info('MIDTRANS NOTIFICATION:', $request->all());

        $payload = $request->all();

        if (!isset($payload['order_id'], $payload['status_code'], $payload['gross_amount'], $payload['signature_key'])) {
            \Log::info('MIDTRANS NOTIFICATION SKIPPED (not a transaction payload)');
            return response()->json(['message' => 'ok'], 200);
        }

        $serverKey = config('services.midtrans.server_key');

        $signatureKey = hash('sha512',
            $payload['order_id'] .
            $payload['status_code'] .
            $payload['gross_amount'] .
            $serverKey
        );

        $order = Order::where('midtrans_order_id', $payload['order_id'])->first();

        if (!$order) {
            \Log::warning('ORDER TIDAK DITEMUKAN', $payload);
            return response()->json(['message' => 'ok'], 200);
        }

        if (!empty($payload['transaction_id'])) {
            $order->midtrans_transaction_id = $payload['transaction_id'];
        }

        $transactionStatus = $payload['transaction_status'] ?? null;
        $fraudStatus = $payload['fraud_status'] ?? null;

        $newPaymentStatus = $this->mapMidtransStatus($transactionStatus, $fraudStatus);
        if ($newPaymentStatus === null || $order->payment_status === $newPaymentStatus) {
            \Log::info('MIDTRANS NOTIFICATION SKIPPED (already same status):', [
                'order_id' => $order->id,
                'current_status' => $order->payment_status,
                'incoming_status' => $newPaymentStatus,
            ]);
            return response()->json(['message' => 'already processed'], 200);
        }

        if ($transactionStatus == 'settlement') {
            if ($fraudStatus == 'challenge') {
                // TODO: handle challenge
            } else if ($fraudStatus == 'accept' || !$fraudStatus) {
                $order->payment_status = 'paid';
            }
        } else if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                // TODO: handle challenge
            } else if ($fraudStatus == 'accept' || !$fraudStatus) {
                $order->payment_status = 'paid';
            }
        } else if ($transactionStatus == 'pending') {
            $order->payment_status = 'pending';
        } else if ($transactionStatus == 'expire') {
            $order->payment_status = 'expired';
            $order->order_status = 'cancelled';
        } else if ($transactionStatus == 'cancel' || $transactionStatus == 'deny') {
            $order->payment_status = 'cancelled';
            $order->order_status = 'cancelled';
        } else if ($transactionStatus == 'refund') {
            $order->payment_status = 'refunded';
            $order->order_status = 'cancelled';
            $order->refund_at = now();
            $order->midtrans_response = json_encode($payload);
        }

        $order->save();

        // 🔔 CREATE ADMIN NOTIFICATION IF PAID
        if ($order->payment_status === 'paid') {
            AdminNotificationController::createPaymentNotification($order);
        }

        \Log::info('MIDTRANS NOTIFICATION PROCESSED:', [
            'order_id' => $order->id,
            'payment_status' => $order->payment_status,
            'order_status' => $order->order_status,
        ]);

        return response()->json(['message' => 'ok'], 200);
    }

    private function mapMidtransStatus($transactionStatus, $fraudStatus)
    {
        if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                return 'challenge';
            }
            return 'paid';
        }

        if ($transactionStatus == 'pending') {
            return 'pending';
        }

        if ($transactionStatus == 'expire') {
            return 'expired';
        }

        if ($transactionStatus == 'cancel' || $transactionStatus == 'deny') {
            return 'cancelled';
        }

        if ($transactionStatus == 'refund') {
            return 'refunded';
        }

        return null;
    }

    // ================= PAYMENT SUCCESS PAGE =================
    public function success(Request $request)
    {
        $midtransOrderId = $request->query('order_id');

        if (!$midtransOrderId) {
            return view('landing.success');
        }

        $order = Order::where('midtrans_order_id', $midtransOrderId)->first();

        if (!$order) {
            \Log::warning('PAYMENT SUCCESS: Order tidak ditemukan', ['midtrans_order_id' => $midtransOrderId]);
            return view('landing.success');
        }

        if ($order->payment_status === 'paid') {
            return view('landing.success');
        }

        $serverKey = config('services.midtrans.server_key');
        $isProduction = config('services.midtrans.is_production', false);

        $baseUrl = $isProduction
            ? 'https://api.midtrans.com'
            : 'https://api.sandbox.midtrans.com';

        $url = $baseUrl . '/v2/' . $midtransOrderId . '/status';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Basic ' . base64_encode($serverKey . ':'),
            'Accept: application/json'
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            \Log::error('MIDTRANS STATUS CHECK ERROR:', ['error' => $curlError, 'order_id' => $midtransOrderId]);
            return view('landing.success');
        }

        $result = json_decode($response, true);

        \Log::info('MIDTRANS STATUS CHECK:', [
            'order_id' => $midtransOrderId,
            'http_code' => $httpCode,
            'response' => $result
        ]);

        if ($httpCode == 200 && isset($result['transaction_status'])) {
            $transactionStatus = $result['transaction_status'];
            $fraudStatus = $result['fraud_status'] ?? null;

            if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
                if ($fraudStatus == 'accept' || !$fraudStatus) {
                    $order->payment_status = 'paid';
                    $order->save();

                    // 🔔 CREATE ADMIN NOTIFICATION
                    AdminNotificationController::createPaymentNotification($order);

                    \Log::info('PAYMENT SUCCESS: Order updated to paid', [
                        'order_id' => $order->id,
                        'midtrans_order_id' => $midtransOrderId
                    ]);
                }
            } else if ($transactionStatus == 'pending') {
                $order->payment_status = 'pending';
                $order->save();
            } else if ($transactionStatus == 'expire') {
                $order->payment_status = 'expired';
                $order->order_status = 'cancelled';
                $order->save();
            } else if ($transactionStatus == 'cancel' || $transactionStatus == 'deny') {
                $order->payment_status = 'cancelled';
                $order->order_status = 'cancelled';
                $order->save();
            }
        }

        return view('landing.success');
    }
}

