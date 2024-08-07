<?php

namespace App\Livewire\Posts;

use App\Models\WaliKelas;
use App\Models\Nilai;
use App\Models\Nilai2;
use App\Models\Rombel;
use App\Models\JadwalPelajaran;
use Livewire\Component;
use Livewire\WithPagination;

class DataNilaiInput extends Component
{
    use WithPagination;

    public $id;
    public $nilai = [];
    public $nilai2 = [];
    public $rombel;
    public $currentStep = 1;
    public $steps = [
        1 => ['title' => 'Nilai', 'details' => 'KI 1 & KI 2'],
        2 => ['title' => 'Nilai', 'details' => 'KI 3 & KI 4'],
        3 => ['title' => 'Deskripsi', 'details' => 'KI 3 & KI 4'],
        4 => ['title' => 'Predikat', 'details' => 'Ektrakulikuler'],
        5 => ['title' => 'Predikat', 'details' => 'Prestasi'],
        6 => ['title' => 'Catatan & Keterangan', 'details' => 'Wali Kelas'],
    ];

    public $mapel;
    public $nilai_ki1;
    public $nilai_ki2;
    public $deskripsi_ki1;
    public $deskripsi_ki2;
    public $catatan;
    public $keterangan;
    public $ekstrakulikuler = [];
    public $predikat_ekstrakulikuler = [];
    public $deskripsi_ekstrakulikuler = [];
    public $prestasi = [];
    public $deskripsi_prestasi = [];

    public function mount(Rombel $rombel)
    {
        $this->rombel = $rombel;
        $this->id = $rombel->id;
        $this->loadNilai();
        $this->loadNilai2();
    }

    public function loadNilai(){
        $waliKelas = WaliKelas::find($this->rombel->wl_id);

        $jadwalPelajaran = JadwalPelajaran::where('ta_id', $waliKelas->ta_id)
            ->where('kelas_id', $waliKelas->kelas_id)
            ->whereIn('id', function($query) use($waliKelas) {
                $query->selectRaw('MIN(id)')
                    ->from('jadwal_pelajarans')
                    ->where('ta_id', $waliKelas->ta_id)
                    ->where('kelas_id', $waliKelas->kelas_id)
                    ->groupBy('mapel_id');
            })
            ->get();

        $this->nilai = $jadwalPelajaran->map(function ($jadwalPelajaran) {
            $nilai = Nilai::where('rombel_id', $this->id)
                ->where('japel_id', $jadwalPelajaran->id)
                ->first();

            return [
                'id' => $jadwalPelajaran->id,
                'mapel' => $jadwalPelajaran->mapel->nama_mapel,
                'nilai_ki3' => $nilai->nilai_ki3 ?? '',
                'nilai_ki4' => $nilai->nilai_ki4 ?? '',
                'deskripsi_ki3' => $nilai->deskripsi_ki3 ?? '',
                'deskripsi_ki4' => $nilai->deskripsi_ki4 ?? '',
            ];
        })
        ->unique('mapel')
        ->values()
        ->toArray();
    }

    public function loadNilai2(){
        // Ambil data nilai dari model Nilai berdasarkan rombel_id
        $nilai2 = Nilai2::where('rombel_id', $this->id)->first();

        // Periksa jika data ditemukan
        if ($nilai2) {
            $this->mapel = "Sikap Spritualis & Sosial";
            $this->nilai_ki1 = $nilai2->nilai_ki1 ?? '';
            $this->nilai_ki2 = $nilai2->nilai_ki2 ?? '';
            $this->deskripsi_ki1 = $nilai2->deskripsi_ki1 ?? '';
            $this->deskripsi_ki2 = $nilai2->deskripsi_ki2 ?? '';
            $this->catatan = $nilai2->catatan ?? '';

            // Decode JSON jika data ada
            $this->ekstrakulikuler = json_decode($nilai2->ekstrakulikuler, true) ?? [''];
            $this->predikat_ekstrakulikuler = json_decode($nilai2->predikat_ekstrakulikuler, true) ?? [''];
            $this->deskripsi_ekstrakulikuler = json_decode($nilai2->deskripsi_ekstrakulikuler, true) ?? [''];

            $this->prestasi = json_decode($nilai2->prestasi, true) ?? [''];
            $this->deskripsi_prestasi = json_decode($nilai2->deskripsi_prestasi, true) ?? [''];


        } else {
            // Handle kasus ketika data tidak ditemukan
            $this->mapel = "Sikap Spritualis & Sosial";
            $this->nilai_ki1 = '';
            $this->nilai_ki2 = '';
            $this->deskripsi_ki1 = '';
            $this->deskripsi_ki2 = '';
            $this->ekstrakulikuler = [''];
            $this->predikat_ekstrakulikuler = [''];
            $this->deskripsi_ekstrakulikuler = [''];
            $this->prestasi = [''];
            $this->deskripsi_prestasi = [''];
            $this->catatan = '';
        }

        // Simpan data untuk keperluan lain jika perlu
        $this->nilai2 = $nilai2;
    }



    public function setStep($step)
    {
        if ($step > 0 && $step <= count($this->steps)) {
            $this->currentStep = $step;
        }
    }

    public function nextStep()
    {
        // $this->validateCurrentStep();
        $this->currentStep++;
    }

    public function prevStep()
    {
        // $this->validateCurrentStep();
        $this->currentStep--;
    }

    public function validateCurrentStep()
    {
        $rules = [];
        $messages = [];

        switch ($this->currentStep) {
            case 1:
                $rules = [
                    'nilai.*.nilai_ki3' => 'required|integer|min:0|max:100',
                    'nilai.*.nilai_ki4' => 'required|integer|min:0|max:100',
                ];
                $messages = [
                    'nilai.*.nilai_ki3.required' => 'Nilai KI 3 tidak boleh kosong',
                    'nilai.*.nilai_ki3.integer' => 'Nilai KI 3 harus berupa angka',
                    'nilai.*.nilai_ki3.min' => 'Nilai KI 3 minimal adalah 0',
                    'nilai.*.nilai_ki3.max' => 'Nilai KI 3 maksimal adalah 100',
                    'nilai.*.nilai_ki4.required' => 'Nilai KI 4 tidak boleh kosong',
                    'nilai.*.nilai_ki4.integer' => 'Nilai KI 4 harus berupa angka',
                    'nilai.*.nilai_ki4.min' => 'Nilai KI 4 minimal adalah 0',
                    'nilai.*.nilai_ki4.max' => 'Nilai KI 4 maksimal adalah 100',
                ];
                break;
            case 2:
                $rules = [
                    'nilai.*.deskripsi_ki3' => 'required',
                    'nilai.*.deskripsi_ki4' => 'required',
                ];
                $messages = [
                    'nilai.*.deskripsi_ki3.required' => 'Nilai KI 3 tidak boleh kosong',
                    'nilai.*.deskripsi_ki4.required' => 'Nilai KI 4 tidak boleh kosong',
                ];
                break;

            default:
                // Tidak ada validasi untuk langkah ini
                break;
        }

        $this->validate($rules, $messages);
    }

    public function addItemEkskul()
    {
        $this->ekstrakulikuler[] = '';
        $this->predikat_ekstrakulikuler[] = '';
        $this->deskripsi_ekstrakulikuler[] = '';
    }

    public function addItemPrestasi()
    {
        $this->prestasi[] = '';
        $this->deskripsi_prestasi[] = '';
    }

    public function removeItemPrestasi($index)
    {
        unset($this->prestasi[$index]);
        unset($this->deskripsi_prestasi[$index]);

        $this->prestasi = array_values($this->prestasi);
        $this->deskripsi_prestasi = array_values($this->deskripsi_prestasi);
    }

    public function removeItemEkskul($index)
    {
        unset($this->ekstrakulikuler[$index]);
        unset($this->predikat_ekstrakulikuler[$index]);
        unset($this->deskripsi_ekstrakulikuler[$index]);

        $this->ekstrakulikuler = array_values($this->ekstrakulikuler);
        $this->predikat_ekstrakulikuler = array_values($this->predikat_ekstrakulikuler);
        $this->deskripsi_ekstrakulikuler = array_values($this->deskripsi_ekstrakulikuler);
    }


    public function simpan(){
        foreach ($this->nilai as $data) {
            $japel = JadwalPelajaran::find($data['id']);
            
            $nilai = Nilai::updateOrCreate(
                [
                    'japel_id' => $japel->id, 
                    'rombel_id' => $this->id
                ],
                [
                    'nilai_ki3' => $data['nilai_ki3'],
                    'nilai_ki4' => $data['nilai_ki4'],
                    'deskripsi_ki3' => $data['deskripsi_ki3'],
                    'deskripsi_ki4' => $data['deskripsi_ki4'],
                ]
            );

            $nilai = Nilai2::updateOrCreate(
                [
                    'rombel_id' => $this->id
                ],
                [
                    'nilai_ki1' => $this->nilai_ki1,
                    'nilai_ki2' => $this->nilai_ki2,
                    'deskripsi_ki1' => $this->deskripsi_ki1,
                    'deskripsi_ki2' => $this->deskripsi_ki2,
                    'ekstrakulikuler' => json_encode($this->ekstrakulikuler),
                    'predikat_ekstrakulikuler' => json_encode($this->predikat_ekstrakulikuler),
                    'deskripsi_ekstrakulikuler' => json_encode($this->deskripsi_ekstrakulikuler),
                    'prestasi' => json_encode($this->prestasi),
                    'deskripsi_prestasi' => json_encode($this->deskripsi_prestasi),
                    'catatan' => $this->catatan,
                    'keterangan' => $this->keterangan,
            
                ]
            );

        }

        session()->flash('toastr', [
            'icon' => 'success',
            'message' => 'Data berhasil diperbaharui'
        ]);

        return redirect()->route('nilai');
    }
    


    public function render()
    {
        return view('livewire.posts.data-nilai-input');
    }
}
