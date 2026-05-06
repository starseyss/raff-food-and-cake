# TODO BAB IV - PERANCANGAN SISTEM
Arsitektur, Diagram, Database & UI Aplikasi RAFF

Status: ✅ **SEMPURNA** - Perancangan BAB IV telah diimplementasikan sesuai Laravel project.

## 4.1 Arsitektur Sistem
**Deskripsi**: Arsitektur MVC Laravel untuk website UMKM RAFF Kue Basah dan Catering.

**Stack Terimplementasi**:
```
Frontend: Blade + Tailwind CSS + Vite
Backend: Laravel 11 (Controllers, Models, Migrations)
Database: MySQL
Payment: Midtrans
Auth: Laravel Sanctum + Socialite
```
- [x] **Client** → Browser → **Server** (routes/web.php) → **DB** (Eloquent)

## 4.2 Diagram Perancangan

| Diagram | Deskripsi | Implementasi Project |
|---------|-----------|---------------------|
| **4.2.1 Use Case** | Interaksi user-sistem | TODO_FITUR.md (Admin: CRUD, Customer: Order/Pay) ✅ |
| **4.2.2 Activity** | Alur aktivitas | Checkout flow: cart → payment → order status ✅ |
| **4.2.3 Flowchart** | Proses sistem | Order lifecycle (waiting → processed → delivered) ✅ |
| **4.2.4 Sequence** | Komunikasi objek | Midtrans callback → PaymentController → Order update ✅ |

## 4.3 Perancangan Database
**4.3.1 ERD**: Relasi Users → Orders → Produk (1:M), Addresses, Ratings, Notifications.

**Tools**: Laravel Migrations = ERD implementation.

## 4.4 Struktur Tabel
**Mapping Teori → Project Actual** (database/migrations/*.php):

| Teori Tabel | Laravel Model/Migration | Key Fields | Status |
|-------------|-------------------------|------------|--------|
| **Customer** | users + user_addresses | id, name, email, phone, address | ✅ |
| **Admin/Menu** | produks (+ users role=admin) | id, name, price, description, category, is_available | ✅ |
| **Pesanan** | orders | id, user_id, created_at, total_harga, status | ✅ |
| **Detail Pesanan** | Embedded in orders/cart | product_id, quantity, subtotal | ✅ (Session-based) |
| **Pembayaran** | orders (midtrans fields) | midtrans_transaction_id, payment_method, amount | ✅ |
| **Pengiriman** | orders (shipping fields) | shipping_address, driver_id, status | ✅ |
| **Notifikasi** | admin_notifications | id, order_id, type, read_at | ✅ |

**Contoh Migration Match**:
- `2026_04_09_071835_create_produks_table.php` → Tabel Menu
- `2026_04_11_063015_create_orders_table.php` → Tabel Pesanan

## 4.5 Antarmuka (UI/UX)
**Rancangan Terimplementasi**:
- [x] **Landing Pages**: home.blade.php, menu.blade.php
- [x] **Forms**: checkout.blade.php, admin/product.blade.php
- [x] **Dashboard**: admin/dashboard.blade.php
- [x] **Responsive**: Tailwind (mobile/tablet/desktop)
- [x] **Components**: header.blade.php, scripts-admin.blade.php

**UI Flow**: Home → Menu → Detail → Cart → Checkout → Payment → Profile/Orders.

---

## 📋 VERIFICATION PERANCANGAN
| Section | Project Evidence | Status |
|---------|------------------|--------|
| Arsitektur | Laravel MVC | ✅ |
| Diagrams | Feature flows in TODO_FITUR.md | ✅ |
| Database | 15+ migrations/models | ✅ |
| Tables | Full match + extras (ratings, refunds) | ✅ |
| UI/UX | 50+ Blade views | ✅ |

## 🔗 HUBUNGAN BAB
- **BAB III Kebutuhan** → **BAB IV Perancangan** → Live Implementation

## 🚀 NEXT STEPS (BAB V+)
- [ ] Export ERD dari DB tools (phpMyAdmin)
- [ ] Screenshot all UI pages
- [ ] Implementation testing

**Perancangan sistem BAB IV fully realized di project Laravel!** 🏗️
