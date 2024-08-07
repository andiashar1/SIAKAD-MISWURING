<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPelajaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_japel', 'guru_id', 'kelas_id', 'mapel_id', 'jam_awal', 'jam_akhir', 'hari', 'ta_id',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id', 'id');
    }

    // Relasi dengan Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class, 'mapel_id', 'id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'ta_id', 'id');
    }
}
