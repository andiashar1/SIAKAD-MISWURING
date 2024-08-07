<?php

namespace App\Livewire\Forms;

use App\Models\MataPelajaran as ModelsMataPelajaran;
use Livewire\Component;
use App\Livewire\Forms\MataPelajaran;
use Livewire\WithPagination;

class DataMataPelajaran extends Component
{

    Public MataPelajaran $form;

    use WithPagination;    
    public bool $showModal = false;
    public bool $editMode = false;
    public bool $headerEdit = false;
    public $kt =[
        ['id' => 'pendidikan agama','name' => 'Pendidikan Agama',],
        ['id' => 'pendidikan umum','name' => 'Pendidikan Umum',],
        ['id' => 'pendidikan kulikuler','name' => 'Pendidikan kulikuler',],
        ['id' => 'muatan lokal','name' => 'Muatan Lokal',]
    ];
        public $kl =[
        ['id' => 'Kelompok A','name' => 'Kelompok A',],
        ['id' => 'Kelompok B','name' => 'Kelompok B',]
    ];

    

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
        
    }

     public function edit($id){

        $post = ModelsMataPelajaran::where('id', $id)->first();
        if ($post) {
            $this->form->setPost($post);
            $this->showModal = true;
            $this->editMode = true;
            $this->headerEdit = true;
        }        
    }

    public function hapus($get_id){
        ModelsMataPelajaran::where('id_mapel', $get_id)->delete();
    }

    public function render()
    {
        $headers = [
        ['key' => 'id', 'label' => '#', 'class' => 'bg-red-500/20 w-1'],
        ['key' => 'kode_mapel', 'label' => 'Kode', 'class' => 'w-30'],
        ['key' => 'nama_mapel', 'label' => 'Mata Pelajaran', 'class' => 'w-30', 'sortable' => false],
        ['key' => 'kategori', 'label' => 'Katagori', 'class' => 'w-30', 'sortable' => false],
        ['key' => 'kelompok', 'label' => 'Kelompok', 'sortable' => false], // <--- Won't be sortable
    ];
       
        return view('livewire.forms.data-mata-pelajaran',[
            'tampil' => ModelsMataPelajaran::paginate(10),
            'headers' => $headers
        ]);
    }
}
