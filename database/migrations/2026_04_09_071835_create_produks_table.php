<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();

            $table->string('nama_produk');
            $table->integer('harga');
            $table->string('foto');
            $table->text('deskripsi')->nullable();
            $table->string('varian')->nullable();

            // =========================
            // 🔥 FITUR BARU
            // =========================
            $table->string('kategori')->nullable(); // kue / gorengan / snack kecil
            $table->boolean('is_promo')->default(false); // promo aktif/tidak
            $table->integer('diskon')->default(0); // persen diskon

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};