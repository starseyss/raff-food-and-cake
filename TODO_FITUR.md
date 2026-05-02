# TODO FITUR - Daftar Semua Fitur Aplikasi

## 📱 FITUR PENGGUNA (CUSTOMER)

### 1. 🔐 Autentikasi Pengguna
- [x] Pendaftaran Pengguna (Register) dengan first_name, last_name, email, password confirmation
- [x] Login Pengguna (email/password dengan remember me)
- [x] Logout Pengguna
- [x] Login Sosial (Google) via Social Auth

### 2. 🏠 Menu & Produk
- [x] Halaman Menu (Landing Page)
- [x] Detail Produk
- [x] Tambah ke Keranjang

### 3. 🛒 Keranjang Belanja
- [x] Lihat Keranjang
- [x] Update Jumlah Item
- [x] Hapus Item dari Keranjang
- [x] Checkout

### 4. 💳 Checkout & Pembayaran
- [x] Form Checkout (nama penerima, alamat, no hp, catatan)
- [x] Pilih Metode Pengiriman (Gosend / Ambil Sendiri)
- [x] Pilih Metode Pembayaran (QRIS, Transfer Bank, E-Wallet)
- [x] Integrasi Midtrans Payment
- [x] Midtrans Callback Handler
- [x] Halaman Pembayaran Berhasil

### 5. 📦 Pesanan
- [x] Riwayat Pesanan
- [x] Detail Pesanan
- [x] Batalkan Pesanan
- [x] Terima/Konfirmasi Pesanan Diterima
- [x] Ajukan Refund
- [x] Rating/Ulasan Produk

### 6. 👤 Profil Pengguna
- [x] Lihat/Edit Profil
- [x] Kelola Alamat (tambah, edit, hapus, utama)
- [x] Buku Alamat

### 7. 📞 Kontak
- [x] Formulir Kontak
- [x] Kirim Email

### 8. 📄 Halaman Statis
- [x] Syarat dan Ketentuan
- [x] Kebijakan Privasi

---

## ⚙️ FITUR ADMIN

### 1. 🔐 Autentikasi Admin
- [x] Login Admin
- [x] Register Admin
- [x] Logout Admin

### 2. 📊 Dashboard
- [x] Statistik Ringkasan
- [x] Pesanan Terbaru
- [x] Ringkasan Pendapatan

### 3. 🏷️ Kelola Produk
- [x] Daftar Produk
- [x] Tambah Produk Baru
- [x] Edit Produk
- [x] Hapus Produk

### 4. 📦 Kelola Pesanan
- [x] Daftar Semua Pesanan
- [x] Batalkan Pesanan
- [x] Update Status Pesanan
- [x] Daftar Pembayaran (Keuangan)
- [x] Kelola Pengiriman
- [x]Assign Driver
- [x] Mulai Pengiriman
- [x] Tandai Terkirim

### 5. 🚚 Pengiriman
- [x] Daftar Pesanan Siap Kirim
- [x] Assign Driver
- [x] Lacak Pengiriman

### 6. 📈 Analisis
- [x] Analisis Penjualan
- [x] Grafik/Chart

### 7. 🔔 Notifikasi
- [x] Daftar Semua Notifikasi
- [x] Tandai Sudah Dibaca
- [x] Tandai Semua Sudah Dibaca
- [x] Proses Refund

### 8. 👤 Profil
- [x] Lihat Profil Admin

---

## 🔧 FITUR TEKNIS

### 1. 💾 Database & Migration
- [x] Users Table dengan role
- [x] Orders Table dengan status
- [x] Products Table
- [x] User Addresses Table
- [x] Ratings Table
- [x] Admin Notifications Table

### 2. 🔔 Sistem Notifikasi
- [x] Real-time Notifications untuk Admin
- [x] Refund Notification
- [x] Unread Count

### 3. 💰 Sistem Refund
- [x] Request Refund
- [x] Refund Data Fields (alasan, norek, nama pemilik)
- [x] Process Refund via Admin

### 4. 💳 Integrasi Midtrans
- [x] Midtrans Order ID
- [x] Midtrans Transaction ID
- [x] Midtrans Callback
- [x] Midtrans Notification Handler

### 5. 🚚 Sistem Pengiriman
- [x] Assign Driver
- [x] Start Delivery
- [x] Mark Delivered
- [x] Shipping Fields

### 6. 📧 Email
- [x] Refund Request Email

---

## 📝 CATATAN

- **Status**: `[x]` = Sudah diimplementasi
- Aplikasi ini menggunakan **Laravel** sebagai backend framework
- Frontend menggunakan **Blade Template** dengan **Tailwind CSS**
- Payment gateway menggunakan **Midtrans**
- Shipping menggunakan **Gosend** integration
