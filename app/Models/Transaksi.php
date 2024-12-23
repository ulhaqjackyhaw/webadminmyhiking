<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'transaksi';

    // Kolom yang dapat diisi secara mass assignment
    protected $fillable = [
        'id_pesanan',
        'metode_pembayaran',
        'total_bayar',
        'waktu_pembayaran',
        'bukti',
    ];
        protected $attributes = [
            'status_pesanan' => 'Unverified',  // Pastikan ini ada
        ];

    /**
     * Relasi ke model Pesanan
     * Misalnya: Transaksi terkait dengan Pesanan melalui kolom `id_pesanan`
     */
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }

    /**
     * Scope untuk transaksi dengan metode pembayaran tertentu
     */
    public function scopeMetodePembayaran($query, $metode)
    {
        return $query->where('metode_pembayaran', $metode);
    }

    /**
     * Contoh accessor untuk format waktu pembayaran
     */
    public function getFormattedWaktuPembayaranAttribute()
    {
        return date('d-m-Y H:i:s', strtotime($this->waktu_pembayaran));
    }

    // Menampilkan bukti pembayaran sebagai gambar
public function getBuktiUrlAttribute()
{
    // Mengecek apakah bukti ada, jika ada kembalikan URL file bukti
    if ($this->bukti) {
        return asset('storage/bukti/' . $this->bukti);
    }
    
    // Jika tidak ada bukti, kembalikan URL gambar default atau null
    return asset('images/no-image.png'); // Gambar default jika bukti tidak ditemukan
}

}
