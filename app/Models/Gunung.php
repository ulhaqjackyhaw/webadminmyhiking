<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gunung extends Model
{
    use HasFactory;

    protected $table = 'gunung';

    protected $fillable = [
        'province_id',
        'regency_id',
        'district_id',
        'village_id',
        'nama',
        'deskripsi',
        'ketinggian',
        'gambar',
    ];
}
