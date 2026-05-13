# TODO - Analisis Driver Rating (Ratings Produk + Comment)

- [ ] Analisis struktur tabel `ratings` dan kolom yang tersedia (product_id, rating, comment, order_id).
- [ ] Ubah query `driverPerformance` di `app/Http/Controllers/AnalisisController.php`:
  - [ ] Ambil per driver: rata-rata rating *produk* dari tabel `ratings` (via order_id).
  - [ ] Tambahkan agregasi comment: list 3-5 comment terbaru atau top comment (default: terbaru).
  - [ ] Tetap batasi periode tanggal analisis dan order_status=delivered.
- [ ] Update blade `resources/views/admin/analisis.blade.php` untuk menampilkan comment (opsional expandable) di kolom driver.
- [ ] Pastikan query tidak N+1 dan tidak memanggil model per baris.
- [ ] Jalankan quick smoke test: buka halaman `/admin/analisis` dan verifikasi data driver.

