<?php

namespace App\Livewire\Forms;

use App\Models\WaliKelas;
use App\Models\JadwalPelajaran;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use Livewire\Component;
use Livewire\WithPagination;

class DatajadwalPelajaran extends Component
{
    use WithPagination;

    public bool $showFilters = false;
    public $guru_id;
    public $kelas_id;
    public $filtersTa;
    public $guru;
    public $kelas;
    public $tahun_ajaran = [];
    public $firstTahunAjaran;

    public function mount()
    {
        $this->guru = Guru::pluck('nama', 'id')->toArray();
        $this->kelas = Kelas::pluck('nama_kelas', 'id')->toArray();
        $this->tahun_ajaran = TahunAjaran::orderBy('tahun_ajaran', 'DESC')
            ->get()
            ->map(function ($ta) {
                return [
                    'id' => $ta->id,
                    'name' => $ta->tahun_ajaran,
                ];
            })
            ->toArray();
        if (!empty($this->tahun_ajaran)) {
            $this->firstTahunAjaran = $this->tahun_ajaran[0];
        }
    }

    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#', 'class' => 'bg-red-500/20 w-25'],
            ['key' => 'guru_id', 'label' => 'Wali Kelas', 'class' => 'w-72'],
            ['key' => 'kelas_id', 'label' => 'Kelas', 'sortable' => false],
            ['key' => 'ta_id', 'label' => 'Tahun Ajaran', 'sortable' => false],
            ['key' => 'jumlah_siswa', 'label' => 'Jumlah Mapel', 'class' => 'w-25', 'sortable' => false],
        ];

        $query = WaliKelas::query();

        if ($this->filtersTa) {
            $query->whereHas('tahunAjaran', function ($q) {
                $q->where('ta_id', 'like', '%' . $this->filtersTa . '%');
            });
        }

        $dataRombel = $query->select('wali_kelas.id', 'wali_kelas.ta_id', 'wali_kelas.kelas_id', 'wali_kelas.guru_id')
            ->with(['tahunAjaran' => function ($query) {
                $query->orderBy('tahun_ajaran', 'DESC');
            }])
            ->join('tahun_ajarans', 'tahun_ajarans.id', '=', 'wali_kelas.ta_id')
            ->orderBy('tahun_ajarans.tahun_ajaran', 'DESC')
            ->orderBy('wali_kelas.id')
            ->paginate(10);

        foreach ($dataRombel as $rombel) {
            $rombel->jumlah_siswa = JadwalPelajaran::where('kelas_id', $rombel->kelas_id)
                ->where('ta_id', $rombel->ta_id)
                ->count();
        }

        return view('livewire.forms.data-jadwal-pelajaran', [
            'tampil' => $dataRombel,
            'headers' => $headers,
        ]);
    }
}
