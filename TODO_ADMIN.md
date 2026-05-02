# TODO_ADMIN.md - Admin Dashboard

## 📁 Folder Admin: resources/views/admin/

---

### 1. dashboard.blade.php
**Isi/Ditampilkan:**
- Total Sales (Rp)
- Total Orders (jumlah)
- Customer (jumlah)
- Sales Summary Chart (grafikline)
- Recent Orders (tabel 5 pesanan terakhir)
- Best Seller Products (produk terlaris)

**Tabel Database:** `orders`
**Kolom Terkait:** 
- `id`, `nama_pemesan`, `midtrans_order_id`, `total`, `payment_status`, `order_status`, `created_at`
- Relasi ke `produks` melalui `cart_data` (JSON)

---

### 2. list-order.blade.php
**Isi/Ditampilkan:**
- Total Orders, Pending Orders, Processing, Completed, Cancelled, Total Revenue
- Semua pesanan (tabel): Order ID, Customer, Date, Amount, Payment, Status
- Modal Update Status (Processing, Packed)
- Modal Detail Pesanan:
  - Customer, Recipient, Phone, Date, Address
  - Payment Method, Amount, Status
  - Product Details (dari cart_data)
  - Subtotal, Ongkir, Total
- Action: Detail, Update, Cancel

**Tabel Database:** `orders`
**Kolom Terkait:**
- `id`, `nama_pemesan`, `nama_penerima`, `no_hp`, `alamat`, `tanggal_penerimaan`, `catatan`
- `payment_method`, `payment_status`
- `cart_data` (JSON), `subtotal`, `ongkir`, `total`
- `order_status`, `midtrans_order_id`
- `user_id`, `created_at`

---

### 3. product.blade.php
**Isi/Ditampilkan:**
- Total Product, Active Product, Unavailable Product, Best Seller
- Semua produk (tabel): Picture, Product ID, Name, Category, Price, Status
- Filter: Category, Availability, Price Range
- Search
- Modal Tambah/Edit Produk:
  - Nama Produk, Harga, Kategori
  - Promo (checkbox), Availability (checkbox)
  - Diskon (%), Varian, Foto, Deskripsi
- Modal Detail Produk

**Tabel Database:** `produks`
**Kolom Terkait:**
- `id`, `product_id`, `nama_produk`, `harga`, `foto`, `deskripsi`
- `kategori`, `varian`, `is_promo`, `diskon`, `is_available`

---

### 4. analisis.blade.php
**Isi/Ditampilkan:**
- Total Penjualan, Total Order, Rata-rata Order
- Order Selesai, Order Terlambat
- Grafik Penjualan (bar chart per bulan)
- Pie Chart: Penjualan per Kategori
- Tabel: Penjualan Per Area
- Tabel: Menu Terlaris (Top 5)
- Tabel: Performa Driver
- Insights/Tips

**Tabel Database:** `orders`, `produks`
**Kolom Terkait:**
- `orders`: `id`, `total`, `created_at`, `order_status`, `alamat`
- `produks`: `id`, `nama_produk`, `kategori`
- Aggregate dari `cart_data` (JSON)

---

### 5. notifications.blade.php
**Isi/Ditampilkan:**
- Total Notifications, Unread, Read
- List notifikasi: Icon, Title, Message, Order ID, Time
- Status NEW jika belum dibaca
- Refund Data (jika ada): Bank, No Rekening, Nama Pemilik
- Action: Mark as Read, View Order, Proses Refund

**Tabel Database:** `admin_notifications`, `orders`
**Kolom Terkait (admin_notifications):**
- `id`, `order_id`, `title`, `message`, `is_read`, `read_at`, `refund_data` (JSON)

---

### 6. payment-list.blade.php
**Isi/Ditampilkan:**
- Total Transaction, Pending, Paid (Settlement), Failed/Expired
- Semua pembayaran (tabel): Order ID, Customer, Method, Amount, Status, Time
- Filter: Status, Method, Date Range
- Modal Payment Detail

**Tabel Database:** `orders`
**Kolom Terkait:**
- `id`, `midtrans_order_id`, `nama_pemesan`, `payment_method`, `payment_status`, `total`, `created_at`

---

### 7. shipping.blade.php
**Isi/Ditampilkan:**
- Scheduled, Ready to Ship, On Delivery, Delivered
- Semua pengiriman (tabel): Order ID, Customer, Address, Delivery Date, Time, Driver, Status
- Filter: Status, Date, Driver
- Search Order/Customer
- Modal Detail Pengiriman
- Quick Assign Driver

**Tabel Database:** `orders`
**Kolom Terkait:**
- `id`, `midtrans_order_id`, `nama_pemesan`, `nama_penerima`, `no_hp`
- `alamat`, `tanggal_penerimaan`, `delivery_time`
- `driver`, `shipped_at`, `order_status`
- `payment_method`, `cart_data`, `subtotal`, `ongkir`, `total`

---

### 8. profil.blade.php
**Isi/Ditampilkan:**
- Avatar (inisial nama)
- Nama Lengkap, Email, Role, Bergabung Seitgl

**Tabel Database:** `users` (via auth())
**Kolom Terkait:**
- `id`, `name`, `email`, `role`, `created_at`

---

### 9. login.blade.php
**Isi/Ditampilkan:**
- Form Login Admin
- Email, Password

**Tabel Database:** `users`
**Kolom Terkait:** `id`, `email`, `password`, `role`

---

### 10. register.blade.php
**Isi/Ditampilkan:**
- Form Register Admin
- Name, Email, Password, Confirm Password

**Tabel Database:** `users`
**Kolom Terkait:** `id`, `name`, `email`, `password`, `role`

---

## 🗄️ Ringkasan Tabel Database

### 1. `users`
| Kolom | Tipe |
|-------|------|
| id | bigint |
| name | string |
| email | string |
| password | string |
| role | string |

### 2. `orders`
| Kolom | Tipe |
|-------|------|
| id | bigint |
| user_id | bigint |
| nama_pemesan | string |
| nama_penerima | string |
| no_hp | string |
| alamat | text |
| tanggal_penerimaan | date |
| catatan | text |
| payment_method | string |
| payment_status | string |
| cart_data | longText |
| subtotal | integer |
| ongkir | integer |
| total | integer |
| order_status | string |
| midtrans_order_id | string |
| driver | string |
| delivery_time | string |
| shipped_at | timestamp |
| refund_data | text |
| midtrans_transaction_id | string |

### 3. `produks`
| Kolom | Tipe |
|-------|------|
| id | bigint |
| product_id | string |
| nama_produk | string |
| harga | integer |
| foto | string |
| deskripsi | text |
| varian | string |
| kategori | string |
| is_promo | boolean |
| diskon | integer |
| is_available | boolean |

### 4. `admin_notifications`
| Kolom | Tipe |
|-------|------|
| id | bigint |
| order_id | bigint |
| title | string |
| message | text |
| is_read | boolean |
| read_at | timestamp |

### 5. `user_addresses`
| Kolom | Tipe |
|-------|------|
| id | bigint |
| user_id | bigint |
| nama | string |
| hp | string |
| alamat | text |
| tanggal | date |
| is_main | boolean |

---

*Updated: 2025*
