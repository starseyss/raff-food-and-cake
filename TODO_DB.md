# TODO Database - Dokumentasi Tabel dan Penggunaan di Setiap Halaman

## 📊 DAFTAR SEMUA TABLE DI PROJECT

### 1. Table: `users`
**Struktur:**
- id (Primary Key)
- name
- email (unique)
- email_verified_at
- password
- role (default: 'user', bisa 'admin')
- remember_token
- created_at
- updated_at

**Pengguna di Halaman:**
| No | Halaman | Routes | Penggunaan |
|----|---------|--------|-------------|
| 1 | Landing Home | `/` | Tidak langsung (untuk auth check) |
| 2 | Login | `/login` | Autentikasi user |
| 3 | Register | `/register` | Pendaftaran user baru |
| 4 | Profile (Account) | `/account` | Menampilkan data user |
| 5 | Checkout | `/checkout` | Mengambil data user yang login |
| 6 | Pesanan Saya | `/pesanan` | Relasi dengan order (user_id) |
| 7 | Detail Pesanan | `/pesanan/{id}` | Menampilkan data pemesan |
| 8 | Alamat | `/alamat` | Relasi dengan user_addresses |
| 9 | Menu (Rating) | `/menu` | Relasi untuk rating produk |
| 10 | Admin Login | `/admin/login` | Autentikasi admin |
| 11 | Admin Register | `/admin/register` | Pendaftaran admin |
| 12 | Admin Dashboard | `/admin/dashboard` | Cek data admin |
| 13 | Admin Profil | `/admin/profil` | Data profil admin |
| 14 | Admin List Order | `/admin/pesanan` | Relasi user di order |

---

### 2. Table: `produks`
**Struktur:**
- id (Primary Key)
- nama_produk
- harga
- foto
- deskripsi
- varian
- kategori (nullable) - kue / gorengan / snack kecil
- is_promo (boolean, default: false)
- diskon (integer, default: 0)
- created_at
- updated_at

**Pengguna di Halaman:**
| No | Halaman | Routes | Penggunaan |
|----|---------|--------|-------------|
| 1 | Menu | `/menu` | Menampilkan daftar produk |
| 2 | Cart | `/cart` | Menampilkan produk di cart |
| 3 | Checkout | `/checkout` | Mengambil data produk dari cart |
| 4 | Landing Details | `/landing/details/{id}` | Menampilkan detail produk |
| 5 | Admin Product | `/admin/product` | Kelola produk (CRUD) |
| 6 | Admin Dashboard | `/admin/dashboard` | Statistik produk |
| 7 | Admin Analisis | `/admin/analisis` | Analisis penjualan produk |

---

### 3. Table: `orders`
**Struktur:**
- id (Primary Key)
- user_id (Foreign Key, nullable) - relasi ke users
- nama_pemesan
- nama_penerima
- tanggal_penerimaan
- no_hp
- alamat
- catatan (nullable)
- shipping_method
- payment_method
- cart_data (JSON)
- subtotal
- ongkir
- total
- payment_status (default: 'pending')
- order_status (default: 'order_created')
- midtrans_order_id (nullable)
- is_refund (boolean, default: false)
- refund_amount (integer, nullable)
- refund_reason (text, nullable)
- refund_status (nullable) - requested / approved / rejected
- shipped_at (timestamp, nullable)
- delivered_at (timestamp, nullable)
- driver_name (string, nullable)
- driver_phone (string, nullable)
- created_at
- updated_at

**Pengguna di Halaman:**
| No | Halaman | Routes | Penggunaan |
|----|---------|--------|-------------|
| 1 | Checkout | `/checkout` | Membuat pesanan baru |
| 2 | Payment | `/payment` | Pembayaran via Midtrans |
| 3 | Payment Success | `/payment-success` | Konfirmasi pembayaran |
| 4 |Pesanan Saya | `/pesanan` | Daftar pesanan user |
| 5 | Detail Pesanan | `/pesanan/{id}` | Detail pesanan user |
| 6 | Request Refund | `/pesanan/{id}/refund` | Request refund |
| 7 | Cancel Pesanan | `/pesanan/{id}/cancel` | Batalkan pesanan |
| 8 | Admin List Order | `/admin/pesanan` | Semua pesanan |
| 9 | Admin Payment List | `/admin/keuangan` | Laporan keuangan |
| 10 | Admin Shipping | `/admin/pengiriman` | Kelola pengiriman |
| 11 | Admin Update Status | `/admin/orders/{id}/status` | Update status |
| 12 | Admin Assign Driver | `/admin/orders/{id}/assign-driver` | Assign driver |
| 13 | Admin Start Delivery | `/admin/orders/{id}/start-delivery` | Mulai pengiriman |
| 14 | Admin Mark Delivered | `/admin/orders/{id}/mark-delivered` | Tandai diterima |
| 15 | Admin Cancel | `/admin/orders/{id}/cancel` | Batalkan pesanan admin |
| 16 | Admin Dashboard | `/admin/dashboard` | Statistik pesanan |
| 17 | Admin Analisis | `/admin/analisis` | Analisis pesanan |
| 18 | Admin Notifications | `/admin/notifications` | Notifikasi terkait order |
| 19 | Landing Details | `/landing/details/{id}` | Cek status pesanan |

---

### 4. Table: `user_addresses`
**Struktur:**
- id (Primary Key)
- user_id (Foreign Key)
- nama
- hp
- alamat
- tanggal (nullable)
- is_main (boolean, default: false)
- created_at
- updated_at

**Pengguna di Halaman:**
| No | Halaman | Routes | Penggunaan |
|----|---------|--------|-------------|
| 1 | Checkout | `/checkout` | Pilih alamat pengiriman |
| 2 | Profile (Account) | `/account` | Kelola alamat |
| 3 | Alamat | `/alamat` | CRUD alamat |
| 4 | Tambah Alamat | `/alamat` (POST) | Tambah alamat baru |
| 5 | Edit Alamat | `/alamat/{id}` (PUT) | Edit alamat |
| 6 | Hapus Alamat | `/alamat/{id}` (DELETE) | Hapus alamat |
| 7 | Set Main | `/alamat/{id}/main` | Jadikan alamat utama |

---

### 5. Table: `ratings`
**Struktur:**
- id (Primary Key)
- order_id (Foreign Key)
- user_id (Foreign Key, nullable)
- rating (tinyInteger 1-5)
- comment (text)
- created_at
- updated_at

**Pengguna di Halaman:**
| No | Halaman | Routes | Penggunaan |
|----|---------|--------|-------------|
| 1 | Pesanan Saya | `/pesanan` | Rating pesanan |
| 2 | Detail Pesanan | `/pesanan/{id}` | Beri rating |
| 3 | Submit Rating | `/pesanan/{id}/rating` (POST) | Simpan rating |
| 4 | Menu | `/menu` | Tampilkan rating produk |

---

### 6. Table: `admin_notifications`
**Struktur:**
- id (Primary Key)
- order_id (Foreign Key)
- title
- message
- is_read (boolean, default: false)
- read_at (timestamp, nullable)
- created_at
- updated_at

**Pengguna di Halaman:**
| No | Halaman | Routes | Penggunaan |
|----|---------|--------|-------------|
| 1 | Admin Notifications | `/admin/notifications` | Daftar notifikasi |
| 2 | Mark As Read | `/admin/notifications/{id}/read` | Tandai sudah baca |
| 3 | Mark All As Read | `/admin/notifications/read-all` | Baca semua |
| 4 | Process Refund | `/admin/notifications/{id}/process-refund` | Proses refund |
| 5 | Unread Count | `/admin/notifications/unread-count` | Jumlah belum baca |
| 6 | Latest | `/admin/notifications/latest` | Notifikasi terbaru |

---

### 7. Table: `sessions` (Laravel Default)
**Struktur:**
- id (Primary Key)
- user_id (Foreign Key, nullable)
- ip_address
- user_agent
- payload
- last_activity

**Pengguna di Halaman:**
| No | Halaman | Routes | Penggunaan |
|----|---------|--------|-------------|
| 1 | Login | `/login` | Session autentikasi |
| 2 | Register | `/register` | Session autentikasi |
| 3 | Cart | `/cart` | Simpan cart di session |

---

### 8. Table: `cache` (Laravel Default)
**Struktur:**
- key (Primary Key)
- value (longText)
- expiration

---

### 9. Table: `jobs` (Laravel Default)
**Struktur:**
- id (Primary Key)
- queue
- payload
- attempts
- reserved_at
- available_at
- created_at

---

### 10. Table: `password_reset_tokens` (Laravel Default)
**Struktur:**
- email (Primary Key)
- token
- created_at

---

## 🔗 RELASI ANTAR TABLE

```
users (1) ──────────< (N) orders
users (1) ──────────< (N) user_addresses
users (1) ──────────< (N) ratings
orders (1) ──────────< (N) ratings
orders (1) ──────────< (N) admin_notifications
produks (1) ───────< (N) ratings (via order)
produks (1) ───────< (N) orders (via cart_data JSON)
```

## �� RINGKASAN PENGGUNAAN TABLE PER FITUR

| Fitur | Tables Used |
|-------|-------------|
| Autentikasi User | users, sessions |
| Autentikasi Admin | users (role=admin), sessions |
| Menu Produk | produks, ratings |
| Cart Belanja | sessions, produks (di cart_data) |
| Checkout | orders, user_addresses, users |
| Pembayaran | orders (payment_status, midtrans_order_id) |
| Pesanan User | orders, ratings, users, produks |
| Pengiriman | orders (shipping_method, driver, status) |
| Refund | orders (is_refund, refund_*, order_status=cancelled) |
| Rating/Review | ratings, orders, users, produks |
| Alamat User | user_addresses, users |
| Notifications | admin_notifications, orders |
| Dashboard Admin | orders, produks |
| Analisis Penjualan | orders, produks |

## ✅ STATUS COMPLETE

- [x] users table
- [x] produks table
- [x] orders table
- [x] user_addresses table
- [x] ratings table
- [x] admin_notifications table
- [x] sessions table (Laravel default)
- [x] cache table (Laravel default)
- [x] jobs table (Laravel default)
- [x] password_reset_tokens table (Laravel default)
