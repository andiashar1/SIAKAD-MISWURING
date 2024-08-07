<?php

namespace App\Livewire\Forms;

use App\Models\Kelas as ModelsKelas;
use Livewire\Component;
use App\Livewire\Forms\Kelas;
use Livewire\WithPagination;

class DataKelas extends Component
{

    Public Kelas $form;

    use WithPagination;    
    public bool $showModal = false;
    public bool $editMode = false;
    public bool $headerEdit = false;

    

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

        $post = ModelsKelas::find($id);
        if ($post) {
            $this->form->setPost($post);
            $this->showModal = true;
            $this->editMode = true;
            $this->headerEdit = true;
        }        
    }

    public function hapus($get_id){
        ModelsKelas::where('id', $get_id)->delete();
    }

    public function render()
    {
        $headers = [
        ['key' => 'id', 'label' => '#', 'class' => 'bg-red-500/20 w-1'],
        ['key' => 'kode_kelas', 'label' => 'Kode'],
        ['key' => 'nama_kelas', 'label' => 'Kelas'],
        ['key' => 'kapasitas', 'label' => 'Kapasitas'],
    ];
       
        return view('livewire.forms.data-kelas',[
            'tampil' => ModelsKelas::paginate(10),
            'headers' => $headers
        ]);
    }
}
