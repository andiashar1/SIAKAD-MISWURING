<?php

namespace App\Livewire\Forms;

use App\Models\Kelas as ModelsKelas;
use Livewire\Form;
use Illuminate\Database\QueryException;

class Kelas extends Form
{
    public ?ModelsKelas $post = null;

    public $id;
    public $kode_kelas;
    public $nama_kelas;
    public $kapasitas;

    public function hapus()
    {
        $this->reset();
        $this->resetErrorBag();
        session()->forget('message');
        session()->forget('error');
    }

    public function setPost(ModelsKelas $post)
    {
        $this->post = $post;
        $this->id = $post->id; 
        $this->kode_kelas = $post->kode_kelas; 
        $this->nama_kelas = $post->nama_kelas; 
        $this->kapasitas = $post->kapasitas; 
    }

    public function store(){

        // Validasi nama_kelas dan kapasitas
        $this->validate([
            'nama_kelas' => 'required|unique:kelas',
            'kapasitas' => 'required',
        ],[
            'nama_kelas.required' => 'kelas tidak boleh kosong',
            'nama_kelas.unique' => 'Kelas Sudah Ada',
            'kapasitas.required' => 'Kapasitas tidak boleh kosong',
        ]);

        // Buat kode_kelas berdasarkan nama_kelas
        $kode_kelas = "KLS0" . $this->nama_kelas;

        // Simpan data kelas ke database
        ModelsKelas::create([
            'kode_kelas' => $kode_kelas,
            'nama_kelas' => $this->nama_kelas,
            'kapasitas' => $this->kapasitas,
        ]);
        // Reset input form
        $this->reset();
    }

    public function update()
    {

        $this->validate([
            'nama_kelas' => 'required|unique:kelas',
            'kapasitas' => 'required',
        ],[
            'nama_kelas.required' => 'kelas tidak boleh kosong',
            'nama_kelas.unique' => 'Kelas Sudah Ada',
            'kapasitas.required' => 'Kapasitas tidak boleh kosong',
        ]);

        // Buat kode_kelas berdasarkan nama_kelas
        $kode_kelas = "KLS0" . $this->nama_kelas;

        $kelas = ModelsKelas::find($this->id);
        if ($kelas) {
            // Cek apakah kode_kelas sudah ada selain di kelas ini
            $existingKelas = ModelsKelas::where('kode_kelas', $kode_kelas)->where('id', '!=', $this->id)->first();
            if ($existingKelas) {
                session()->flash('error', 'Kelas dengan kode tersebut sudah ada.');
                return;
            }

            $kelas->update([
                'kode_kelas' => $kode_kelas,
                'nama_kelas' => $this->nama_kelas,
                'kapasitas' => $this->kapasitas,
            ]);

            // Tampilkan pesan sukses
            session()->flash('message', 'Kelas berhasil diperbarui.');
        }
        // Reset input form
        $this->reset();
    }
}
