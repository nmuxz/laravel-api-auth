<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = [
    'mata_kuliah',
    'waktu_mulai',
    'waktu_selesai',
    'ruang',
    'tanggal',
];
}
