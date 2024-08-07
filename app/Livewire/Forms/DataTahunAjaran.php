<?php

namespace App\Livewire\Forms;

use App\Models\TahunAjaran as ModelsTahunAjaran;
use Livewire\Component;
use App\Livewire\Forms\TahunAjaran;
use Livewire\WithPagination;

class DataTahunAjaran extends Component
{
    Public TahunAjaran $form;
    public bool $aktif = false;

    use WithPagination;    
    public bool $showModal = false;
    public bool $editMode = false;
    public bool $headerEdit = false;
    
    public $perPage = 10;
    public $perPageOptions = [5, 10, 20, 50];

    public function mount(){
        $ta = ModelsTahunAjaran::all();
        
        $ta->aktif = $this->aktif;
    }

    public $sm =[
            ['id' => 'Ganjil','name' => 'Ganjil',],
            ['id' => 'Genap','name' => 'Genap',],];

    public function munculModal() {
        $this->form->hapus();
        $this->showModal = true;
    }

    public function toggleActive($get_id)
    {
        $tahunAjaran = ModelsTahunAjaran::find($get_id);

        if ($tahunAjaran) {
            $tahunAjaran->aktif = !$tahunAjaran->aktif;
            $tahunAjaran->save();
            $this->tampil = ModelsTahunAjaran::all(); // Refresh data
        }
    }

    public function simpan()
    {
        if ($this->editMode) {
             $this->form->update();
             $this->editMode = false;
             $this->dispatch('toastr', icon: 'success', message: 'data berhasil diperbaharui');
        } else {
             $this->form->store();
             $this->dispatch('toastr', icon: 'success', message: 'data berhasil disimpan');
        }
        $this->showModal = false;
        // Toast
        
    }

     public function edit($id){

        $post = ModelsTahunAjaran::find($id);
            $this->form->setPost($post);
            $this->showModal = true;
            $this->editMode = true;
            $this->headerEdit = true;

    }


    public function hapus($get_id){
        ModelsTahunAjaran::where('id', $get_id)->delete();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }


    public function render()
    {
        $headers = [
        ['key' => 'id', 'label' => '#', 'class' => 'bg-red-500/20 w-1'],
        ['key' => 'kode_ta', 'label' => 'Kode', 'class' => 'w-72'],
        ['key' => 'tahun_ajaran', 'label' => 'Tahun Ajaran', 'sortable' => false], // <--- Won't be sortable\
        ['key' => 'semester', 'label' => 'Semester', 'sortable' => false], // <--- Won't be sortable
        ['key' => 'aktif', 'label' => 'Status', 'sortable' => false], // <--- Won't be sortable

    ];
       
        return view('livewire.forms.data-tahun-ajaran',[
            'tampil' => ModelsTahunAjaran::orderBy('kode_ta', 'DESC')->paginate($this->perPage),
            'headers' => $headers
        ]);
    }
}
