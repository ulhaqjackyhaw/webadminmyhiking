<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    // Nama tabel yang terkait
    protected $table = 'pesanan';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'id_gunung',
        'id_jalur',
        'id_anggota_pesanan',
        'tanggal_naik',
        'tanggal_turun',
        'total_harga_tiket',
        'status',
    ];

    // Jika tabel menggunakan auto increment untuk primary key
    protected $primaryKey = 'id';

    // Jika tabel tidak menggunakan timestamps, nonaktifkan
    public $timestamps = true;

    // Tipe data kolom tanggal
    protected $casts = [
        'tanggal_naik' => 'datetime',
        'tanggal_turun' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi ke model lain
     */

    // Relasi ke model Gunung (Contoh jika ada)
    public function gunung()
    {
        return $this->belongsTo(Gunung::class, 'id_gunung', 'id');
    }

    // Relasi ke model Jalur (Contoh jika ada)
    public function jalur()
    {
        return $this->belongsTo(Jalur::class, 'id_jalur', 'id');
    }

    // Relasi ke model AnggotaPesanan (Contoh jika ada)
    public function anggotaPesanan()
    {
        return $this->belongsTo(AnggotaPesanan::class, 'id_anggota_pesanan', 'id');
    }
}
