<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('user_addresses', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');

        $table->string('nama');
        $table->string('hp');
        $table->text('alamat');
        $table->date('tanggal')->nullable();

        $table->boolean('is_main')->default(false);

        $table->timestamps();
    });
}
};
