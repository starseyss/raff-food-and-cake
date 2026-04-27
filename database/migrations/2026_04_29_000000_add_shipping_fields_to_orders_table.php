<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('driver')->nullable()->after('order_status');
            $table->string('delivery_time')->nullable()->after('driver');
            $table->timestamp('shipped_at')->nullable()->after('delivery_time');
            $table->timestamp('delivered_at')->nullable()->after('shipped_at');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['driver', 'delivery_time', 'shipped_at', 'delivered_at']);
        });
    }
};

