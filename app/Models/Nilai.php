<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $fillable = ['japel_id', 'rombel_id', 'nilai_ki3', 'nilai_ki4', 'deskripsi_ki3', 'deskripsi_ki4', ];

    public function japel()
    {
        return $this->belongsTo(JadwalPelajaran::class, 'japel_id', 'id_japel');
    }

    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class, 'mapel_id', 'id_mapel');
    }

    public function rombel()
    {
        return $this->belongsTo(MataPelajaran::class, 'rombel_id', 'id');
    }
}
