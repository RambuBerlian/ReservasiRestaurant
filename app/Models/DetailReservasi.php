<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailReservasi extends Model
{
    use HasFactory;

    protected $table = 'detailreservasis';

    protected $fillable = [
        'tanggal_waktu',
        'lokasi',
        'jenis_layanan',
    ];
}
