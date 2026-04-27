<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Cek dulu apakah kolom sudah ada
        if (!Schema::hasColumn('orders', 'status') || !Schema::hasColumn('orders', 'midtrans_order_id')) {
            
            Schema::table('orders', function (Blueprint $table) {

                if (!Schema::hasColumn('orders', 'status')) {
                    $table->string('status')->default('pending');
                }

                if (!Schema::hasColumn('orders', 'midtrans_order_id')) {
                    $table->string('midtrans_order_id')->nullable();
                }

            });

        }
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            if (Schema::hasColumn('orders', 'status')) {
                $table->dropColumn('status');
            }

            if (Schema::hasColumn('orders', 'midtrans_order_id')) {
                $table->dropColumn('midtrans_order_id');
            }

        });
    }
};