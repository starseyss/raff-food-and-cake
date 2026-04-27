<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produks';

    protected $fillable = [
        'nama_produk',
        'harga',
        'foto',
        'deskripsi',
        'varian',

        // 🔥 TAMBAHAN BARU
        'kategori',
        'is_promo',
        'diskon',
        'is_available',
    ];

    /**
     * Generate Product ID untuk tampilan frontend.
     * Format: 4 huruf dari nama produk + 6 angka deterministik.
     */
    public function getProductIdAttribute()
    {
        $lettersOnly = preg_replace('/[^a-zA-Z]/', '', strtoupper($this->nama_produk));

        // Jika tidak ada huruf, fallback ke 'ABCD'
        if (strlen($lettersOnly) < 4) {
            $lettersOnly = str_pad($lettersOnly, 4, 'X', STR_PAD_RIGHT);
        }

        $length = strlen($lettersOnly);

        // Pilih 4 huruf secara deterministik berdasarkan id agar tetap konsisten
        $indexes = [
            ($this->id * 3) % $length,
            ($this->id * 5) % $length,
            ($this->id * 7) % $length,
            ($this->id * 11) % $length,
        ];

        // Hindari huruf yang sama di posisi berbeda jika memungkinkan
        if ($indexes[1] === $indexes[0]) $indexes[1] = ($indexes[1] + 1) % $length;
        if ($indexes[2] === $indexes[0] || $indexes[2] === $indexes[1]) $indexes[2] = ($indexes[2] + 2) % $length;
        if ($indexes[3] === $indexes[0] || $indexes[3] === $indexes[1] || $indexes[3] === $indexes[2]) $indexes[3] = ($indexes[3] + 3) % $length;

        $prefix = $lettersOnly[$indexes[0]]
                . $lettersOnly[$indexes[1]]
                . $lettersOnly[$indexes[2]]
                . $lettersOnly[$indexes[3]];

        // Generate 6 angka deterministik dari hash kombinasi id dan nama
        $hashNum = abs(crc32($this->id . '-' . $this->nama_produk)) % 1000000;
        $suffix = str_pad($hashNum, 6, '0', STR_PAD_LEFT);

        return $prefix . $suffix;
    }

    /**
     * URL foto produk dari folder public/image-product
     */
    public function getFotoUrlAttribute()
    {
        if ($this->foto && file_exists(public_path('image-product/' . $this->foto))) {
            return asset('image-product/' . $this->foto);
        }

        return asset('images/no-image.png');
    }

    /**
     * Varian jadi array
     */
    public function getVarianArrayAttribute()
    {
        if (!$this->varian) {
            return [];
        }

        return array_filter(array_map('trim', explode(',', $this->varian)));
    }

    /**
     * Cek status promo (helper)
     */
    public function getIsPromoActiveAttribute()
    {
        return (bool) $this->is_promo;
    }

    /**
     * Harga setelah diskon (optional helper)
     */
    public function getHargaDiskonAttribute()
    {
        if (!$this->is_promo || !$this->diskon) {
            return $this->harga;
        }

        return $this->harga - ($this->harga * $this->diskon / 100);
    }
}