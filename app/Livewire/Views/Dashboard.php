<?php

namespace App\Livewire\Views;

use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\WaliKelas;
use App\Models\Rombel;

class Dashboard extends Component
{
    public $jumlah_siswa;
    public $jumlah_guru;
    public $jumlah_kelas;
    public int $jumlahSiswaLakiLaki = 0;
    public int $jumlahSiswaPerempuan = 0;
    public array $siswaChart = [];
    public array $guruChart = [];
    public array $jumlahsiswaChart = [];
    public $loading = false; // Status loading

    public $kelas;
    public $rombel;

    public function mount()
    {
        $this->jumlah_siswa = Siswa::count();
        $this->jumlah_guru = Guru::count();
        $this->jumlah_kelas = Kelas::count();
        $this->kelas = Kelas::All();
        $this->rombel = WaliKelas::All();


        $this->loadSiswaData();
        $this->loadGuruData();
        $this->loadJumlahsiswah();
    }

    public function loadSiswaData()
    {
        $this->jumlahSiswaLakiLaki = Cache::remember('jumlah_siswa_laki', 30, function () {
            return Siswa::where('jenis_kelamin', 'Laki-laki')->count();
        });

        $this->jumlahSiswaPerempuan = Cache::remember('jumlah_siswa_perempuan', 30, function () {
            return Siswa::where('jenis_kelamin', 'Perempuan')->count();
        });

        $this->siswaChart = [
            'type' => 'doughnut',
            'data' => [
                'labels' => ['Laki-Laki', 'Perempuan',],
                'datasets' => [
                    [
                        'label' => 'Jenis Kelamin',
                        'data' => [$this->jumlahSiswaLakiLaki, $this->jumlahSiswaPerempuan,],
                        'backgroundColor' => ['#FF6384', '#36A2EB']
                    ]
                ]
            ]
        ];
    }

    public function loadGuruData()
    {
        $jumlahGuruLakiLaki = Cache::remember('jumlah_guru_laki', 30, function () {
            return Guru::where('jenis_kelamin', 'Laki-laki')->count();
        });

        $jumlahGuruPerempuan = Cache::remember('jumlah_guru_perempuan', 30, function () {
            return Guru::where('jenis_kelamin', 'Perempuan')->count();
        });

        $this->guruChart = [
            'type' => 'doughnut',
            'data' => [
                'labels' => ['Laki-Laki', 'Perempuan'],
                'datasets' => [
                    [
                        'label' => 'Jenis Kelamin',
                        'data' => [$jumlahGuruLakiLaki, $jumlahGuruPerempuan],
                        'backgroundColor' => ['#FF6384', '#36A2EB']
                    ]
                ]
            ]
        ];
    }

    public function loadJumlahsiswah(){
        $this->jumlahsiswaChart = [
            'type' => 'line',
            'data' => [
                'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                'datasets' => [
                    [
                        'label' => 'Jumlah Siswa',
                        'data' => [65, 59, 80, 81, 26, 55, 40],
                        'fill' => false,
                        ' borderColor' => 'rgb(75, 192, 192)',
                    ]
                ]
            ],
            
            'options' => [
                'animations' => [
                    'tension' => [
                        'duration' => 1000,
                        'easing' => 'linear',
                        'from' => 1,
                        'to' => 0,
                        'loop' => true
                    ]
            
                ]
            ],

            'scales' => [
                'y' => [ 
                    'min' => 0,
                    'max' => 50
                ]
            ]

        ];
    }

    public function refreshTab($tab)
    {
        $this->loading = true;

        if ($tab === 'siswa') {
            $this->loadSiswaData();
        } elseif ($tab === 'guru') {
            $this->loadGuruData();
        }

        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.views.dashboard');
    }
}
