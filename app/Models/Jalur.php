<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jalur extends Model
{
    use HasFactory;

    protected $table = 'jalur';

    protected $fillable = [
        'id_gunung',
        'province_id',
        'regency_id',
        'district_id',
        'village_id',
        'deskripsi',
        'map_basecamp',
        'biaya',
    ];
}
