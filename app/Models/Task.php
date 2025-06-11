<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
     protected $fillable = [
        'nama_tugas',
        'deskripsi',
        'deadline',
        'ingatkan',
        'jenis_notifikasi',
        'is_done',
    ];

    protected $casts = [
        'ingatkan' => 'boolean',
        'deadline' => 'datetime',
        'is_done' => 'boolean',
    ];
}
