<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    // Nama tabel yang terkait
    protected $table = 'pesanan';

    // Primary key dari tabel
    protected $primaryKey = 'id';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'id_gunung',
        'id_jalur',
        'id_anggota_pesanan',
        'tanggal_naik',
        'tanggal_turun',
        'total_harga_tiket',
        'status', // Pastikan kolom ini sudah ada di database dan isinya benar
    ];

    // Nonaktifkan timestamps jika tidak digunakan
    public $timestamps = true; // Jika tabel menggunakan created_at dan updated_at

    // Casting tipe data untuk kolom tertentu
    protected $casts = [
        'tanggal_naik' => 'datetime',
        'tanggal_turun' => 'datetime',
    ];

    /**
     * Relasi ke model Gunung
     */
    public function gunung()
    {
        return $this->belongsTo(Gunung::class, 'id_gunung', 'id');
    }

    /**
     * Relasi ke model Jalur
     */
    public function jalur()
    {
        return $this->belongsTo(Jalur::class, 'id_jalur', 'id');
    }

    /**
     * Relasi ke model AnggotaPesanan
     */
    public function anggotaPesanan()
    {
        return $this->belongsTo(AnggotaPesanan::class, 'id_anggota_pesanan', 'id');
    }

    /**
     * Mendapatkan status pesanan dengan label yang lebih mudah dimengerti
     */
    public function getStatusLabelAttribute()
    {
        switch ($this->status) {
            case 'booking':
                return 'Booking';
            case 'mendaki':
                return 'Mendaki';
            case 'selesai':
                return 'Selesai';
        }
    }
}
