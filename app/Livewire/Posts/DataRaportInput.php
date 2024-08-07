<?php

namespace App\Livewire\Posts;

use App\Models\WaliKelas as ModelsWaliKelas;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Nilai;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Rombel;
use App\Models\JadwalPelajaran as ModelsJadwalPelajaran;
use Livewire\Component;
use App\Livewire\Forms\JadwalPelajaran;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\WithPagination;

class DataRaportInput extends Component
{

    use WithPagination;    
    public bool $showModal = false;
    public bool $editMode = false;
    public bool $headerEdit = false;

    public $rombel;
    public $japel;
    public $id;
    public $nisn;
    public $nama;
    Public $id_wl;
    Public $wl_id;
    public $jumlah_siswa;
    public $naik_kelas;

    Public $id_japel;
    public $guru_id;
    public $kelas_id;
    public $mapel_id;
    public $hari;
    public $jam;
    public $ta_id;
    public $semester;
    public $nilai = [];

    public $guru;
    public $kelas;
    public $tahun_ajaran;
    public $mapel;

    public function mount(siswa $siswa)
    {
        $this->siswa = $siswa;

        // $this->id_japel = $this->japel->id_japel;
        // $this->mapel_id = $this->japel->mapel_id;
        // $this->kelas_id = $this->japel->kelas_id;
        // $this->ta_id = $this->japel->ta_id;
        // $this->hari = $this->japel->hari;
        // $this->jam = $this->japel->jam;

        $wali_kelas = ModelsWaliKelas::where('kelas_id', $this->kelas_id)
                                 ->where('ta_id', $this->ta_id)
                                 ->pluck('id_wl')->toArray();

        $this->nilai = Rombel::whereIn('wl_id', $wali_kelas)->get()->map(function($rombel) {
            $nilai = Nilai::where('japel_id', $this->id_japel)
                          ->where('siswa_id', $rombel->siswa_id)
                          ->first();

            return [
                'siswa_id' => $rombel->siswa_id,
                'nisn' => $rombel->siswa->nisn,
                'nama' => $rombel->siswa->nama,
                'nilai_k3' => $nilai ? $nilai->nilai_k3 : '',
                'nilai_k4' => $nilai ? $nilai->nilai_k4 : ''
            ];
        })->toArray();
    }

    public function simpan()
    {
        $this->validate([
            'nilai.*.nilai_k3' => 'required|integer|min:0|max:100',
            'nilai.*.nilai_k4' => 'required|integer|min:0|max:100',
        ], [
            'nilai.*.nilai_k3.required' => 'Nilai K3 tidak boleh kosong',
            'nilai.*.nilai_k3.integer' => 'Nilai K3 harus berupa angka',
            'nilai.*.nilai_k3.min' => 'Nilai K3 minimal adalah 0',
            'nilai.*.nilai_k3.max' => 'Nilai K3 maksimal adalah 100',
            'nilai.*.nilai_k4.required' => 'Nilai K4 tidak boleh kosong',
            'nilai.*.nilai_k4.integer' => 'Nilai K4 harus berupa angka',
            'nilai.*.nilai_k4.min' => 'Nilai K4 minimal adalah 0',
            'nilai.*.nilai_k4.max' => 'Nilai K4 maksimal adalah 100',
        ]);


        foreach ($this->nilai as $data) {
            $name = Siswa::find($data['siswa_id']);
            if ($name) {
                Nilai::updateOrCreate(
                    ['japel_id' => $this->id_japel, 'siswa_id' => $name->id],
                    [
                        'nilai_k3' => $data['nilai_k3'],
                        'nilai_k4' => $data['nilai_k4'],
                        'deskripsi_k3' => $data['deskripsi_k4'],
                        'deskripsi_k4' => $data['deskripsi_k4']
                    ]
                );
            }
        }
        session()->flash('toastr', [
            'icon' => 'success',
            'message' => 'Data berhasil diperbaharui'
        ]);

    }


    public function render()
    {
        return view('livewire.posts.data-raport-input');
    }

}