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
use PDF;

class DataRaport extends Component
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
    public $raport= [];


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

    public function tampilMapel(){
        $this->validate([
            'ta_id' => 'required',
            'kelas_id' => 'required',
        ]);

        $wali_kelas = ModelsWaliKelas::where('kelas_id', $this->kelas_id)
                                    ->where('ta_id', $this->ta_id)
                                    ->pluck('id');

        $this->raport = Rombel::whereIn('wl_id', $wali_kelas)->get();
    }


    public function downloadRaport()
    {
        $raport = Rombel::with('waliKelas', 'rombels')->get(); // Sesuaikan dengan relasi yang ada
        foreach ($raport as $r) {
            $r->nama = utf8_decode($r->nama);
        }
        $pdf = PDF::loadView('raport.pdf', compact('raport'));
        return response()->streamDownload(
            fn() => print($pdf->output()),
            'raport.pdf'
        );
    }

    public function printRaport()
    {
        $this->dispatch('printPdf');
    }


    public function render(){
        return view('livewire.forms.data-raport');
    }
}