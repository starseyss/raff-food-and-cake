<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_order_notifications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');

            $table->string('title');
            $table->text('message');

            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();

            $table->timestamps();

            $table->index(['user_id', 'is_read']);
            $table->index(['order_id']);
            $table->index(['created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_order_notifications');
    }
};

