iy# Plan Perbaikan shipping.blade.php

## Informasi yang Ditemukan

Setelah membaca file-file berikut:
- `resources/views/admin/shipping.blade.php`
- `app/Http/Controllers/Admin/OrderController.php`
- `routes/web.php`
- `app/Models/Order.php`
- `database/migrations/2026_04_29_000000_add_shipping_fields_to_orders_table.php`

## Masalah yang Ditemukan

1. **Tombol Assign duplikat** di kolom Action (baris sekitar 170-171). Ada tombol Assign di dalam blok `@if($orderStatus == 'packed' && !$hasDriver)` dan juga tombol Assign di luar semua kondisi, sehingga muncul 2x di setiap baris.
2. **Form action di modal menggunakan hardcoded URL** (`/admin/orders/${orderId}/assign-driver`) via JavaScript, sebaiknya menggunakan named route Laravel agar lebih aman.
3. **Tidak ada tampilan flash message** (success/error) di view, sehingga admin tidak tahu apakah assign berhasil atau gagal.
4. Tombol "Assign" seharusnya hanya muncul untuk order dengan status `packed` dan belum punya driver.

## Rencana Perbaikan (File: `resources/views/admin/shipping.blade.php`)

### Edit 1: Hapus tombol Assign duplikat
- Hapus tombol `<button onclick="openQuickAssign(...)" class="bg-orange-500...">Assign</button>` yang berada di luar blok if/elseif (sekitar baris 170-171).

### Edit 2: Tambahkan flash message section
- Tambahkan div notifikasi di bagian atas halaman (setelah header atau sebelum tabel) untuk menampilkan `session('success')` dan `session('error')`.

### Edit 3: Perbaiki modal form action
- Gunakan named route helper Laravel di form action. Ubah dari hardcoded URL di JS menjadi menggunakan `route('admin.assign-driver', ':id')` dengan replace `:id`.

### Edit 4: Tambahkan @method('PUT') atau sesuaikan
- Controller `assignDriver` menggunakan `Request $request` biasa (POST), route juga POST. Ini sudah benar, tidak perlu diubah.

## Dependent Files
- Hanya `resources/views/admin/shipping.blade.php` yang perlu diedit.
- Controller dan route sudah benar, tidak perlu diubah.

## Follow-up Steps
1. Edit file `shipping.blade.php`
2. Test dengan klik Assign → isi form → submit → cek database & tabel

