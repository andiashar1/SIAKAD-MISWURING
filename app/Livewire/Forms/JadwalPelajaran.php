<?php

namespace App\Livewire\Forms;

use App\Models\JadwalPelajaran as ModelsJadwalPelajaran;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;


class JadwalPelajaran extends Form
{
    Public ?ModelsJadwalPelajaran $post;

    public $JadwalPelajaran;

    public $id;
    public $guru_id;
    public $kelas_id;
    public $mapel_id;
    public $hari;
    public $jam_awal;
    public $jam_akhir;
    public $ta_id;


    public function hapus()
    {
        $this->reset();
        $this->resetErrorBag();
        session()->forget('message');
        session()->forget('error');
    }

    public function setPost(ModelsJadwalPelajaran $post){

        $this->post = $post;
        $this->id = $post->id;
        $this->guru_id = $post->guru_id;
        $this->mapel_id = $post->mapel_id;
        $this->hari = $post->hari;
        $this->jam_awal = $post->jam_awal;
        $this->jam_akhir = $post->jam_akhir;
        
        
    }

    public function store()
    {  
        // $this->validate([
        //     'id_wl'     => 'required|unique:wali_kelas,id_wl', 
        //     'guru_id'   => [
        //         'required',
        //         Rule::unique('wali_kelas')->where(function ($query) {
        //             return $query->where('kelas_id', $this->kelas_id)
        //                          ->where('ta_id', $this->ta_id);
        //         }),
        //     ],
        //     'kelas_id'  => [
        //         'required',
        //         Rule::unique('wali_kelas')->where(function ($query) {
        //             return $query->where('guru_id', $this->guru_id)
        //                          ->where('ta_id', $this->ta_id);
        //         }),
        //     ],
        //     'ta_id'     => 'required',
        // ]);

        // $this->validate([
        //    'id_japel'   => 'required',       
        //    'guru_id'    => 'required',
        //    'kelas_id'   => 'required',
        //    'mapel_id'   => 'required',
        //    'hari'       => 'required',
        //    'jam'        => 'required',
        //    'ta_id'      => 'required',
        // ]);

        ModelsJadwalPelajaran::create([     
            'guru_id'    => $this->guru_id,
            'kelas_id'   => $this->kelas_id,
            'mapel_id'   => $this->mapel_id,
            'hari'       => $this->hari,
            'jam_awal'   => $this->jam_awal,
            'jam_akhir'  => $this->jam_akhir,
            'ta_id'      => $this->ta_id,
        ]);
        $this->reset();
    }

    public function update(){
        // // Validasi data yang diperlukan
        // $validatedData = $this->validate([
        //     'guru_id'    => 'required|exists:gurus,id',
        //     'kelas_id'   => 'required|exists:kelas,id',
        //     'mapel_id'   => 'required|exists:mata_pelajarans,id',
        //     'hari'       => 'required|string',
        //     'jam_awal'   => 'required|date_format:H:i',
        //     'jam_akhir'  => 'required|date_format:H:i|after:jam_awal',
        // ], [
        //     'guru_id.required' => 'Guru harus diisi.',
        //     'kelas_id.required' => 'Kelas harus diisi.',
        // ]);

        // Temukan data JadwalPelajaran berdasarkan ID
        $jadwalPelajaran = ModelsJadwalPelajaran::find($this->id);
        
        // Jika data ditemukan, perbarui data tersebut
        if ($jadwalPelajaran) {
            $jadwalPelajaran->update([
                'guru_id'    => $this->guru_id,
                'kelas_id'   => $this->kelas_id,
                'mapel_id'   => $this->mapel_id,
                'hari'       => $this->hari,
                'jam_awal'   => $this->jam_awal,
                'jam_akhir'  => $this->jam_akhir,
            ]);
        }

        // Reset properti
        $this->reset();

        // Flash message untuk memberi tahu pengguna bahwa data berhasil diperbarui
        session()->flash('message', 'Jadwal pelajaran berhasil diperbarui.');
    }
}
