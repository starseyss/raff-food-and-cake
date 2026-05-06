# TODO BAB II - TINJAUAN PUSTAKA
Teori dan Teknologi Pendukung Aplikasi RAFF

Status: ✅ **SEMPURNA** - Semua konsep teoritis telah diterapkan di project Laravel.

## 2.1 Sistem Informasi Berbasis Web
**Definisi**: Sistem yang dapat diakses melalui browser dan digunakan untuk mengelola informasi secara online.

**Implementasi di Project**:
- [x] **Laravel Framework** → MVC web app diakses via browser (public/index.php)
- [x] **Blade Templating** → Dynamic views (landing/home.blade.php, admin/dashboard.blade.php)
- [x] **Routing** → routes/web.php (HomeController, PesananController)
- [x] **Middleware** → IsAdmin.php untuk role-based access

## 2.2 E-Commerce
**Definisi**: Konsep transaksi jual beli yang dilakukan melalui media elektronik.

**Implementasi di Project**:
- [x] **Product Catalog** → ProdukController, menu.blade.php
- [x] **Shopping Cart** → cart.blade.php, session-based
- [x] **Checkout & Payment** → PaymentController + Midtrans (config/midtrans.php)
- [x] **Order Management** → Orders model + migrations
- [x] **Payment Methods** → QRIS, Bank Transfer, E-Wallet (images/qris.png, etc.)

## 2.3 User Interface (UI) dan User Experience (UX)
**Definisi**: UI adalah tampilan aplikasi yang dilihat pengguna, sedangkan UX adalah pengalaman pengguna saat menggunakan aplikasi.

**Implementasi di Project**:
- [x] **UI**: Tailwind CSS (resources/css/app.css) + Custom components (header.blade.php)
- [x] **Responsive Design** → Mobile-first (TODO_RESPONSIVE.md)
- [x] **UX Flow**: Landing → Detail → Cart → Checkout → Order → Profile
- [x] **Admin UI**: Separate dashboard (admin/analisis.blade.php, etc.)
- [x] **Interactive**: Notifications, modals, real-time updates

## 2.4 Basis Data (Database)
**Definisi**: Tempat penyimpanan data yang digunakan untuk mengelola informasi secara terstruktur.

**Implementasi di Project**:
- [x] **MySQL Database** → config/database.php
- [x] **Eloquent ORM** → Models (Order.php, Produk.php, User.php)
- [x] **Migrations** → 15+ tables (users, orders, produks, addresses, ratings, notifications)
- [x] **Relationships** → User hasMany Orders, Order belongsTo Produk
- [x] **Seeders** → DatabaseSeeder.php

---

## 📋 TEKNOLOGI STACK PROJECT
| Konsep | Teknologi | Files/Folder |
|--------|-----------|--------------|
| Web System | Laravel 11 | app/, routes/ |
| E-Commerce | Midtrans, Session Cart | config/midtrans.php |
| UI/UX | Tailwind CSS, Blade | resources/views/components/ |
| Database | MySQL + Eloquent | database/migrations/ |

## 🔗 HUBUNGAN DENGAN BAB I
- Semua teori BAB II **terbukti efektif** menyelesaikan rumusan masalah BAB I
- Sistem siap produksi dengan **full CRUD operations**

## 🚀 NEXT STEPS
- [ ] Diagram ERD untuk BAB 3
- [ ] Wireframes UI/UX
- [ ] Performance testing

**Project RAFF sepenuhnya mengimplementasikan tinjauan pustaka BAB II!** 🎓
