# TODO - Landing Pages & Auth Documentation

Documentation ini berisi semua kolom/field yang relevan dari folder landing dan auth (login & register).

---

## 1. AUTH - Login (`resources/views/auth/login.blade.php`)

### Form Fields:
| Nama Field | Tipe | Keterangan |
|------------|------|------------|
| email | email | Input email user |
| password | password | Input password dengan toggle visibility |
| \`@csrf\` | hidden token | CSRF token untuk keamanan |

### Social Login Buttons:
- Google (`/auth/google`)
- Facebook (`/auth/facebook`)
- Apple (disabled - coming soon)
- X/Twitter (disabled - coming soon)

---

## 2. AUTH - Register (`resources/views/auth/register.blade.php`)

### Form Fields:
| Nama Field | Tipe | Keterangan |
|------------|------|------------|
| first_name | text | Nama depan |
| last_name | text | Nama belakang |
| email | email | Email user |
| password | password | Password dengan toggle visibility |
| password_confirmation | password | Konfirmasi password |
| \`@csrf\` | hidden token | CSRF token untuk keamanan |

### Social Register Buttons:
- Google (`/auth/google`)
- Facebook (`/auth/facebook`)
- Apple (disabled - coming soon)
- X/Twitter (disabled - coming soon)

---

## 3. LANDING - Home (`resources/views/landing/home.blade.php`)

### LocalStorage Cart Item Structure:
```json
{
  "id": "produk_id",
  "name": "nama_produk",
  "price": 50000,
  "image": "/image-product/foto.png",
  "qty": 1,
  "variant": "varian_dipilih",
  "description": "deskripsi produk"
}
```

### Hidden Input:
- loginStatus (untuk cek status login user)

### Product Card Fields (dari database):
| Field | Tipe | Keterangan |
|-------|------|------------|
| id | integer | ID produk |
| nama_produk | string | Nama produk |
| foto_url | string | URL gambar produk |
| harga | integer | Harga normal |
| harga_diskon | integer | Harga setelah diskon |
| diskon | integer | Persentase diskon |
| is_promo | boolean | Apakah sedang promo |
| deskripsi | string | Deskripsi produk |
| varian_array | array |list varian produk |
| total_terjual | integer | Jumlah terjual |
| rating | float | Rating produk (0-5) |

---

## 4. LANDING - Cart (`resources/views/landing/cart.blade.php`)

### LocalStorage Keys:
| Key | Tipe | Keterangan |
|-----|------|------------|
| cart | array | Array item di keranjang |
| selectedCart | array | Item yang dicentang |
| checkoutCart | array | Item untuk checkout |

### Cart Item Structure:
```json
{
  "id": "produk_id",
  "name": "nama_produk",
  "price": 50000,
  "image": "/image-product/foto.png",
  "qty": 2,
  "variant": "varian_dipilih"
}
```

### Displayed Columns (Desktop Grid):
1. Produk (col-span-5) - gambar + nama + varian
2. Harga per pcs (col-span-2)
3. Kuantitas (col-span-2) - tombol +/- Qty
4. Total Harga (col-span-2)
5. Aksi (col-span-1) - tombol hapus

### Summary Fields:
- totalItem: jumlah total item
- totalHarga: total harga keseluruhan

---

## 5. LANDING - Checkout (`resources/views/landing/checkout.blade.php`)

### Form Fields:
| Nama Field | Tipe | Keterangan |
|------------|------|------------|
| cart_data | hidden | Data cart untuk checkout |
| catatan | textarea | Catatan pesanan |
| shipping_method | radio | Metode pengiriman |
| payment_method | radio | Metode pembayaran |

### Shipping Methods:
| Value | Label | Biaya |
|-------|-------|------|
| gosend | GoSend Instant | Rp 15.000 |
| pickup | Ambil Sendiri | Gratis |

### Payment Methods:
| Value | Label |
|-------|-------|
| qris | QRIS |
| bca | BCA |
| bri | BRI |
| mandiri | Mandiri |
| seabank | SeaBank |
| dana | DANA |
| gopay | GoPay |
| permata | Permata Bank |
| visa | Visa |
| bni | BNI |

### Order Summary Fields:
- subtotalProduk: Subtotal produk
- ongkir: Biaya pengiriman
- voucher: Potongan voucher
- totalBayar: Total pembayaran

### Address Modal Fields (Input Form):
| Nama Field | ID Input | Keterangan |
|------------|----------|------------|
| nama | inputNama | Nama alamat |
| penerima | inputPenerima | Nama penerima |
| no_hp | inputHP | Nomor HP |
| tanggal | inputTanggal | Tanggal penerimaan |
| alamat | inputAlamat | Alamat lengkap |

### Address Data Structure (API):
```json
{
  "id": 1,
  "nama": "Nama Alamat",
  "hp": "081234567890",
  "tanggal": "2024-12-25",
  "alamat": "Jl.Contoh No.1",
  "is_main": true,
  "user_id": 1
}
```

---

## 6. LANDING - Profil (`resources/views/landing/profil.blade.php`)

### Displayed User Data:
| Field | Source | Keterangan |
|-------|--------|------------|
| name | auth()->user()->name | Nama user |
| email | auth()->user()->email | Email user |
| created_at | auth()->user()->created_at | Tanggal registrasi |

### Navigation Menu Items:
- Profilku
- Pesanan ku

---

## 7. LANDING - Pesanan (Order List)

### Order Detail Fields (from detail_pesanan.blade.php):
- order_id
- nama produk
- harga
- varian
- jumlah
- status pesanan

---

## 8. API - Address Controller

### Endpoints:
| Method | Route | Keterangan |
|--------|-------|------------|
| GET | /alamat | Ambil semua alamat |
| POST | /alamat | Tambah alamat |
| PUT | /alamat/{id} | Edit alamat |
| DELETE | /alamat/{id} | Hapus alamat |
| POST | /alamat/{id}/main | Jadikan alamat utama |

### Address Table Columns:
| Column | Type |Nullable|
|--------|------|--------|
| id | bigInteger | No |
| user_id | bigInteger | No |
| nama | string | No |
| hp | string | No |
| tanggal | date | Yes |
| alamat | text | No |
| is_main | boolean | No (default: false) |
| created_at | timestamp | No |
| updated_at | timestamp | No |

---

## 9. API - Payment Controller

### Request Body:
```json
{
  "cart": [...],
  "shipping_method": "gosend|pickup",
  "payment_method": "qris|bca|bri|mandiri|seabank|dana|gopay|permata|visa|bni",
  "nama": "Nama Penerima",
  "nama_penerima": "Nama Penerima",
  "tanggal_penerimaan": "2024-12-25",
  "no_hp": "081234567890",
  "alamat": "Alamat Lengkap",
  "total": 150000
}
```

---

## 10. Auth Controller

### Login Fields:
| Field | Validation |
|-------|------------|
| email | required,email |
| password | required |

### Register Fields:
| Field | Validation |
|-------|------------|
| first_name | required |
| last_name | required |
| email | required,email,unique |
| password | required,min:8,confirmed |

---

## Ringkasan Kolom yang Diperlukan:

### User Table (from auth):
- name
- email
- password
- created_at

### Produk Table:
- id
- nama_produk
- deskripsi
- harga
- foto_url
- is_promo
- diskon
- harga_diskon
- total_terjual
- rating
- varian_array (JSON)
- is_available

### Orders Table:
- id
- user_id
- cart_data (JSON)
- shipping_method
- payment_method
- nama_penerima
- no_hp
- tanggal_penerimaan
- alamat
- catatan
- total
- status
- midtrans_transaction_id
- shipping_resi
- refund_reason
- refund_status
- created_at
- updated_at

### UserAddress Table:
- id
- user_id
- nama
- hp
- tanggal
- alamat
- is_main
- created_at
- updated_at

---

*Last updated: 2024*
