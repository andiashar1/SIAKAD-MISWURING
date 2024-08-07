<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;

    protected $fillable = [ 'kode_mapel', 'nama_mapel', 'kategori', 'kelompok' ];

    public function waliKelas()
    {
        return $this->hasOne(waliKelas::class, 'Kelas_id', 'id');
    }

    public function japel()
    {
        return $this->hasMany(JadwalPelajaran::class, 'mapel_id', 'id');
    }

}
