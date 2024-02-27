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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('service_id')->constrained();
            $table->string('nama')->nullable();
            $table->string('kode')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('no_kendaraan')->nullable();
            $table->enum('status', ['dipesan', 'lunas', 'keranjang']);
            $table->integer('total_harga')->nullable();
            $table->integer('uang_bayar')->nullable();
            $table->integer('uang_kembali')->nullable();
            $table->integer('qty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
