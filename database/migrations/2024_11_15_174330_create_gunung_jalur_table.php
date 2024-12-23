<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gunung_jalur', function (Blueprint $table) {
            $table->id(); // Primary key untuk tabel pivot
            $table->unsignedBigInteger('id_gunung'); // Foreign key untuk gunung
            $table->unsignedBigInteger('jalur_id'); // Foreign key untuk jalur
            $table->timestamps(); // Kolom created_at dan updated_at

            // Menambahkan foreign key ke tabel gunung
            $table->foreign('id_gunung')->references('id')->on('gunung')->onDelete('cascade');

            // Menambahkan foreign key ke tabel jalur
            $table->foreign('jalur_id')->references('id')->on('jalur')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gunung_jalur'); // Menghapus tabel pivot
    }
};
