<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class PostDataSiswa extends Form
{
    public $nama_ayah, $nik_ayah, $tempat_lahir_ayah, $tanggal_lahir_ayah, $jenis_kelamin_ayah, $agama_ayah, $alamat_ayah, $hanphone_ayah;

    public function store()
    {   
        $this->validate([
            'nik_ayah'            => 'required',
            'nama_ayah'           => 'required',
            'tempat_lahir_ayah'   => 'required',
            'tanggal_lahir_ayah'  => 'required',
            'jenis_kelamin_ayah'  => 'required',
            'agama_ayah'          => 'required',
            'alamat_ayah'         => 'required',
            'hanphone_ayah'       => 'required',
            ]);
        $this->reset();
    }
}
