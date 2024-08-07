<?php

namespace App\Livewire\Forms;

use App\Models\WaliKelas as ModelsWaliKelas;
use App\Models\Rombel as ModelsRombel;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\siswa;
use App\Models\TahunAjaran;
use App\Models\Province;
use Livewire\Component;
use Illuminate\Support\Collection;
use Livewire\WithPagination;

class DataRombel extends Component
{

    use WithPagination; 
    public bool $showFilters = false;


    Public $id_wl;
    public $guru_id;
    public $kelas_id;
    public $jumlah_siswa;
    public $filtersTa;

    public $guru;
    public $kelas;
    public $tahun_ajaran = [];

    public $lastTahunAjaran;


    public function mount()
    {
        $this->guru = Guru::pluck('nama', 'id')->toArray(); 
        $this->kelas = kelas::pluck('nama_kelas', 'id')->toArray(); 
        $this->tahun_ajaran = TahunAjaran::orderBy('tahun_ajaran', 'DESC')
            ->get()
            ->map(function($ta) {
                // Misalkan tahun ajaran tersimpan dalam format "Tahun/Semester"
                $semester = $ta->semester == 'Ganjil' ? 'Ganjil' : 'Genap';
                return [
                    'id' => $ta->id,
                    'name' => $ta->tahun_ajaran . ' - ' . $semester,
                ];
            })
            ->toArray();

                // Mengambil tahun ajaran terakhir
        $lastTahunAjaran = TahunAjaran::orderBy('tahun_ajaran', 'DESC')->first();
        $this->filtersTa = $lastTahunAjaran ? $lastTahunAjaran->id : null;

    }
    
    
    public function render(){
        $headers = [
            ['key' => 'id', 'label' => '#', 'class' => 'bg-red-500/20 w-1'],
            ['key' => 'id_wl', 'label' => 'ID', 'class' => 'w-72'],
            ['key' => 'guru_id', 'label' => 'Wali Kelas', 'class' => 'w-72'],
            ['key' => 'kelas_id', 'label' => 'Kelas', 'sortable' => false],
            ['key' => 'ta_id', 'label' => 'Tahun Ajaran', 'sortable' => false],
            ['key' => 'jumlah_siswa', 'label' => 'Jumlah Siswa', 'class' => 'w-72', 'sortable' => false],
        ];

        // Inisialisasi query
        $query = ModelsWaliKelas::query();

        // if ($this->filtersTa) {
        //     $query->whereHas('tahunAjaran', function($q) {
        //         $q->where('ta_id', 'like', '%' . $this->filtersTa . '%');
        //     });
        // }

        $dataRombel = $query->with(['tahunAjaran' => function ($query) {
                                    $query->orderBy('tahun_ajaran', 'DESC');
                                }])
                                ->orderBy('kelas_id')
                                ->paginate(10);

                            
        foreach ($dataRombel as $rombel) {
            $rombel->jumlah_siswa = ModelsRombel::where('wl_id', $rombel->id)->count();
        }

        return view('livewire.forms.data-rombel', [
            'tampil' => $dataRombel,
            'headers' => $headers,
        ]);
    }
}