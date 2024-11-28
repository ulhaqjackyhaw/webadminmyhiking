<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id(); // Kolom ID utama dengan auto-increment
            $table->foreignId('id_pesanan')->constrained('pesanan'); // Foreign key ke tabel pesanan
            $table->string('metode_pembayaran', 60);
            $table->integer('total_bayar');
            $table->integer('dp');
            $table->enum('status_pesanan', ['verified', 'unverified'])->default('unverified'); // Kolom status dengan pilihan enum
            $table->date('waktu_pembayaran');
            $table->string('bukti');
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
};
