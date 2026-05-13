<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Laporan Analisis {{ $monthName }} {{ $year }}</title>
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; color:#111827; }
        .container { padding: 24px; }
        .header { display:flex; align-items:center; justify-content:space-between; margin-bottom: 18px; }
        .logo { display:flex; align-items:center; gap:12px; }
        .logo img { width:64px; height:auto; }
        .title { font-size:18px; font-weight:800; margin:0; }
        .subtitle { font-size:12px; margin:2px 0 0 0; color:#374151; }
        .meta { font-size:12px; color:#374151; margin-top:8px; }
        .section { margin-top: 14px; }
        table { width:100%; border-collapse: collapse; margin-top:10px; }
        th, td { border:1px solid #e5e7eb; padding:8px; font-size:12px; }
        th { background:#fff7ed; text-align:left; }
        .grid-2 { display:flex; gap:14px; }
        .box { flex:1; border:1px solid #e5e7eb; border-radius:10px; padding:12px; }
        .box h3 { margin:0 0 10px 0; font-size:13px; }
        .kpi { display:flex; justify-content:space-between; margin: 6px 0; font-size:12px; }
        .kpi strong { font-size:12px; }
        .muted { color:#6b7280; }
        .small { font-size:11px; }
        .footer { margin-top: 18px; font-size:11px; color:#6b7280; }
        .note { white-space: pre-line; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="{{ public_path('images/rafflogo.png') }}" alt="Logo" />
                <div>
                    <p class="title">Laporan Analisis</p>
                    <p class="subtitle">{{ $monthName }} {{ $year }} • Ringkasan performa bisnis & penjualan</p>
                    <div class="meta">
                        Periode: {{ $dateRangeLabel }}
                    </div>
                </div>
            </div>
            <div class="small muted text-right">
                Dicetak pada: {{ $printedAt }}
            </div>
        </div>

        <div class="section">
            <div class="grid-2">
                <div class="box">
                    <h3>Ringkasan</h3>
                    <div class="kpi"><span>Total Penjualan</span><strong>Rp {{ number_format($totalSales,0,',','.') }}</strong></div>
                    <div class="kpi"><span>Total Order</span><strong>{{ $totalOrders }}</strong></div>
                    <div class="kpi"><span>Rata-rata Order</span><strong>Rp {{ number_format($avgOrder,0,',','.') }}</strong></div>
                    <div class="kpi"><span>Order Selesai</span><strong>{{ $completedOrders }} ({{ $totalDelivered }}%)</strong></div>
                    <div class="kpi"><span>Order Terlambat</span><strong>{{ $lateOrders }} ({{ $latePercentage }}%)</strong></div>
                </div>
                <div class="box">
                    <h3>Insight</h3>
                    @forelse($insights as $insight)
                        <div class="kpi" style="flex-direction:column; align-items:flex-start; gap:2px; border-bottom:1px solid #f3f4f6; padding-bottom:8px; margin-bottom:8px;">
                            <span class="muted small">{{ strtoupper($insight['type']) }}</span>
                            <strong>{{ $insight['title'] }}</strong>
                            <span class="muted small note">{{ $insight['desc'] }}</span>
                        </div>
                    @empty
                        <div class="muted small">Tidak ada insight pada periode ini.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="section">
            <div class="grid-2">
                <div class="box">
                    <h3>Dashboard Snapshot</h3>
                    <div class="kpi"><span>Total Orders</span><strong>{{ $statsOrders['total_orders'] ?? 0 }}</strong></div>
                    <div class="kpi"><span>Pending Orders</span><strong>{{ $statsOrders['pending_orders'] ?? 0 }}</strong></div>
                    <div class="kpi"><span>Processing</span><strong>{{ $statsOrders['processing'] ?? 0 }}</strong></div>
                    <div class="kpi"><span>Completed</span><strong>{{ $statsOrders['completed'] ?? 0 }}</strong></div>
                    <div class="kpi"><span>Cancelled</span><strong>{{ $statsOrders['cancelled'] ?? 0 }}</strong></div>
                </div>
                <div class="box">
                    <h3>Product Snapshot</h3>
                    <div class="kpi"><span>Total Produk</span><strong>{{ $productTotal ?? 0 }}</strong></div>
                    <div class="kpi"><span>Active</span><strong>{{ $productActive ?? 0 }}</strong></div>
                    <div class="kpi"><span>Unavailable</span><strong>{{ $productUnavailable ?? 0 }}</strong></div>
                    <div class="kpi"><span>Best Seller</span><strong>{{ $bestSellerName ?? '-' }}</strong></div>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="box">
                <h3>Daftar Order (periode {{ $monthName }} {{ $year }})</h3>

                <table>
                    <thead>
                        <tr>
                            <th style="width:15%">Tanggal</th>
                            <th style="width:15%">Order ID</th>
                            <th style="width:25%">Status Pembayaran</th>
                            <th style="width:25%">Status Order</th>
                            <th style="text-align:right; width:20%">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $o)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($o->created_at)->format('d M Y') }}</td>



                                <td>{{ $o->id }}</td>
                                <td>{{ $o->payment_status }}</td>
                                <td>{{ $o->order_status }}</td>
                                <td style="text-align:right; font-weight:700">Rp {{ number_format($o->total,0,',','.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="muted small">Tidak ada data order untuk periode ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>


        <div class="section">
            <div class="grid-2">
                <div class="box">
                    <h3>Payment Management</h3>
                    <div class="kpi"><span>Total Transaction</span><strong>{{ number_format($paymentStats['total_transaction'] ?? 0) }}</strong></div>
                    <div class="kpi"><span>Pending</span><strong>{{ number_format($paymentStats['pending'] ?? 0) }}</strong></div>
                    <div class="kpi"><span>Paid (Settlement)</span><strong>{{ number_format($paymentStats['paid'] ?? 0) }}</strong></div>
                    <div class="kpi"><span>Failed / Expired</span><strong>{{ number_format($paymentStats['failed_expired'] ?? 0) }}</strong></div>
                </div>
                <div class="box">
                    <h3>Daftar Payment (terbaru)</h3>
                    <table>
                        <thead>
                            <tr>
                                <th style="width:25%">Order ID</th>
                                <th>Customer</th>
                                <th style="width:20%">Method</th>
                                <th style="width:20%">Status</th>
                                <th style="text-align:right; width:25%">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ordersPayment ?? [] as $p)
                                <tr>
                                    <td>{{ $p->midtrans_order_id }}</td>
                                    <td>{{ $p->nama_pemesan }}</td>
                                    <td>{{ strtoupper($p->payment_method) }}</td>
                                    <td>{{ strtolower($p->payment_status) }}</td>
                                    <td style="text-align:right; font-weight:700">Rp {{ number_format($p->total,0,',','.') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="muted small">Tidak ada data payment pada periode ini.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="grid-2">
                <div class="box">
                    <h3>Penjualan Per Area (Top 5)</h3>

                    <table>
                        <thead>
                            <tr>
                                <th>Area</th>
                                <th style="text-align:right; width: 40%">Penjualan</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($areaSales as $area)
                            <tr>
                                <td>{{ $area['area'] }}</td>
                                <td style="text-align:right; font-weight:700">Rp {{ number_format($area['value'],0,',','.') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box">
                    <h3>Menu Terlaris (Top 5)</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th style="text-align:right; width: 40%">Terjual</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($topProducts as $product)
                            <tr>
                                <td>{{ $product['name'] }}</td>
                                <td style="text-align:right; font-weight:700">{{ $product['qty'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="box">
                <h3>Performa Driver (Top 5)</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Driver</th>
                            <th style="text-align:right; width: 40%">Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($driverPerformance as $driver)
                        <tr>
                            <td>{{ $driver['name'] }}</td>
                            <td style="text-align:right; font-weight:700">★ {{ $driver['rating'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="footer">
            Catatan: Laporan dihasilkan otomatis dari data transaksi periode {{ $monthName }} {{ $year }}.
        </div>
    </div>
</body>
</html>

