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
        Schema::create('jalur', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 60);
            $table->foreignId('id_gunung')->nullable()->constrained('gunung'); // Relasi ke tabel 'gunung'
            $table->char('province_id', 10);
            $table->char('regency_id', 4); // Kode kabupaten/kota
            $table->char('district_id', 7); // Kode kecamatan
            $table->char('village_id', 10); // Kode desa
            $table->integer('jarak');
            $table->text('deskripsi');
            $table->string('map_basecamp', 60);
            $table->string('gambar_jalur')->nullable()->after('biaya');
            $table->integer('biaya');
            $table->timestamps();   

            $table->foreign('province_id')->references('id')->on('reg_provinces')->onDelete('cascade');
            $table->foreign('regency_id')->references('id')->on('reg_regencies')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('reg_districts')->onDelete('cascade');
            $table->foreign('village_id')->references('id')->on('reg_villages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jalur');
    }
};
