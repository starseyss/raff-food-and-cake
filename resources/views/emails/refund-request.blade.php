<!DOCTYPE html>
<html>
<head>
    <title>Refund Request - {{ $order->midtrans_order_id }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; background: #f4f4f4; padding: 20px; }
        .container { background: white; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); overflow: hidden; }
        .header { background: linear-gradient(135deg, #F59A40, #F97316); color: white; padding: 30px; text-align: center; }
        .content { padding: 30px; }
        .order-info { background: #f8f9fa; border-radius: 8px; padding: 20px; margin-bottom: 20px; }
        .highlight { background: #fff3cd; border-left: 4px solid #f59e0b; padding: 15px; margin: 20px 0; }
        .bank-details { background: #e8f5e8; border-radius: 8px; padding: 20px; }
        .proof-image { max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin: 20px 0; }
        .footer { background: #f8f9fa; padding: 20px; text-align: center; font-size: 14px; color: #666; }
        .btn { display: inline-block; background: #F59A40; color: white; padding: 12px 24px; text-decoration: none; border-radius: 8px; font-weight: 600; margin: 10px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🪙 Permintaan Refund</h1>
            <p>Order #{{ $order->midtrans_order_id }}</p>
        </div>

        <div class="content">
            <div class="order-info">
                <h2>Detail Order</h2>
                <p><strong>Pemesan:</strong> {{ $order->nama_pemesan }}</p>
                <p><strong>Total:</strong> Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                <p><strong>Metode Pembayaran:</strong> {{ $order->payment_method }}</p>
                <p><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
            </div>

            <div class="bank-details">
                <h3>📋 Detail Rekening Tujuan Refund</h3>
                <p><strong>No. Rekening:</strong> {{ $refundData['bank_no'] ?? 'N/A' }}</p>
                <p><strong>Nama Pemilik:</strong> {{ $refundData['owner_name'] ?? 'N/A' }}</p>
            </div>

            @if(isset($refundData['proof_url']))
            <div style="text-align: center;">
                <h3>📸 Bukti Transfer</h3>
                <img src="{{ $refundData['proof_url'] }}" alt="Bukti Transfer" class="proof-image">
                <p style="font-size: 12px; color: #666; margin-top: 8px;">Klik gambar untuk memperbesar</p>
            </div>
            @endif

            <div class="highlight">
                <strong>Status Saat Ini:</strong> Processing Refund<br>
                <a href="{{ url('/admin/notifications/' . $notification->id) }}" class="btn">🔍 Lihat di Admin Panel</a>
            </div>

            <p>Silakan proses refund segera dan tandai sebagai "Sudah Refund" di admin panel.</p>
        </div>

        <div class="footer">
            <p>Diharapkan oleh sistem otomatis Raff Catering</p>
            <p>&copy; {{ date('Y') }} Raff Catering. All rights reserved.</p>
        </div>
    </div>
</body>
</html>

