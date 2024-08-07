<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use App\Models\Guru;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class TambahDataGuru extends Component
{
    use WithFileUploads;

    public $nip, $nuptk, $nama, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $agama, $alamat, $rt_rw, $kode_pos, $kelurahan, $foto;

    public $isDisabledNIP = false;
    public $isDisabledNUPTK = false;
    public $isCheckedNIP = false;
    public $isCheckedNUPTK = false;

    public $JK =[
        ['id' => '0', 'name' => 'Pilih Jenis Kelamin', 'disabled' => true],
        ['id' => 'laki-laki','name' => 'Laki-Laki',],
        ['id' => 'perempuan','name' => 'Perempuan',]
    ];

    public $agm =[
        ['id' => '0', 'name' => 'Pilih Agama', 'disabled' => true],
        ['id' => 'islam', 'name' => 'Islam',],
        ['id' => 'katolik', 'name' => 'Katolik',],
        ['id' => 'kristen', 'name' => 'Kristen',],
        ['id' => 'budha', 'name' => 'Budha',],
        ['id' => 'hindu', 'name' => 'Hindu',],
        ['id' => 'konghucu', 'name' => 'Konghucu',],
    ];

    public $provinces = [];
    public $regencies = [];
    public $districts = [];
    public $villages = [];

    public $selectedProvince = null;
    public $selectedRegency = null;
    public $selectedDistrict = null;
    public $selectedVillage = null;

    public function mount()
    {
        $this->provinces = Province::all()->map(function($province) {
            return [
                'id' => $province->id,
                'name' => $province->name,
            ];
        })->toArray();
    }
    
    public function updatedSelectedProvince($provinceId)
    {
        $this->regencies = Regency::where('province_id', $provinceId)->get()->toArray();
        $this->selectedRegency = null;
        $this->districts = [];
        $this->villages = [];
    }

    public function updatedSelectedRegency($regencyId)
    {
        $this->districts = District::where('regency_id', $regencyId)->get()->toArray();
        $this->selectedDistrict = null;
        $this->villages = [];
    }

    public function updatedSelectedDistrict($districtId)
    {
        $this->villages = Village::where('district_id', $districtId)->get()->toArray();
    }
    
    public function toggleDisabledNIP()
    {
        $this->isDisabledNIP = !$this->isDisabledNIP;
        $this->isCheckedNIP = $this->isDisabledNIP;
        $this->nip = $this->isDisabledNIP ? null : $this->nip;
    }

    public function toggleDisabledNUPTK()
    {
        $this->isDisabledNUPTK = !$this->isDisabledNUPTK;
        $this->isCheckedNUPTK = $this->isDisabledNUPTK;
        $this->nuptk = $this->isDisabledNUPTK ? null : $this->nuptk;
    }

    public function validated(){
    $this->validate([
        'nip' => [
            'nullable',
            Rule::when(
                !$this->isDisabledNIP,
                ['required', 'numeric', Rule::unique('gurus')],
                []
            ),
        ],
        'nuptk' => [
            'nullable',
            Rule::when(
                !$this->isDisabledNUPTK,
                ['required', 'numeric', Rule::unique('gurus')],
                []
            ),
        ],
        'nama'           => 'required|string',
        'tempat_lahir'   => 'required|string',
        'tanggal_lahir'  => 'required|date',
        'jenis_kelamin'  => 'required|string',
        'agama'          => 'required|string',
        'selectedProvince' => 'required|string',
        'selectedRegency' => 'required|string',
        'selectedDistrict' => 'required|string',
        'selectedVillage' => 'required|string',
        'rt_rw'          => 'required|string',
        'alamat'         => 'required|string',
        'kode_pos'       => 'required|numeric',
    ]);

    }

    public function save(){

        $this->validated();

        $file_upload = null;
        if ($this->foto) {
        $file_upload = $this->foto->store('images/siswa', 'public');
        }

        Guru::create([
            'nip'            => $this->nip,
            'nuptk'          => $this->nuptk,
            'nama'           => $this->nama,
            'tempat_lahir'   => $this->tempat_lahir,
            'tanggal_lahir'  => $this->tanggal_lahir,
            'jenis_kelamin'  => $this->jenis_kelamin,
            'agama'          => $this->agama,
            'kelurahan'      => $this->selectedVillage,
            'rt_rw'          => $this->rt_rw,
            'alamat'         => $this->alamat,
            'kode_pos'       => $this->kode_pos,
            'foto'           => $file_upload
        ]);
        return redirect()->route('guru');
        session()->flash('toastr', [
            'icon' => 'success',
            'message' => 'Data berhasil diperbaharui'
        ]);

    }

    public function render()
    {
        return view('livewire.posts.tambah-data-guru');
    }
}
