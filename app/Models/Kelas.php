<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = ['kode_kelas', 'nama_kelas', 'kapasitas' ];

    public function waliKelas()
    {
        return $this->hasOne(waliKelas::class, 'Kelas_id', 'id');
    }
}
