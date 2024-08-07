<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswas';

    protected $fillable = ['nisn', 'nik', 'nama', 'tempat_lahir', 'tanggal_lahir', 
                           'jenis_kelamin', 'agama', 'foto', 'rt_rw', 'kelurahan', 'kode_pos', 'alamat' ];

    public function waliSiswa()
    {
        return $this->hasOne(waliSiswa::class, 'siswa_id', 'id');
    }

        public function rombel()
    {
        return $this->hasOne(Rombel::class, 'siswa_id', 'id');
    }
}
