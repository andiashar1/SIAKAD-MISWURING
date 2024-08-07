<?php

namespace App\Livewire\Forms;

use App\Models\WaliKelas as ModelsWaliKelas;
use App\Models\Rombel;
use App\Models\Presensi;
use App\Models\JadwalPelajaran as ModelsJadwalPelajaran;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use App\Models\siswa;
use App\Models\TahunAjaran;
use App\Models\Province;
use Livewire\Component;
use Illuminate\Support\Collection;
use Livewire\WithPagination;

class DataPresensi extends Component
{

    use WithPagination; 
    public bool $showFilters = false;


    Public $id_wl;
    public $ta_id;
    public $kelas_id;
    public $mapel_id;
    public $hari;
    public $jumlah_siswa;
    public $filtersTa;

    public $mapel;
    public $kelas;
    public $tahun_ajaran = [];
    public $presensi = [];


    public function mount(ModelsWaliKelas $WaliKelas)
    {
        $this->kelas = Kelas::pluck('nama_kelas', 'id')->toArray(); 
        $this->tahun_ajaran = TahunAjaran::orderBy('tahun_ajaran', 'DESC')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->id => $item->tahun_ajaran . ' - ' . $item->semester];
            })
            ->toArray();
    }

    public function tampilMapel()
    {
        $this->validate([
            'ta_id' => 'required',
            'kelas_id' => 'required',
            'hari' => 'required',
        ]);

        $wali_kelas = ModelsWaliKelas::where('kelas_id', $this->kelas_id)
                                 ->where('ta_id', $this->ta_id)
                                 ->pluck('id')->toArray();

        $this->presensi = Rombel::whereIn('wl_id', $wali_kelas)->get()->map(function($rombel) {
            $presensi = Presensi::where('hari', $this->hari)
                          ->where('rombel_id', $rombel->id)
                          ->first();

            return [
                'id' => $rombel->id,
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
            $name = Siswa::find($data['id']);
            if ($name) {
                Presensi::updateOrCreate(
                    ['hari' => $this->hari, 'rombel_id' => $name->id],
                    ['presensi' => $data['presensi']]
                );
            }
        }
        session()->flash('toastr', [
            'icon' => 'success',
            'message' => 'Data berhasil diperbaharui'
        ]);

    }

    public function render(){
        return view('livewire.forms.data-presensi');
    }
}