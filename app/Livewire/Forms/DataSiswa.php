<?php

namespace App\Livewire\Forms;

use App\Models\Siswa;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;


class DataSiswa extends Component
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
    $siswa = Siswa::find($get_id);

    if ($siswa) {
        // Construct the path to the photo
        $path = 'public/' . $siswa->foto;

        // Check if the photo exists and delete it if it does
        if ($siswa->foto && Storage::exists($path)) {
            Storage::delete($path);
        }

        // Always delete the Siswa record
        $siswa->delete();
    }
}
    public function render()
    {
        $headers = [
        ['key' => 'id', 'label' => '#', 'class' => 'bg-red-500/20 w-1'],
        ['key' => 'nama', 'label' => 'Nama', 'class' => 'w-72'],
        ['key' => 'nisn', 'label' => 'NISN', 'sortable' => false], // <--- Won't be sortable
    ];
        
        return view('livewire.forms.data-siswa',[
            'tampil' => Siswa::paginate(10),
            'headers' => $headers
        ]);
    }
}
