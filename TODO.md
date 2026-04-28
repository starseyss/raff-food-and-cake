# TODO: Filter Pesanan by User ID

- [x] 1. Buat migration tambah kolom `user_id` ke tabel `orders`
- [x] 2. Update model `Order` — tambahkan `user_id` ke `$fillable`
- [x] 3. Update `PaymentController::bayar()` — simpan `user_id` saat order baru
- [x] 4. Update `PesananController::index()` — filter by `auth()->id()`
- [x] 5. Update `PesananController::show()` — cek kepemilikan order
- [x] 6. Update `PesananController::cancel()` — cek kepemilikan order
- [x] 7. Update `PesananController::rating()` — cek kepemilikan order
- [x] 8. Jalankan `php artisan migrate`

✅ SELESAI — Semua perubahan telah diimplementasikan dan migrasi berhasil dijalankan.

