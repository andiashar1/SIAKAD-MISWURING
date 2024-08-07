<?php

namespace App\Livewire\Posts;

use App\Models\WaliKelas as q;
use App\Models\Guru;
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

class DatajadwalPelajaranTambah extends Component
{
    Public JadwalPelajaran $form;

    use WithPagination;    
    public bool $showModal = false;
    public bool $editMode = false;
    public bool $headerEdit = false;

    public $wali_kelas;
    public $id;
    Public $wl_id;

    Public $id_japel;
    public $guru_id;
    public $kelas_id;
    public $mapel_id;
    public $hari;
    public $jam;
    public $ta_id;

    public $hr =[
            ['id' => 'Senin','name' => 'Senin',],
            ['id' => 'Selasa','name' => 'Selasa',],
            ['id' => 'Rabu','name' => 'Rabu',],
            ['id' => 'Kamis','name' => 'Kamis',],
            ['id' => 'Jum\'at','name' => 'Jum\'at',],
            ['id' => 'Sabtu','name' => 'Sabtu',],
            ['id' => 'Minggu','name' => 'Minggu',],
        ];

    public $guru;
    public $mapel;

    public function mount(q $wali_kelas)
    {
        $this->wali_kelas = $wali_kelas;
        $this->id = $this->wali_kelas->id;
        $this->guru_id = $this->wali_kelas->guru_id;
        $this->kelas_id = $this->wali_kelas->kelas_id;
        $this->ta_id = $this->wali_kelas->ta_id;


        $this->guru = Guru::all()->map(function($ta) {
                return [
                    'id' => $ta->id,
                    'name' => $ta->nama,
                ];
            });
        $this->mapel = MataPelajaran::all()->map(function($ta) {
                return [
                    'id' => $ta->id,
                    'name' => $ta->nama_mapel,
                ];
            });
    }

    public function munculModal() {
        $this->form->hapus();
        $this->showModal = true;
    }

    public function tutupModal() {
        $this->form->hapus();
        $this->showModal = false;
        $this->editMode = false;
        $this->headerEdit = false;
    }

        public function simpan()
    {
        $this->form->kelas_id = $this->kelas_id;
        $this->form->ta_id = $this->ta_id;
        if ($this->editMode) {
            $this->form->update();
            $this->dispatch('toastr', icon: 'success', message: 'data berhasil diperbaharui');
        } else {
            $this->form->store();
            $this->dispatch('toastr', icon: 'success', message: 'data berhasil disimpan');
        }
        $this->showModal = false;
        $this->editMode = false;
        $this->headerEdit = false;
    }

     public function edit($id){

        $post = ModelsJadwalPelajaran::where('id', $id)->first();
        if ($post) {
            $this->form->setPost($post);
            $this->showModal = true;
            $this->editMode = true;
            $this->headerEdit = true;
            $this->resetErrorBag();
            session()->forget('message');
            session()->forget('error');
        }
    
    }

    public function hapus($get_id){
        ModelsJadwalPelajaran::where('id', $get_id)->delete();
    }

    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#', 'class' => 'bg-red-500/20 w-1'],
            ['key' => 'mapel_id', 'label' => 'Mata Pelajaran', 'class' => 'w-72'],
            ['key' => 'guru_id', 'label' => 'Guru', 'class' => 'w-72'],
            ['key' => 'hari', 'label' => 'Hari', 'sortable' => false],
            ['key' => 'jam', 'label' => 'Jam', 'sortable' => false],
        ];

        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        $tampil = ModelsJadwalPelajaran::where('kelas_id', $this->kelas_id)
                                        ->where('ta_id', $this->ta_id)
                                        ->orderByRaw("FIELD(hari, '" . implode("','", $days) . "')")
                                        ->paginate(10);

        $this->jumlah_siswa = Rombel::where('wl_id', $this->id)->count();

        return view('livewire.posts.data-jadwal-pelajaran-tambah', [
            'tampil' => $tampil,
            'headers' => $headers,
            'jumlah_siswa' => $this->jumlah_siswa,
        ]);
    }

}