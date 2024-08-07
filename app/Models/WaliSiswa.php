<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaliSiswa extends Model
{
    use HasFactory;
    protected $table = 'wali_siswas';
    protected $fillable = [
    'wali',
    'nik_ayah', 'nama_ayah', 'status_ayah','tempat_lahir_ayah','tanggal_lahir_ayah','agama_ayah','pekerjaan_ayah','penghasilan_ayah','handphone_ayah',
    'nik_ibu', 'nama_ibu', 'status_ibu', 'tempat_lahir_ibu' ,'tanggal_lahir_ibu','agama_ibu','pekerjaan_ibu','penghasilan_ibu','handphone_ibu',
    'nik_wali','nama_wali','tempat_lahir_wali','tanggal_lahir_wali','agama_wali','pekerjaan_wali','penghasilan_wali','handphone_wali'     ];
    
}
