<?php

namespace App\Livewire\Forms;

use App\Models\Guru;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class DataGuru extends Component
{
    use WithPagination;
    public bool $showFilters = false;
    public $agm =[
                ['id' => 'islam','name' => 'Islam',],
                ['id' => 'katolik','name' => 'Katolik',],
                ['id' => 'kristen','name' => 'Kristen',],
                ['id' => 'budha','name' => 'Budha',],
                ['id' => 'hindu','name' => 'Hindu',],
                ['id' => 'konghucu','name' => 'Konghucu',],];
    
    public function hapus($get_id){
    // Retrieve the Siswa record by id
    $guru = Guru::find($get_id);

    if ($guru) {
        // Construct the path to the photo
        $path = 'public/' . $guru->foto;

        // Check if the photo exists and delete it if it does
        if ($guru->foto && Storage::exists($path)) {
            Storage::delete($path);
        }

        // Always delete the guru record
        $guru->delete();
    }
}
    public function render()
    {
        $headers = [
        ['key' => 'id', 'label' => '#', 'class' => 'bg-red-500/20 w-1'],
        ['key' => 'id_guru', 'label' => 'ID Guru', 'class' => 'w-72'],
        ['key' => 'nama', 'label' => 'Nama', 'sortable' => false, ], // <--- Won't be sortable
        ['key' => 'nip', 'label' => 'NIP', 'class' => 'w-72'],
        ['key' => 'nuptk', 'label' => 'NUPTK', 'class' => 'w-72'],
    ];
        
        return view('livewire.forms.data-guru',[
            'tampil' => Guru::paginate(10),
            'headers' => $headers
        ]);
    }
}
