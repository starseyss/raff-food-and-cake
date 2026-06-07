<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
Schema::table('orders', function (Blueprint $table) {
    $table->string('refund_bank_no')->nullable();
    $table->string('refund_owner_name')->nullable();
});

        // Add to admin_notifications
        Schema::table('admin_notifications', function (Blueprint $table) {
            $table->json('refund_data')->nullable()->after('message');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['refund_bank_no', 'refund_owner_name']);
        });

        Schema::table('admin_notifications', function (Blueprint $table) {
            $table->dropColumn('refund_data');
        });
    }
};

