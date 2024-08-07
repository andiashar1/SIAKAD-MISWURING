<?php

namespace App\Livewire\Forms;

use App\Models\WaliKelas as ModelsWaliKelas;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Models\Province;
use Livewire\Component;
use App\Livewire\Forms\WaliKelas;
use Illuminate\Support\Collection;
use Livewire\WithPagination;

class DataWaliKelas extends Component
{


    Public WaliKelas $form;

    use WithPagination;    
    public bool $showModal = false;
    public bool $editMode = false;
    public bool $headerEdit = false;

    public $guru_id;
    public $kelas_id;
    public $ta_id;

    public $guru;
    public $kelas;
    public $tahun_ajaran;


    public function mount(ModelsWaliKelas $WaliKelas)
    {
        $this->guru = guru::all()->map(function($guru) {
            return [
                'id' => $guru->id,
                'name' => $guru->nama,
                'avatar' => asset('storage/' . $guru->foto),
            ];
        })->toArray();
        $this->kelas = kelas::all()->map(function($kelas) {
            return [
                'id' => $kelas->id,
                'name' => $kelas->nama_kelas,
            ];
        })->toArray();
        $this->tahun_ajaran = TahunAjaran::all()->map(function($ta) {
            return [
                'id' => $ta->id,
                'name' => $ta->tahun_ajaran. ' - ' .$ta->semester
            ];
        })->toArray();
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
        $this->resetErrorBag();
        session()->forget('message');
        session()->forget('error'); 
        // $this->dispatch('resetwaliKelas');   
    }

     public function edit($id){
        
        

        $post = ModelsWaliKelas::where('id', $id)->first();
        if ($post) {
            $this->form->setPost($post);
            $this->showModal = true;
            $this->editMode = true;
            $this->headerEdit = true;
        }
        // $this->guru_id = $post->guru_id;
    }

    public function hapus($get_id){
        ModelsWaliKelas::where('id', $get_id)->delete();
    }

    public function render()
    {
        $headers = [
        ['key' => 'id', 'label' => '#', 'class' => 'bg-red-500/20 w-72'],
        ['key' => 'guru_id', 'label' => 'Wali Kelas', 'class' => 'w-72'],
        ['key' => 'kelas_id', 'label' => 'Kelas', 'sortable' => false],
        ['key' => 'ta_id', 'label' => 'Tahun Ajaran', 'sortable' => false], // <--- Won't be sortable
    ];
       
        $tampil = ModelsWaliKelas::orderBy('ta_id', 'ASC')
                                 ->orderBy('kelas_id')
                                 ->paginate(10);

        return view('livewire.forms.data-wali-kelas', [
            'tampil' => $tampil,
            'headers' => $headers
        ]);
    }
}