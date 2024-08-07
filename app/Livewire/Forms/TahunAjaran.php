<?php

namespace App\Livewire\Forms;

use App\Models\TahunAjaran as ModelsTahunAjaran;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Str;

class TahunAjaran extends Form
{
    Public ?ModelsTahunAjaran $post;

    public $kode_ta;
    public $id;
    public $tahun_ajaran1;
    public $tahun_ajaran2;
    public $tahun_ajaran;
    public $semester;

    public function hapus()
    {
        $this->reset();
    }

    public function setPost(ModelsTahunAjaran $post){

        $this->post = $post;
        $this->id        =  $post->id; 
        $this->kode_ta        =  $post->kode_ta;       
        $this->tahun_ajaran1 = Str::substr($post->tahun_ajaran, 0, 4);
        $this->tahun_ajaran2 = Str::substr($post->tahun_ajaran, 5, 9);
        $this->semester        =  $post->semester; 
    }

    public function store()
    {
            // Mengubah semester menjadi angka
        if ($this->semester === 'Genap') {
            $this->semester_num = 2;
        } elseif ($this->semester === 'Ganjil') {
            $this->semester_num = 1;
        } else {
            $this->semester_num = null; // Penanganan jika semester tidak valid
        }

        $this->kode_ta =  "TA" .$this->tahun_ajaran1 .$this->tahun_ajaran2 . $this->semester_num; 
        $this->tahun_ajaran = $this->tahun_ajaran1 . "/" .$this->tahun_ajaran2;    

        $this->validate([
            'kode_ta'          => 'required|unique:tahun_ajarans', 
            'tahun_ajaran1'   => 'required',
            'tahun_ajaran2'   => 'required',
            'semester'   => 'required',
            ]);
        
        ModelsTahunAjaran::create([
            'kode_ta'           => $this->kode_ta,       
            'tahun_ajaran'    => $this->tahun_ajaran,
            'semester'   => $this->semester,
            ]);
        $this->reset();
    }

    public function update()
    {

        // Mengubah semester menjadi angka
        if ($this->semester === 'Genap') {
            $this->semester_num = 2;
        } elseif ($this->semester === 'Ganjil') {
            $this->semester_num = 1;
        } else {
            $this->semester_num = null; // Penanganan jika semester tidak valid
        }

        $this->kode_ta =  "TA" .$this->tahun_ajaran1 .$this->tahun_ajaran2 . $this->semester_num; 
        $this->tahun_ajaran = $this->tahun_ajaran1 . "/" .$this->tahun_ajaran2;     

        $this->validate([
            'kode_ta'          => 'required|unique:tahun_ajarans',
            'tahun_ajaran1'   => 'required',
            'tahun_ajaran2'   => 'required',
            'semester'   => 'required',
            ]);
        
        $this->post->update([
            'kode_ta'           => $this->kode_ta,       
            'tahun_ajaran'    => $this->tahun_ajaran,
            'semester'   => $this->semester,
            ]);
        $this->reset();
    }
}
