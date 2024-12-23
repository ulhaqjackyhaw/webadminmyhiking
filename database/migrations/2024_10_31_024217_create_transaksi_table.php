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
            $table->bigInteger('id_pesanan')->constrained('pesanan')->onDelete('cascade');
            $table->string('metode_pembayaran', 60);
            $table->integer('total_bayar');
            $table->enum('status_pesanan', ['Verified', 'Unverified'])->default('Unverified'); // Kolom status dengan pilihan enum
            $table->date('waktu_pembayaran')->nullable();
            $table->string('bukti')->nullable();
            $table->timestamps(); // Kolom created_at dan updated_at

            $table->foreign('id_pesanan')->references('id')->on('pesanan')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
};
