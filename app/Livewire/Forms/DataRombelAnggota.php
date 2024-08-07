<?php

namespace App\Livewire\Forms;

use App\Models\WaliKelas as ModelsWaliKelas;
use App\Models\Guru;
use App\Models\tahunAjaran;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Rombel;
use App\Models\Province;
use Livewire\Component;
use App\Livewire\Forms\AnggotaRombel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\WithPagination;

class DataRombelAnggota extends Component
{
    Public AnggotaRombel $form;

    use WithPagination;    
    public bool $editMode = false;
    public bool $headerEdit = false;

    public $wali_kelas;
    public $newWali_kelas;
    public $upWali_kelas;
    public $newTa;
    public $id;
    Public $id_wl;
    Public $wl_id;
    public $guru_id;
    public $kelas_id;
    public $ta_id;
    public $jumlah_siswa;
    public $naik_kelas;

    public $guru;
    public $kelas;
    public $kelasSemester;

    public $table1 = [];
    public $table2 = [];
    public $selectedRows = [];
    public $movedRows = [];
    public $selected = [];
    public $selectAll = false;

    public $showModal = false;

    public function mount(ModelsWaliKelas $wali_kelas)
    {
        $this->wali_kelas = $wali_kelas;
        $this->id = $this->wali_kelas->id;
        $this->guru_id = $this->wali_kelas->guru_id;
        $this->kelas_id = $this->wali_kelas->kelas_id;
        $this->ta_id = $this->wali_kelas->ta_id;

        $this->naikSemester();
        $this->naikKelas();

        // Mengambil semua data dari table2 dan menyimpannya dalam array untuk pengecekan
        $table2Ids = Rombel::pluck('siswa_id')->toArray();

        // Mengambil semua siswa yang tidak ada di table2
        $this->table1 = Siswa::whereNotIn('id', $table2Ids)->get()->map(function ($siswa) {
            return [
                'id' => $siswa->id,
                'nis' => $siswa->nisn,
                'data' => $siswa->nama,
            ];
        })->toArray();

        // Mengambil semua siswa di table2 untuk kelas tertentu
        $this->table2 = Rombel::with('siswa')->where('wl_id', $this->id_wl)->get()->map(function ($rombel) {
            return [
                'id' => $rombel->id,
                'nis' => $rombel->siswa->nisn,
                'data' => $rombel->siswa->nama,
            ];
        })->toArray();
    }


    public function deleteRow($table, $index)
    {
        if ($table == 'table1') {
            unset($this->table1[$index]);
        } else {
            unset($this->table2[$index]);
        }
    }

    public function moveSelectedRows()
    {
        foreach ($this->selectedRows as $index) {
            $this->movedRows[] = Siswa::find($this->table1[$index]['id']); // Pastikan bahwa $this->table1[$index]['id'] merujuk ke ID Siswa
            $this->table2[] = $this->table1[$index];
            unset($this->table1[$index]);
        }
        $this->selectedRows = [];
    }

    public function saveMovedRows()
    {
        foreach ($this->movedRows as $row) {
            $rombel = rombel::find($this->id);
            Rombel::create([
                'siswa_id' => $row->id,
                'wl_id' => $this->id,
            ]);
            // Siswa::find($row->id)->delete();
        }
        $this->movedRows = [];
        $this->showModal = false;
    }

    public function naikkelas(){
        // Ambil TahunAjaran berdasarkan ID
        $tahun_ajaran = TahunAjaran::find($this->ta_id);

        if ($tahun_ajaran) {
            // Tentukan semester baru berdasarkan semester saat ini
            $newSemester = $tahun_ajaran->semester === 'Ganjil' ? 'Genap' : 'Ganjil';

            // Ubah tahun ajaran secara dinamis
            $tahunAjaranParts = explode('/', $tahun_ajaran->tahun_ajaran);
            if (count($tahunAjaranParts) === 2) {
                $tahunAwal = (int) $tahunAjaranParts[0];
                $tahunAkhir = (int) $tahunAjaranParts[1];
                $tahun_ajaran->tahun_ajaran = ($tahunAwal + 1) . '/' . ($tahunAkhir + 1);
            }

            // Ambil TahunAjaran yang sesuai dengan tahun ajaran yang sama dan semester baru
            $upTa = TahunAjaran::where('tahun_ajaran', $tahun_ajaran->tahun_ajaran)
                                ->where('semester', $newSemester)
                                ->first();
        } else {
            $upTa = null;
        }
        
        // Ambil kelas baru berdasarkan kelas_id
        $kelas = Kelas::find($this->kelas_id);

        if ($kelas) {
            // Dapatkan angka berikutnya dari nama kelas
            $nextKelasNumber = (int) filter_var($kelas->nama_kelas, FILTER_SANITIZE_NUMBER_INT) + 1;

            // Ambil kelas dengan angka berikutnya
            $newKelas = Kelas::where('nama_kelas', 'like', "%$nextKelasNumber%")->get();
        } else {
            // Kembalikan koleksi kosong jika kelas tidak ditemukan
            $newKelas = collect();
        }

        // Cari ModelsWaliKelas jika $upTa dan $newKelas tidak null
        $this->upWali_kelas = $upTa && $newKelas->isNotEmpty() ? ModelsWaliKelas::whereIn('kelas_id', $newKelas->pluck('id'))
                                                                ->where('ta_id', $upTa->id)
                                                                ->get() : collect();

    }

    public function upClass($kelasId) {
        // Dapatkan semua rombels yang dipilih
        $rombels = Rombel::whereIn('id', $this->selected)->get();

        // Dapatkan kelas berdasarkan ID
        $wali_kelas = ModelsWaliKelas::find($kelasId);

        if ($wali_kelas) {
            foreach ($rombels as $rombel) {
                $data = [
                    'siswa_id' => $rombel->siswa_id,
                    'wl_id' => $wali_kelas->id,
                ];

                $rules = [
                    'siswa_id' => [
                        'required',
                        Rule::unique('rombels')->where(function ($query) use ($wali_kelas) {
                            return $query->where('wl_id', $wali_kelas->id);
                        }),
                    ],
                    'wl_id' => [
                        'required',
                        Rule::unique('rombels')->where(function ($query) use ($rombel) {
                            return $query->where('siswa_id', $rombel->siswa_id);
                        }),
                    ],
                ];

                $validator = Validator::make($data, $rules);

                if ($validator->fails()) {
                    throw new ValidationException($validator);
                }

                // Jika validasi lolos, buat record baru
                Rombel::create($data);
            }
        } else {
            throw new \Exception("Kelas dengan ID $kelasId tidak ditemukan.");
        }
    }

    public function naikSemester(){
        // Ambil TahunAjaran berdasarkan ID
        $tahun_ajaran = TahunAjaran::find($this->ta_id);

        // Tentukan semester baru berdasarkan semester saat ini
        $newSemester = $tahun_ajaran ? ($tahun_ajaran->semester === 'Ganjil' ? 'Genap' : 'Ganjil') : null;

        // Ambil TahunAjaran yang sesuai dengan tahun ajaran yang sama dan semester baru
        $newTa = $tahun_ajaran ? TahunAjaran::where('tahun_ajaran', $tahun_ajaran->tahun_ajaran)
                                            ->where('semester', $newSemester)
                                            ->first() : null;
        $this->newTa = $newTa;

        // Ambil kelas baru berdasarkan kelas_id
        $kelas = Kelas::find($this->kelas_id);
        $newKelas = $kelas ? Kelas::where('nama_kelas', 'like', preg_replace('/\D/', '', $kelas->nama_kelas) . '-%')->get() : collect();

        // Cari ModelsWaliKelas jika $newTa dan $newKelas tidak null
        $this->newWali_kelas = $newTa && $newKelas->isNotEmpty() ? ModelsWaliKelas::whereIn('kelas_id', $newKelas->pluck('id'))
                                                            ->where('ta_id', $newTa->id)
                                                            ->get() : collect();
    }

    public function upSemester($kelasId) {
        // Dapatkan semua rombels yang dipilih
        $rombels = Rombel::whereIn('id', $this->selected)->get();

        foreach ($rombels as $rombel) {
            $data = [
                'siswa_id' => $rombel->siswa_id,
                'wl_id' => $kelasId,
            ];

            $rules = [
                'siswa_id' => [
                    'required',
                    Rule::unique('rombels')->where(function ($query) use ($kelasId) {
                        return $query->where('wl_id', $kelasId);
                    }),
                ],
                'wl_id' => [
                    'required',
                    Rule::unique('rombels')->where(function ($query) use ($rombel) {
                        return $query->where('siswa_id', $rombel->siswa_id);
                    }),
                ],
            ];

            $validator = Validator::make($data, $rules);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            // Jika validasi lolos, buat record baru
            Rombel::create($data);
        }
    }




    public function munculModal()
    {
        $this->form->hapus();
        $this->showModal = true;
    }

    public function tutupModal()
    {
        $this->form->hapus();
        $this->showModal = false;
        $this->editMode = false;
        $this->headerEdit = false;
    }

        public function hapus($get_id){
        Rombel::where('id', $get_id)->delete();
    }


    public function render()
    {
        $tampil_siswa = [
            ['key' => 'id', 'label' => '#', 'class' => 'bg-red-500/20 w-1'],
            ['key' => 'nis', 'label' => 'NIS', 'class' => 'w-72'],
            ['key' => 'data', 'label' => 'NAMA', 'sortable' => false],
        ];
        $headers = [
            ['key' => 'id', 'label' => '#', 'class' => 'bg-red-500/20 w-1'],
            ['key' => 'nis', 'label' => 'NIS', 'class' => 'w-72'],
            ['key' => 'nama_siswa', 'label' => 'Nama', 'class' => 'w-72'],
            ['key' => 'kelas_siswa', 'label' => 'Kelas', 'class' => 'w-72'],
        ];

        $datasiswa = Siswa::all();
        $tampil = Rombel::where('wl_id', $this->id)->paginate(10);
        $this->jumlah_siswa = Rombel::where('wl_id', $this->id)->count();

        return view('livewire.forms.data-rombel-anggota', [
            'tampil' => $tampil,
            'headers' => $headers,
            'jumlah_siswa' => $this->jumlah_siswa,
            'datasiswa' => $datasiswa,
            'tampil_siswa' => $tampil_siswa,
        ]);
    }
}