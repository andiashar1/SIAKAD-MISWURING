<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;
    protected $fillable = ['kode_ta', 'tahun_ajaran', 'semester' ];

    protected $casts = ['aktif' => 'boolean',];

    public function waliKelas()
    {
        return $this->hasOne(waliKelas::class, 'Kelas_id', 'id');
    }
}
