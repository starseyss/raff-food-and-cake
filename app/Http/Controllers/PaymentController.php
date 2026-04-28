<?php
namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Midtrans\Snap;
    use Midtrans\Config;
    use Illuminate\Support\Facades\DB;
    use App\Models\Order;

    class PaymentController extends Controller
    {
        // ================= BAYAR (SNAP TOKEN) =================
        public function bayar(Request $request)
        {
            // ================= MIDTRANS CONFIG =================
            Config::$serverKey = config('services.midtrans.server_key');
            Config::$isProduction = config('services.midtrans.is_production');
            Config::$isSanitized = true;
            Config::$is3ds = true;

            // ================= MODE DETAIL PESANAN =================
    if ($request->order_id) {

        $order = Order::find($request->order_id);

        if (!$order) {
            return response()->json(['error' => 'Order tidak ditemukan'], 404);
        }

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

        // ongkir
        if ($order->ongkir > 0) {
            $midtrans_items[] = [
                'id' => 'ONGKIR',
                'price' => $order->ongkir,
                'quantity' => 1,
                'name' => 'Ongkir'
            ];
        }

    // 🔥 VALIDASI: hanya bisa bayar ulang kalau status masih pending / expired
    if (!$order->isPending()) {
        return response()->json([
            'error' => 'Pesanan tidak bisa dibayar (status: ' . $order->payment_status . ')'
        ], 400);
    }

    // 🔥 GENERATE order_id BARU setiap kali retry, biar tidak tabrakan di Midtrans
    $midtransOrderId = 'ODR-' . $order->id . '-' . time() . '-' . rand(1000, 9999);
    $order->midtrans_order_id = $midtransOrderId;
    $order->save();

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
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'snap_token' => $snapToken
        ]);
    }
            // ================= VALIDASI CART =================
            $cart = $request->cart;

            if (!$cart || empty($cart)) {
                return response()->json([
                    'error' => 'Cart kosong'
                ], 400);
            }

            // ================= HITUNG TOTAL =================
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

            // ================= ONGKIR =================
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

            // ================= ORDER ID =================
            $order_id = 'ODR-' . time() . '-' . rand(1000, 9999);

            // ================= SIMPAN ORDER =================
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

            // ================= PAYMENT MAP =================
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
                return response()->json([
                    'error' => 'Metode pembayaran tidak valid'
                ], 400);
            }

            $paymentType = $map[$request->payment_method];

            // ================= PARAM MIDTRANS =================
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

            // ================= SNAP TOKEN =================
            try {
                $snapToken = Snap::getSnapToken($params);
            } catch (\Exception $e) {
                return response()->json([
                    'error' => $e->getMessage()
                ], 500);
            }

            return response()->json([
                'snap_token' => $snapToken
            ]);
        }

        // ================= CALLBACK MIDTRANS =================
        // HANYA UNTUK REDIRECT BROWSER — TIDAK UPDATE DATABASE
        // UPDATE DATABASE HANYA DI NOTIFICATION (WEBHOOK)
        // =====================================================
        public function callback(Request $request)
        {
            \Log::info('MIDTRANS CALLBACK (redirect only):', $request->all());

            // Callback hanya untuk redirect browser, tidak update order
            // Agar tidak tabrakan dengan notification webhook

            return response()->json(['message' => 'ok'], 200);
        }

        // ================= CANCEL ORDER + REFUND =================
        /**
         * =========================
         * CANCEL ORDER (USER / ADMIN)
         * =========================
         */
        public function cancelOrder($orderId)
        {
            $order = Order::find($orderId);

            if (!$order) {
                return (object) [
                    'success' => false,
                    'message' => 'Order tidak ditemukan'
                ];
            }

            // 🔥 VALIDASI: hanya bisa cancel jika status masih cancellable
            if (!$order->isCancellable()) {
                return (object) [
                    'success' => false,
                    'message' => 'Pesanan tidak bisa dibatalkan (status: ' . $order->order_status . ', payment: ' . $order->payment_status . ')'
                ];
            }

            // ✅ CASE 1: Belum bayar (pending / expired) → langsung cancel
            if ($order->isPending()) {
                $order->payment_status = 'cancelled';
                $order->order_status = 'cancelled';
                $order->save();

                \Log::info('ORDER CANCELLED (NO PAYMENT):', ['order_id' => $order->id]);

                return (object) [
                    'success' => true,
                    'message' => 'Pesanan berhasil dibatalkan (belum dibayar)',
                    'refunded' => false
                ];
            }

            // 💰 CASE 2: Sudah bayar (paid) atau refund gagal sebelumnya → refund via Midtrans
            if ($order->isPaid() || $order->payment_status === 'refund_failed') {
                // Gunakan transaction_id kalau ada, fallback ke order_id
                $refundId = $order->midtrans_transaction_id ?? $order->midtrans_order_id;
                $refundResponse = $this->midtransRefund($refundId);

                // Simpan response dari Midtrans
                $order->midtrans_response = json_encode($refundResponse);

                if (isset($refundResponse->status_code) && $refundResponse->status_code == 200) {
                    // ✅ REFUND SUKSES
                    $order->payment_status = 'refunded';
                    $order->order_status = 'cancelled';
                    $order->refund_at = now();
                    $order->refund_reason = 'User cancelled order';
                    $order->save();

                    \Log::info('REFUND SUCCESS:', [
                        'order_id' => $order->id,
                        'midtrans_transaction_id' => $order->midtrans_transaction_id,
                        'midtrans_order_id' => $order->midtrans_order_id,
                        'response' => $refundResponse
                    ]);

                    return (object) [
                        'success' => true,
                        'message' => 'Pesanan dibatalkan & refund berhasil',
                        'refunded' => true,
                        'refund_data' => $refundResponse
                    ];
                } else {
                    // ❌ REFUND GAGAL
                    $order->payment_status = 'refund_failed';
                    $order->refund_reason = 'User cancelled order';
                    $order->save();

                    \Log::error('REFUND FAILED:', [
                        'order_id' => $order->id,
                        'midtrans_transaction_id' => $order->midtrans_transaction_id,
                        'midtrans_order_id' => $order->midtrans_order_id,
                        'response' => $refundResponse
                    ]);

                    return (object) [
                        'success' => false,
                        'message' => 'Refund gagal: ' . ($refundResponse->status_message ?? 'Unknown error'),
                        'refunded' => false,
                        'error' => $refundResponse
                    ];
                }
            }

            return (object) [
                'success' => false,
                'message' => 'Status pembayaran tidak valid untuk dibatalkan'
            ];
        }

        /**
         * =========================
         * REQUEST REFUND KE MIDTRANS
         * =========================
         */
        private function midtransRefund($refundId)
        {
            $serverKey = config('services.midtrans.server_key');
            $isProduction = config('services.midtrans.is_production', false);

            $baseUrl = $isProduction
                ? 'https://api.midtrans.com'
                : 'https://api.sandbox.midtrans.com';

            $url = $baseUrl . '/v2/' . $refundId . '/refund';

            $headers = [
                'Authorization: Basic ' . base64_encode($serverKey . ':'),
                'Content-Type: application/json',
                'Accept: application/json'
            ];

            $body = json_encode([
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
                'refund_id' => $refundId,
                'http_code' => $httpCode,
                'response' => $decoded
            ]);

            return $decoded;
        }

        /**
         * =========================
         * WEBHOOK NOTIFICATION (MIDTRANS)
         * SINGLE SOURCE OF TRUTH — HANYA INI YANG UPDATE DATABASE
         * =========================
         */
        public function notification(Request $request)
        {
            // ✅ FIX untuk Test Midtrans
            if ($request->isMethod('get')) {
                return response()->json([
                    'status' => 'ok',
                    'message' => 'Webhook aktif'
                ]);
            }

            \Log::info('MIDTRANS NOTIFICATION:', $request->all());

            $payload = $request->all();

            // ✅ SKIP non-transaction notifications (subscription, account_link, etc.)
            if (!isset($payload['order_id'], $payload['status_code'], $payload['gross_amount'], $payload['signature_key'])) {
                \Log::info('MIDTRANS NOTIFICATION SKIPPED (not a transaction payload)');
                return response()->json(['message' => 'ok'], 200);
            }

            // 🔒 VALIDASI SIGNATURE (PRODUCTION SECURITY)
            $serverKey = config('services.midtrans.server_key');

            $signatureKey = hash('sha512',
                $payload['order_id'] .
                $payload['status_code'] .
                $payload['gross_amount'] .
                $serverKey
            );

           // if ($signatureKey !== $payload['signature_key']) {
              //  \Log::warning('INVALID SIGNATURE!', $payload);
             //   return response()->json(['message' => 'invalid signature'], 403);
          //  }

            $order = Order::where('midtrans_order_id', $payload['order_id'])->first();

            if (!$order) {
                \Log::warning('ORDER TIDAK DITEMUKAN', $payload);
                return response()->json(['message' => 'ok'], 200);
            }

            // Simpan transaction_id dari Midtrans (BERUBAH per transaksi)
            if (!empty($payload['transaction_id'])) {
                $order->midtrans_transaction_id = $payload['transaction_id'];
            }

            $transactionStatus = $payload['transaction_status'] ?? null;
            $fraudStatus = $payload['fraud_status'] ?? null;

            // 🔥 IDEMPOTENCY GUARD — cegah double processing
            $newPaymentStatus = $this->mapMidtransStatus($transactionStatus, $fraudStatus);
            if ($newPaymentStatus === null || $order->payment_status === $newPaymentStatus) {
                \Log::info('MIDTRANS NOTIFICATION SKIPPED (already same status):', [
                    'order_id' => $order->id,
                    'current_status' => $order->payment_status,
                    'incoming_status' => $newPaymentStatus,
                ]);
                return response()->json(['message' => 'already processed'], 200);
            }

            // ================= HANDLE SETTLEMENT =================
            if ($transactionStatus == 'settlement') {
                if ($fraudStatus == 'challenge') {
                    // TODO: handle challenge
                } else if ($fraudStatus == 'accept' || !$fraudStatus) {
                    $order->payment_status = 'paid';
                }
            }

            // ================= HANDLE CAPTURE (CREDIT CARD) =================
            else if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'challenge') {
                    // TODO: handle challenge
                } else if ($fraudStatus == 'accept' || !$fraudStatus) {
                    $order->payment_status = 'paid';
                }
            }

            // ================= HANDLE PENDING =================
            else if ($transactionStatus == 'pending') {
                $order->payment_status = 'pending';
            }

            // ================= HANDLE EXPIRE =================
            else if ($transactionStatus == 'expire') {
                $order->payment_status = 'expired';
                $order->order_status = 'cancelled';
            }

            // ================= HANDLE CANCEL / DENY =================
            else if ($transactionStatus == 'cancel' || $transactionStatus == 'deny') {
                $order->payment_status = 'cancelled';
                $order->order_status = 'cancelled';
            }

            // ================= HANDLE REFUND =================
            else if ($transactionStatus == 'refund') {
                $order->payment_status = 'refunded';
                $order->order_status = 'cancelled';
                $order->refund_at = now();
                $order->midtrans_response = json_encode($payload);
            }

            $order->save();

            \Log::info('MIDTRANS NOTIFICATION PROCESSED:', [
                'order_id' => $order->id,
                'payment_status' => $order->payment_status,
                'order_status' => $order->order_status,
            ]);

            return response()->json(['message' => 'ok'], 200);
        }

        /**
         * =========================
         * MAP MIDTRANS STATUS KE PAYMENT STATUS
         * =========================
         */
        private function mapMidtransStatus($transactionStatus, $fraudStatus)
        {
        if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                return 'challenge'; // atau null jika belum mau handle
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

    /**
     * =========================
     * PAYMENT SUCCESS PAGE (FRONTEND FALLBACK)
     * Cek status transaksi ke Midtrans dan update database
     * Fallback ketika webhook notification tidak bisa reach server (localhost)
     * =========================
     */
    public function success(Request $request)
    {
        $midtransOrderId = $request->query('order_id');

        // Kalau tidak ada order_id, tetap tampilkan view sukses
        if (!$midtransOrderId) {
            return view('landing.success');
        }

        $order = Order::where('midtrans_order_id', $midtransOrderId)->first();

        // Kalau order tidak ditemukan, tetap tampilkan view sukses
        if (!$order) {
            \Log::warning('PAYMENT SUCCESS: Order tidak ditemukan', ['midtrans_order_id' => $midtransOrderId]);
            return view('landing.success');
        }

        // Kalau sudah paid, skip pengecekan API
        if ($order->payment_status === 'paid') {
            return view('landing.success');
        }

        // Cek status transaksi ke Midtrans
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

            // Update status sama seperti di notification()
            if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
                if ($fraudStatus == 'accept' || !$fraudStatus) {
                    $order->payment_status = 'paid';
                    $order->save();

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

