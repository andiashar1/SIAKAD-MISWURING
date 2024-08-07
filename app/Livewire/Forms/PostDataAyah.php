<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class PostDataAyah extends Form
{
    public $nama;
    public $nik;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $jenis_kelamin;
    public $agama;
    public $alamat;
    public $hanphone;

    public function store()
    {   
        $this->validate([
            'nik'            => 'required',
            'nama'           => 'required',
            'tempat_lahir'   => 'required',
            'tanggal_lahir'  => 'required',
            'jenis_kelamin'  => 'required',
            'agama'          => 'required',
            'alamat'         => 'required',
            'hanphone'       => 'required',
            ]);
        $this->reset();
    }
}
