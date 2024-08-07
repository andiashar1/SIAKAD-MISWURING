<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    
    protected $table = 'gurus';

    // Jika primary key bukan tipe auto-incrementing integer, Anda bisa menambahkan properti berikut:
    public $incrementing = false;

    protected $fillable = [ 'nip', 'nuptk', 'nama', 'tempat_lahir', 'tanggal_lahir', 
                           'jenis_kelamin', 'agama', 'alamat', 'rt_rw', 'kelurahan', 'kode_pos','foto' ];

    public function Guru()
    {
        return $this->hasOne(Guru::class, 'guru_id', 'id');
    }
}