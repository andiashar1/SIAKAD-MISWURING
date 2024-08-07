<?php

namespace App\Livewire\Posts;

use App\Models\WaliKelas as ModelsWaliKelas;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Presensi;
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

class DataPresensiInput extends Component
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
    public $presensi = [];

    public $guru;
    public $kelas;
    public $tahun_ajaran;
    public $mapel;

    public function mount(ModelsJadwalPelajaran $japel)
    {
        $this->japel = $japel;

        $this->id_japel = $this->japel->id_japel;
        $this->mapel_id = $this->japel->mapel_id;
        $this->kelas_id = $this->japel->kelas_id;
        $this->ta_id = $this->japel->ta_id;
        $this->hari = $this->japel->hari;
        $this->jam = $this->japel->jam;

        $wali_kelas = ModelsWaliKelas::where('kelas_id', $this->kelas_id)
                                 ->where('ta_id', $this->ta_id)
                                 ->pluck('id_wl')->toArray();

        $this->presensi = Rombel::whereIn('wl_id', $wali_kelas)->get()->map(function($rombel) {
            $presensi = Presensi::where('japel_id', $this->id_japel)
                          ->where('siswa_id', $rombel->siswa_id)
                          ->first();

            return [
                'siswa_id' => $rombel->siswa_id,
                'nisn' => $rombel->siswa->nisn,
                'nama' => $rombel->siswa->nama,
                'presensi' => $presensi ? $presensi->presensi : ''
            ];
        })->toArray();
    }

    public function simpan(){
        $this->validate([
            'presensi.*.presensi' => 'required|string',
        ], [
            'presensi.*.presensi.required' => 'Presensi tidak boleh kosong',
        ]);

        foreach ($this->presensi as $data) {
            $name = Siswa::find($data['siswa_id']);
            if ($name) {
                Presensi::updateOrCreate(
                    ['japel_id' => $this->id_japel, 'siswa_id' => $name->id],
                    ['presensi' => $data['presensi']]
                );
            }
        }
        return redirect()->route('presensi');
        session()->flash('toastr', [
            'icon' => 'success',
            'message' => 'Data berhasil diperbaharui'
        ]);

    }


    public function render()
    {
        return view('livewire.posts.data-presensi-input');
    }

}