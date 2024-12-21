<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaPesanan extends Model
{
    use HasFactory;

    protected $table = 'anggota_pesanan';

    protected $fillable = [
        'id_pesanan',
        'id_users',
    ];

    public function user()
{
    return $this->belongsTo(User::class, 'id_user', 'id'); 
}

    public function pesanan()
    {
        return $this->hasOne(Pesanan::class, 'id_pesanan');
    }
}
