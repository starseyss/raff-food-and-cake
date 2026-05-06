# TODO BAB III - ANALISIS KEBUTUHAN
Analisis Pengguna, Fungsional & Non-Fungsional Aplikasi RAFF

Status: ✅ **SEMPURNA** - Semua kebutuhan BAB III telah terpenuhi oleh project.

## 3.1 Analisis Pengguna

### 1. Admin
- [x] **Mengelola data produk** → admin/product.blade.php, ProdukController
- [x] **Mengelola data pesanan** → admin/list-order.blade.php, PesananController
- [x] **Melihat laporan pesanan** → admin/analisis.blade.php, AnalisisController + charts

### 2. Pelanggan
**Deskripsi**: Pengguna yang memesan menu kue/catering secara online.

**Fitur Terimplementasi**:
- [x] Lihat daftar menu → landing/menu.blade.php
- [x] Pilih produk → details.blade.php + Add to Cart
- [x] Pemesanan → checkout.blade.php
- [x] Pembayaran → PaymentController + Midtrans
- [x] Track status → pesanan.blade.php, detail_pesanan.blade.php

## 3.2 Kebutuhan Fungsional

**Fitur Utama**:
- [x] **Login dan autentikasi** → auth/login.blade.php, SocialAuthController (Google)
- [x] **Katalog produk** → HomeController@menu()
- [x] **Detail produk** → details.blade.php
- [x] **Fitur keranjang** → cart.blade.php (update/hapus)
- [x] **Pemesanan online** → Order model + migrations
- [x] **Manajemen produk admin** → CRUD di admin/product.blade.php
- [x] **Manajemen pesanan admin** → Status update, shipping, refund

## 3.3 Kebutuhan Non-Fungsional

| Kebutuhan | Implementasi | Status |
|-----------|--------------|---------|
| **Keamanan** | Auth middleware (IsAdmin.php), Midtrans secure payments, Role-based access | ✅ |
| **Performa** | Laravel caching (config/cache.php), Optimized queries | ✅ |
| **Kompatibilitas** | Cross-browser (Chrome, Firefox, Safari), Responsive Tailwind | ✅ |
| **Usability** | Intuitive UX (cart flow, modals), Notifications real-time | ✅ |

---

## 📋 MAPPING KE PROJECT FILES
| Kebutuhan | Controller/View/Model |
|-----------|----------------------|
| Admin Product Mgmt | AdminDashboardController / admin/product.blade.php / Produk.php |
| Customer Orders | PesananController / pesanan.blade.php / Order.php |
| Reports | AnalisisController / admin/analisis.blade.php |
| Auth | AdminAuthController / admin/login.blade.php |

## 🔗 HUBUNGAN ANTAR BAB
- **BAB I**: Masalah → **BAB III**: Kebutuhan → **BAB II**: Teori
- Semua requirements terverifikasi via TODO_FITUR.md

## 🚀 NEXT STEPS (BAB IV+)
- [ ] Diagram Use Case
- [ ] ERD Database
- [ ] UI Wireframes/Screenshots
- [ ] Testing Results

**Analisis kebutuhan BAB III 100% matched dengan implementasi project!** ✅
