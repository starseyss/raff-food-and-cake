# TODO Refund & Payment Fix

## Langkah-langkah Implementasi

- [x] 1. Analisis file `PaymentController.php` dan `Order.php`
- [x] 2. Update fungsi `bayar()` (Mode Retry)
  - [x] Pindahkan validasi `isPending()` ke awal setelah find order
  - [x] Gunakan `midtrans_order_id` yang sudah ada; generate baru hanya jika null
  - [x] Cast ongkir ke `(int)`
- [x] 3. Update fungsi `cancelOrder()`
  - [x] Handle 404 dari Midtrans dengan cancel lokal
  - [x] Terima status code `201` untuk refund sukses/pending
  - [x] Gabungkan handling `expire`, `cancel`, `deny`, `refund` jadi satu blok
- [x] 4. Verifikasi hasil edit (PHP lint passed)

## Ringkasan Perubahan

### 1. Fungsi `bayar()` - Mode Retry
- **Validasi di awal:** Pengecekan `isPending()` dilakukan sebelum memproses data cart/Midtrans.
- **Order ID konsisten:** Menggunakan `$order->midtrans_order_id` yang tersimpan di database. Jika masih `null`, baru generate `ODR-{id}-{time}`.
- **Ongkir casting:** `price` ongkir di-cast ke `(int)` untuk memastikan tipe data integer sesuai standar Midtrans.

### 2. Fungsi `cancelOrder()`
- **Handle 404 Transaction Not Found:** Jika `checkMidtransStatus()` mengembalikan `null` (transaksi tidak ditemukan di Midtrans), sistem langsung melakukan cancel lokal tanpa error, karena user memang belum melakukan pembayaran.
- **Refund status code 201:** Midtrans bisa mengembalikan `201` untuk refund yang sedang diproses. Sekarang diterima sebagai sukses bersama `200`.
- **Combined final statuses:** `expire`, `cancel`, `deny`, dan `refund` ditangani dalam satu blok yang lebih ringkas.

### File yang diubah:
- `app/Http/Controllers/PaymentController.php` (full rewrite dengan perbaikan di atas)

