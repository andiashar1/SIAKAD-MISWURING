<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai2 extends Model
{
    use HasFactory;

    protected $fillable = [
        'rombel_id',
        'nilai_ki1',
        'nilai_ki2',
        'deskripsi_ki1',
        'deskripsi_ki2',
        'ekstrakulikuler',
        'predikat_ekstrakulikuler',
        'deskripsi_ekstrakulikuler',
        'prestasi',
        'catatan',
        'keterangan'
    ];
}
