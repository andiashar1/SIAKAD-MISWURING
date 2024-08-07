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

class EditDataGuru extends Component
{
    use WithFileUploads;

    public $guru;
    public $nip, $nuptk, $nama, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $agama, $alamat, $rt_rw, $kode_pos, $kelurahan, $foto;

    public $id;
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

    public function mount(guru $guru)
    {
        $this->guru = $guru;

        $this->id = $this->guru->id;
        $this->nip = $this->guru->nip;
        $this->nuptk = $this->guru->nuptk;
        $this->nama = $this->guru->nama;
        $this->tempat_lahir = $this->guru->tempat_lahir;
        $this->tanggal_lahir = $this->guru->tanggal_lahir;
        $this->jenis_kelamin = $this->guru->jenis_kelamin;
        $this->agama = $this->guru->agama;
        $this->kelurahan = (int) $this->guru->kelurahan;
        $this->rt_rw = $this->guru->rt_rw;
        $this->alamat = $this->guru->alamat;
        $this->kode_pos = $this->guru->kode_pos;

        $data = Village::find($this->kelurahan);

        if ($data && $data->district && $data->district->regency && $data->district->regency->province) {
            $this->selectedProvince = $data->district->regency->province->id;
            $this->selectedRegency = $data->district->regency->id;
            $this->selectedDistrict = $data->district->id;
            $this->selectedVillage = $data->id;

            // Mengambil semua provinces
            $this->provinces = Province::all()->map(function($province) {
                return [
                    'id' => $province->id,
                    'name' => $province->name,
                ];
            })->toArray();

            // Mengambil regencies berdasarkan selectedProvince
            $this->regencies = Regency::where('province_id', $this->selectedProvince)->get()->map(function($regency) {
                return [
                    'id' => $regency->id,
                    'province_id' => $regency->province_id,
                    'name' => $regency->name,
                ];
            })->toArray();

            // Mengambil districts berdasarkan selectedRegency
            $this->districts = District::where('regency_id', $this->selectedRegency)->get()->map(function($district) {
                return [
                    'id' => $district->id,
                    'regency_id' => $district->regency_id,  // Fixed key to 'regency_id'
                    'name' => $district->name,
                ];
            })->toArray();

            // Mengambil villages berdasarkan selectedDistrict
            $this->villages = Village::where('district_id', $this->selectedDistrict)->get()->map(function($village) {
                return [
                    'id' => $village->id,
                    'district_id' => $village->district_id,  // Fixed key to 'district_id'
                    'name' => $village->name,
                ];
            })->toArray();
        }
        
        
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
                    ['required', 'numeric', Rule::unique('gurus')->ignore($this->id)],
                    []
                ),
            ],
            'nuptk' => [
                'nullable',
                Rule::when(
                    !$this->isDisabledNUPTK,
                    ['required', 'numeric', Rule::unique('gurus')->ignore($this->id)],
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

    public function update(){

        // $this->validated();

        $file_upload = null;
        if ($this->foto) {
        $file_upload = $this->foto->store('images/siswa', 'public');
        }

       $guru = Guru::find($this->id);

        if ($guru) {
            $guru->update([
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
                'foto'           => $file_upload,
            ]);
        } else {
            // Handle the case where the Guru is not found, if necessary
            // Example: throw new \Exception('Guru not found');
        }
        session()->flash('toastr', [
            'icon' => 'success',
            'message' => 'Data berhasil diperbaharui'
        ]);
        return redirect()->route('guru');

    }

    public function render()
    {
        return view('livewire.posts.edit-data-guru');
    }
}
