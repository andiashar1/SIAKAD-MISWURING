<?php

namespace App\Livewire\Forms;

use App\Models\MataPelajaran as ModelsMataPelajaran;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Str;

class MataPelajaran extends Form
{
    Public ?ModelsMataPelajaran $post;

    public $mata_pelajaran;
    public $id;
    public $kode_mapel;
    public $kode_mapel_angka;
    public $nama_mapel;
    public $kategori;
    public $kelompok;

    public function hapus()
    {
        $this->reset();
    }

    public function setPost(ModelsMataPelajaran $post){

        $this->post = $post;
        $this->id = $post->id;
        $this->kode_mapel = $post->kode_mapel;
        $this->nama_mapel = $post->nama_mapel;
        $this->kategori = $post->kategori; 
        $this->kelompok = $post->kelompok;  

        // Menggunakan preg_match untuk menangkap angka dengan nol di depannya
        preg_match('/\d+/', $post->kode_mapel, $matches);
        // Menyimpan angka yang ditemukan ke dalam variabel $number
        $number = $matches[0]; // Masih dalam bentuk string  
        $this->kode_mapel_angka = $number;   
    }

    private function getCategoryPrefix($category)
    {
        $words = explode(' ', $category);
        $prefix = '';

        foreach ($words as $word) {
            $prefix .= strtoupper($word[0]);
        }

        return $prefix;
    }
    public function store()
    {
        $this->validate([
            'kode_mapel_angka'   => 'required|integer',
            'nama_mapel'   => 'required',
            'kategori'   => 'required',
            'kelompok'   => 'required',
            ]);

        // Ekstrak huruf depan dari kategori
        $kategoriPrefix = $this->getCategoryPrefix($this->kategori);

        // Format kode_mapel
        $this->kode_mapel = $kategoriPrefix .$this->kode_mapel_angka ; 
        ModelsMataPelajaran::create([   
            'kode_mapel'    => $this->kode_mapel,    
            'nama_mapel'    => $this->nama_mapel,
            'kategori'    => $this->kategori,
            'kelompok'    => $this->kelompok,
            ]);
        $this->reset();
    }

    public function update()
    {

        $this->validate([
            'kode_mapel_angka'   => 'required|integer',
            'nama_mapel'   => 'required',
            'kategori'   => 'required',
            'kelompok'   => 'required',
            ]);

        $kategoriPrefix = $this->getCategoryPrefix($this->kategori);

        // Format kode_mapel
        $this->kode_mapel = $kategoriPrefix .$this->kode_mapel_angka ; 
        
        $mapel = ModelsMataPelajaran::find($this->id);
        if ($mapel) {
        $mapel->update([
            'kode_mapel'    => $this->kode_mapel,    
            'nama_mapel'    => $this->nama_mapel,
            'kategori'    => $this->kategori,
            'kelompok'    => $this->kelompok,
            ]);
        }
        $this->reset();
    }
}
