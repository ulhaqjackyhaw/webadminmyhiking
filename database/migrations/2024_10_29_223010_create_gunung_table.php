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
        Schema::create('gunung', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->char('province_id', 2); // Kode provinsi
            $table->char('regency_id', 4); // Kode kabupaten/kota
            $table->char('district_id', 7); // Kode kecamatan
            $table->char('village_id', 10); // Kode kecamatan
            $table->string('nama'); // Nama gunung
            $table->text('deskripsi'); // Deskripsi gunung
            $table->integer('ketinggian')->default(0); // Ketinggian gunung
            $table->string('gambar'); // Menyimpan path gambar
            $table->timestamps(); // Kolom created_at dan updated_at


            $table->foreign('regency_id')->references('id')->on('reg_regencies')->onDelete('cascade');
            $table->foreign('province_id')->references('id')->on('reg_provinces')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('reg_districts')->onDelete('cascade');
            $table->foreign('village_id')->references('id')->on('reg_villages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gunung');
    }
};
