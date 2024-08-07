<?php

namespace App\Livewire\Posts;

use App\Models\Siswa;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class DataSiswa extends Component
{
    use WithFileUploads;

    public $nisn;
    public $nik;
    public $nama;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $jenis_kelamin;
    public $agama;
    public $alamat;
    public $tinggal_bersama;
    public $foto;
    public $JK =[
                ['id' => 'laki-laki','name' => 'Laki-Laki',],
                ['id' => 'perempuan','name' => 'Perempuan',]];
    public $agm =[
                ['id' => 'islam','name' => 'Islam',],
                ['id' => 'katolik','name' => 'Katolik',],
                ['id' => 'kristen','name' => 'Kristen',],
                ['id' => 'budha','name' => 'Budha',],
                ['id' => 'hindu','name' => 'Hindu',],
                ['id' => 'konghucu','name' => 'Konghucu',],];
    public $tb =[
                ['id' => 'orang_tua','name' => 'Orang Tua',],
                ['id' => 'wali_siswa','name' => 'Wali Siswa',],
                ['id' => 'orang_lain','name' => 'Orang Lain',]];

    public function simpan(){
       $this->validate([
            'nisn'           => 'required',
            'nik'            => 'required',
            'nama'           => 'required',
            'tempat_lahir'   => 'required',
            'tanggal_lahir'  => 'required',
            'jenis_kelamin'  => 'required',
            'agama'          => 'required',
            
        ]);

        $file_upload = null;
        if ($this->foto) {
        $file_upload = $this->foto->store('images/siswa', 'public');
        }

        Siswa::create([
            'nisn'           => $this->nisn,
            'nik'            => $this->nik,
            'nama'           => $this->nama,
            'tempat_lahir'   => $this->tempat_lahir,
            'tanggal_lahir'  => $this->tanggal_lahir,
            'jenis_kelamin'  => $this->jenis_kelamin,
            'agama'          => $this->agama,
            'foto'           => $file_upload
            ]

        );

        session()->flash('success','data siswa berhasil ditambah');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.posts.data-siswa');
    }
}
