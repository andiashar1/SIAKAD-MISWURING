<?php

namespace App\Livewire\Forms;

use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Models\JadwalPelajaran;
use App\Models\WaliKelas as ModelsWaliKelas;
use App\Models\Rombel;
use Livewire\Component;
use Livewire\WithPagination;

class DataNilai extends Component
{
    use WithPagination;

    public bool $showFilters = false;
    public $ta_id;
    public $kelas_id;
    public $jadwal = [];
    public $kelas = [];
    public $tahun_ajaran = [];
    public $japel = [];


    public function mount()
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
        ]);

        $wali_kelas = ModelsWaliKelas::where('kelas_id', $this->kelas_id)
                                 ->where('ta_id', $this->ta_id)
                                 ->pluck('id')->toArray();

        $this->japel = Rombel::whereIn('wl_id', $wali_kelas)->get()->map(function($rombel) {
            return [
                'id' => $rombel->id,
                'siswa_id' => $rombel->siswa_id,
                'nisn' => $rombel->siswa->nisn,
                'nama' => $rombel->siswa->nama,
            ];
        })->toArray();
    }

    // public function tampilMapel()
    // {
    //     $this->validate([
    //         'ta_id' => 'required',
    //         'kelas_id' => 'required',
    //     ]);

    //     // Mendapatkan semua data jadwal berdasarkan ta_id dan kelas_id dengan mapel_id unik
    //     $this->jadwal = JadwalPelajaran::where('ta_id', $this->ta_id)
    //         ->where('kelas_id', $this->kelas_id)
    //         ->whereIn('id', function($query) {
    //             $query->selectRaw('MIN(id)')
    //                 ->from('jadwal_pelajarans')
    //                 ->where('ta_id', $this->ta_id)
    //                 ->where('kelas_id', $this->kelas_id)
    //                 ->groupBy('mapel_id');
    //         })
    //         ->get();
    // }

    public function render()
    {
        return view('livewire.forms.data-nilai');
    }
}
