# TODO_Alur_Customer.md

## Activity Diagram - Alur Customer (Pemesanan sampai Pengiriman)

```mermaid
flowchart TD
  A([Mulai]) --> B[Customer buka landing/menu]
  B --> C[Tambah produk ke keranjang]
  C --> D[Checkout]
  D --> E[Pilih alamat & input data]
  E --> F{Submit pesanan}

  F -->|Ya| G[Server buat Order (status awal: pending)]
  G --> H[Redirect/inisialisasi pembayaran Midtrans]

  H --> I{Respon Midtrans}
  I -->|PAID| J[Update Order: status paid]
  I -->|PENDING| K[Update Order: status pending]
  I -->|FAILED| L[Update Order: status failed]

  J --> M[Admin proses shipping]
  K --> M
  L --> N[Customer lihat hasil pembayaran gagal]

  M --> O[Update Order: shipped/packed/delivered]
  O --> P[Customer tracking detail pesanan]

  P --> Q([Selesai])
```

---

## Catatan sederhana
- Jalur **paid** / **pending** akan berakhir pada tahap **shipping** setelah admin memproses.
- Jalur **failed** berhenti di tahap status gagal (customer bisa coba bayar ulang sesuai kebijakan sistem).

