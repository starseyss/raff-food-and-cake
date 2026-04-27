<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // DATA PEMESAN
            $table->string('nama_pemesan');
            $table->string('nama_penerima');
            $table->date('tanggal_penerimaan');
            $table->string('no_hp');
            $table->text('alamat');
            $table->text('catatan')->nullable();

            // PENGIRIMAN & PEMBAYARAN
            $table->string('shipping_method');
            $table->string('payment_method');

            // DATA CART (JSON)
            $table->longText('cart_data');

            // TOTAL
            $table->integer('subtotal')->default(0);
            $table->integer('ongkir')->default(0);
            $table->integer('total')->default(0);

            // ================= STATUS PEMBAYARAN =================
            $table->string('payment_status')->default('pending'); 
            // pending | paid

            // ================= STATUS ORDER =================
            $table->string('order_status')->default('order_created');
            // order_created | processing | packed | shipped | delivered | cancelled

            // MIDTRANS
            $table->string('midtrans_order_id')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};