<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use App\Models\Siswa;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;


class EditDataSiswa extends Component
{
    use WithFileUploads;

    public $currentStep = 1;
    public $steps = [
        1 => ['title' => 'Biodata', 'details' => 'Siswa'],
        2 => ['title' => 'Biodata', 'details' => 'Wali Siswa'],
        3 => ['title' => 'Alamat', 'details' => 'Siswa'],
    ];

    public $siswa;
    public bool $isCheckedAyah = false;
    public bool $isCheckedIbu = false;
    public bool $isCheckedWali = false;
    public bool $isDisabledAyah = false;
    public bool $isDisabledIbu = false;
    public bool $isDisabledAyahHP = false;
    public bool $isDisabledIbuHP = false;
    public bool $isDisabledWaliHP = false;
    public $wali; 
    public $nisn, $nik, $nama, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $agama, $alamat, $tinggal_bersama, $foto, $rt_rw, $kode_pos, $kelurahan;
    public $nama_ayah, $nik_ayah, $status_ayah, $tempat_lahir_ayah, $tanggal_lahir_ayah, $jenis_kelamin_ayah, $agama_ayah, $alamat_ayah, $pekerjaan_ayah, $penghasilan_ayah, $handphone_ayah;
    public $nama_ibu, $nik_ibu, $status_ibu, $tempat_lahir_ibu, $tanggal_lahir_ibu, $jenis_kelamin_ibu, $agama_ibu, $alamat_ibu, $pekerjaan_ibu, $penghasilan_ibu, $handphone_ibu;
    public $nama_wali, $nik_wali, $tempat_lahir_wali, $tanggal_lahir_wali, $jenis_kelamin_wali, $agama_wali, $alamat_wali, $pekerjaan_wali, $penghasilan_wali, $handphone_wali;

    public $JK =[
                ['id' => '0', 'name' => 'Pilih Jenis Kelamin', 'disabled' => true],
                ['id' => 'laki-laki','name' => 'Laki-Laki',],
                ['id' => 'perempuan','name' => 'Perempuan',]];
    public $pkj =[
                ['id' => '0',                               'name' => 'Pilih Pekerjaan', 'disabled' => true ],
                ['id' => 'tidak berkerja',                  'name' =>'Tidak Berkerja',],
                ['id' => 'Pensiunan',                       'name' => 'Pensiunan',],
                ['id' => 'PNS',                             'name' => 'PNS',],
                ['id' => 'Guru/Dosen',                      'name' => 'Guru/Dosen',],
                ['id' => 'TNI/Polisi',                      'name' => 'TNI/Polisi',],
                ['id' => 'Pegawai Swasta',                  'name' => 'Pegawai Swasta',],
                ['id' => 'Wiraswasta',                      'name' => 'Wiraswasta',],
                ['id' => 'Pengacara/Jaksa/Hakim/Notaris',   'name' => 'Pengacara/Jaksa/Hakim/Notaris',],
                ['id' => 'Seniman/Pelukis/Artis/Sejenis',   'name' => 'Seniman/Pelukis/Artis/Sejenis',],
                ['id' => 'Dokter/Bidan/Perawat',            'name' => 'Dokter/Bidan/Perawat',],
                ['id' => 'Pilot/Pramugari',                 'name' => 'Pilot/Pramugari',],
                ['id' => 'Pedagang',                        'name' => 'Pedagang',],
                ['id' => 'Nelayan',                         'name' => 'Nelayan',],
                ['id' => 'Buruh(Tani/Pabrik/Bangunan)',     'name' => 'Buruh(Tani/Pabrik/Bangunan)',],
                ['id' => 'Sopir/Masinis/Kondektur',         'name' => 'Sopir/Masinis/Kondektur',],
                ['id' => 'Politikus',                       'name' => 'Politikus',],
                ['id' => 'Lainnya',                         'name' => 'Lainnya',], ];
    public $phl =[
                ['id' => '0',                               'name' => 'Pilih Penghasilan', 'disabled' => true ],
                ['id' => 'Kurang dari 500.000',             'name' => 'Kurang dari 500.000',],
                ['id' => '500.000-1.000.000',               'name' => '500.000-1.000.000',],
                ['id' => '1.000.000-2.000.000',             'name' => '1.000.000-2.000.000',],
                ['id' => '2.000.000-3.000.000',             'name' => '2.000.000-3.000.000',],
                ['id' => '3.000.000-5.000.000',             'name' => '3.000.000-5.000.000',],
                ['id' => 'lebih dari 5.000.000',            'name' => 'lebih dari 5.000.000',],
                ['id' => 'Tidak Ada',                       'name' => 'Tidak Ada',],];
    public $agm =[
                ['id' => '0',                               'name' => 'Pilih Agama', 'disabled' => true,  ],
                ['id' => 'islam',                           'name' => 'Islam',],
                ['id' => 'katolik',                         'name' => 'Katolik',],
                ['id' => 'kristen',                         'name' => 'Kristen',],
                ['id' => 'budha',                           'name' => 'Budha',],
                ['id' => 'hindu',                           'name' => 'Hindu',],
                ['id' => 'konghucu',                        'name' => 'Konghucu',],];
    public $wl =[
                ['id' => 'Ayah','name' => 'Ayah', 'selected'=> true,],
                ['id' => 'Ibu','name' => 'Ibu',],
                ['id' => 'Lainnya','name' => 'Lainnya',]];

    public $provinces;
    public $regencies = [];
    public $districts = [];
    public $villages = [];

    public $selectedProvince = null;
    public $selectedRegency = null;
    public $selectedDistrict = null;
    public $selectedVillage = null;

    public function mount(siswa $siswa)
    {
        $this->siswa = $siswa;
        $this->provinces = Province::all();

        $this->nisn               = $siswa->nisn;         
        $this->nik                = $siswa->nik;          
        $this->nama               = $siswa->nama;         
        $this->tempat_lahir       = $siswa->tempat_lahir; 
        $this->tanggal_lahir      = $siswa->tanggal_lahir;
        $this->jenis_kelamin      = $siswa->jenis_kelamin;
        $this->agama              = $siswa->agama;

        $this->wali               = $siswa->waliSiswa->wali;

        $this->nik_ayah           = $siswa->waliSiswa->nik_ayah;
        $this->status_ayah        = $siswa->waliSiswa->status_ayah;        
        $this->nama_ayah          = $siswa->waliSiswa->nama_ayah;         
        $this->tempat_lahir_ayah  = $siswa->waliSiswa->tempat_lahir_ayah; 
        $this->tanggal_lahir_ayah = $siswa->waliSiswa->tanggal_lahir_ayah;
        $this->agama_ayah         = $siswa->waliSiswa->agama_ayah;        
        $this->pekerjaan_ayah     = $siswa->waliSiswa->pekerjaan_ayah;    
        $this->penghasilan_ayah   = $siswa->waliSiswa->penghasilan_ayah;  
        $this->handphone_ayah     = $siswa->waliSiswa->handphone_ayah;  

        $this->nik_ibu            = $siswa->waliSiswa->nik_ibu;
        $this->status_ibu         = $siswa->waliSiswa->status_ibu;            
        $this->nama_ibu           = $siswa->waliSiswa->nama_ibu;          
        $this->tempat_lahir_ibu   = $siswa->waliSiswa->tempat_lahir_ibu;  
        $this->tanggal_lahir_ibu  = $siswa->waliSiswa->tanggal_lahir_ibu; 
        $this->agama_ibu          = $siswa->waliSiswa->agama_ibu;         
        $this->pekerjaan_ibu      = $siswa->waliSiswa->pekerjaan_ibu;     
        $this->penghasilan_ibu    = $siswa->waliSiswa->penghasilan_ibu;   
        $this->handphone_ibu      = $siswa->waliSiswa->handphone_ibu; 

        $this->nik_wali           = $siswa->waliSiswa->nik_wali;          
        $this->nama_wali          = $siswa->waliSiswa->nama_wali;         
        $this->tempat_lahir_wali  = $siswa->waliSiswa->tempat_lahir_wali; 
        $this->tanggal_lahir_wali = $siswa->waliSiswa->tanggal_lahir_wali;
        $this->agama_wali         = $siswa->waliSiswa->agama_wali;        
        $this->pekerjaan_wali     = $siswa->waliSiswa->pekerjaan_wali;    
        $this->penghasilan_wali   = $siswa->waliSiswa->penghasilan_wali;  
        $this->handphone_wali     = $siswa->waliSiswa->handphone_wali;

        $this->EditStatus();
        $this->EditHandphone();
        $this->updateWaliList(); 
        
        $this->kelurahan = (int) $this->siswa->kelurahan;
        $this->rt_rw = $this->siswa->rt_rw;
        $this->alamat = $this->siswa->alamat;
        $this->kode_pos = $this->siswa->kode_pos;

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


    public function EditStatus()
    {
        if ($this->status_ayah == "Meninggal") {
            $this->isDisabledAyah = true;
        } elseif ($this->status_ayah == "Tidak Diketahui") {
            $this->isDisabledAyah = true;
        }
        else {
            $this->isDisabledAyah = false;
        }

        if ($this->status_ibu == "Meninggal") {
            $this->isDisabledIbu = true;
        } elseif ($this->status_ibu == "Tidak Diketahui") {
            $this->isDisabledIbu = true;
        }
        else {
            $this->isDisabledIbu = false;
        }
    }

    public function EditHandphone()
    {
        if ($this->handphone_ayah === null) {
            $this->isDisabledAyahHP = !$this->isDisabledAyahHP;
            $this->isCheckedAyah = !$this->isCheckedAyah;
        }

        if ($this->handphone_ibu === null) {
            $this->isDisabledIbuHP = !$this->isDisabledAyahHP;
            $this->isCheckedIbu = !$this->isCheckedAyah;
        }
        
        if ($this->handphone_wali === null) {
            $this->isDisabledWaliHP = !$this->isDisabledAyahHP;
            $this->isCheckedWali = !$this->isCheckedAyah;
        }
    }

     public function toggleDisabled($role, $value)
    {
        if ($role === 'ayah') {
            $this->isDisabledAyah = ($value === 'true');
            $this->isCheckedAyah = $this->isDisabledAyah;
            $this->isDisabledAyahHP = $this->isDisabledAyah;

            if ($this->isDisabledAyah) {
                $this->resetAyahFields();
            }
        } elseif ($role === 'ibu') {
            $this->isDisabledIbu = ($value === 'true');
            $this->isCheckedIbu = $this->isDisabledIbu;

            if ($this->isDisabledIbu) {
                $this->resetIbuFields();
            }
        }

        $this->updateWaliList();
    }

public function toggleDisabledHP($role)
{
    if ($role === 'ayah') {
        if (!$this->isDisabledAyahHP) {
            $this->isDisabledAyahHP = true;
            $this->isCheckedAyah = true;
            $this->handphone_ayah = null; // Mengosongkan handphone jika tidak ada nomor handphone
        } else {
            $this->isDisabledAyahHP = false;
            $this->isCheckedAyah = false;
        }
    } elseif ($role === 'ibu') {
        if (!$this->isDisabledIbuHP) {
            $this->isDisabledIbuHP = true;
            $this->isCheckedIbu = true;
            $this->handphone_ibu = null; // Mengosongkan handphone jika tidak ada nomor handphone
        } else {
            $this->isDisabledIbuHP = false;
            $this->isCheckedIbu = false;
        }
    } elseif ($role === 'wali') {
        if (!$this->isDisabledWaliHP) {
            $this->isDisabledWaliHP = true;
            $this->isCheckedWali = true;
            $this->handphone_wali = null; // Mengosongkan handphone jika tidak ada nomor handphone
        } else {
            $this->isDisabledWaliHP = false;
            $this->isCheckedWali = false;
        }
    }
}


    private function resetAyahFields()
    {
        $this->nama_ayah = "";
        $this->nik_ayah = "";
        $this->tempat_lahir_ayah = "";
        $this->tanggal_lahir_ayah = "";
        $this->jenis_kelamin_ayah = "";
        $this->agama_ayah = "";
        $this->alamat_ayah = "";
        $this->pekerjaan_ayah = "";
        $this->penghasilan_ayah = "";
        $this->handphone_ayah = "";
    }

    private function resetIbuFields()
    {
        $this->nama_ibu = "";
        $this->nik_ibu = "";
        $this->tempat_lahir_ibu = "";
        $this->tanggal_lahir_ibu = "";
        $this->jenis_kelamin_ibu = "";
        $this->agama_ibu = "";
        $this->alamat_ibu = "";
        $this->pekerjaan_ibu = "";
        $this->penghasilan_ibu = "";
        $this->handphone_ibu = "";
    }

    private function updateWaliList()
    {
         if ($this->isDisabledAyah && $this->isDisabledIbu) {
            $this->wl = [
                ['id' => 'Ayah', 'name' => 'Ayah', 'disabled' => $this->isDisabledAyah],
                ['id' => 'Ibu', 'name' => 'Ibu', 'disabled' => $this->isDisabledIbu],
                ['id' => 'Lainnya', 'name' => 'Lainnya'],
            ];
        } elseif ($this->isDisabledAyah) {
            $this->wl = [
                ['id' => 'Ayah', 'name' => 'Ayah', 'disabled' => $this->isDisabledAyah],
                ['id' => 'Ibu', 'name' => 'Ibu'],
                ['id' => 'Lainnya', 'name' => 'Lainnya'],
                ];
        } elseif ($this->isDisabledIbu) {
            $this->wl = [
                ['id' => 'Ayah', 'name' => 'Ayah'],
                ['id' => 'Ibu', 'name' => 'Ibu', 'disabled' => $this->isDisabledIbu],
                ['id' => 'Lainnya', 'name' => 'Lainnya'],
                ];
        } else {
            $this->wl = [
                ['id' => 'Ayah', 'name' => 'Ayah'],
                ['id' => 'Ibu', 'name' => 'Ibu',],
                ['id' => 'Lainnya', 'name' => 'Lainnya'],
                ];
        }
    }

    public function waliOpsi(){
        if ($this->wali === 'Ayah' || $this->wali === 'Ibu') {
            $this->nama_wali = "";
            $this->nik_wali = "";
            $this->tempat_lahir_wali = "";
            $this->tanggal_lahir_wali = "";
            $this->jenis_kelamin_wali = "";
            $this->agama_wali = "";
            $this->alamat_wali = "";
            $this->pekerjaan_wali = "";
            $this->penghasilan_wali = "";
            $this->handphone_wali = "";
        }
    }

    public function nextStep()
    {
        $this->validateCurrentStep(); // Validasi langkah saat ini sebelum pindah ke langkah berikutnya

        $this->currentStep++;
    }

    public function previousStep()
    {
        $this->currentStep--;
    }

    public function validateCurrentStep()
    {
        switch ($this->currentStep) {
            case 1:
                $this->validate([
                    'nisn'                  => 'required|numeric',
                    'nik'                   => 'required|numeric',
                    'nama'                  => 'required',
                    'tempat_lahir'          => 'required',
                    'tanggal_lahir'         => 'required',
                    'jenis_kelamin'         => 'required',
                    'agama'                 => 'required',
                ]);
                break;
            case 2:
                $this->validate([
                    'wali'                   => 'required',
                    'nik_ayah'               => [ Rule::unless($this->isDisabledAyah, 'required')],
                    'nama_ayah'              => [ Rule::unless($this->isDisabledAyah, 'required')],
                    'tempat_lahir_ayah'      => [ Rule::unless($this->isDisabledAyah, 'required')],
                    'tanggal_lahir_ayah'     => [ Rule::unless($this->isDisabledAyah, 'required')],
                    'agama_ayah'             => [ Rule::unless($this->isDisabledAyah, 'required')],
                    'pekerjaan_ayah'         => [ Rule::unless($this->isDisabledAyah, 'required')],
                    'penghasilan_ayah'       => [ Rule::unless($this->isDisabledAyah, 'required')],
                    'handphone_ayah'         => [ Rule::unless($this->isDisabledAyah || $this->isDisabledAyahHP, 'required')],
 
                    'nik_ibu'                => [ Rule::unless($this->isDisabledIbu, 'required')],
                    'nama_ibu'               => [ Rule::unless($this->isDisabledIbu, 'required')],
                    'tempat_lahir_ibu'       => [ Rule::unless($this->isDisabledIbu, 'required')],
                    'tanggal_lahir_ibu'      => [ Rule::unless($this->isDisabledIbu, 'required')],
                    'agama_ibu'              => [ Rule::unless($this->isDisabledIbu, 'required')],
                    'pekerjaan_ibu'          => [ Rule::unless($this->isDisabledIbu, 'required')],
                    'penghasilan_ibu'        => [ Rule::unless($this->isDisabledIbu, 'required')],
                    'handphone_ibu'          => [ Rule::unless($this->isDisabledIbu || $this->isDisabledIbuHP, 'required')],

                    'nik_wali'               => [ Rule::when($this->wali === 'Lainnya', 'required')],
                    'nama_wali'              => [ Rule::when($this->wali === 'Lainnya', 'required')],
                    'tempat_lahir_wali'      => [ Rule::when($this->wali === 'Lainnya', 'required')],
                    'tanggal_lahir_wali'     => [ Rule::when($this->wali === 'Lainnya', 'required')],
                    'agama_wali'             => [ Rule::when($this->wali === 'Lainnya', 'required')],
                    'pekerjaan_wali'         => [ Rule::when($this->wali === 'Lainnya', 'required')],
                    'penghasilan_wali'       => [ Rule::when($this->wali === 'Lainnya', 'required')],
                    'handphone_wali'         => [ Rule::when($this->wali === 'Lainnya' && !$this->isDisabledWaliHP, 'required')],
                ]);
                break;
            case 3:
                $this->validate([
                    // tambahkan aturan validasi formulir ketiga di sini
                ]);
                break;
            default:
                // Tidak ada validasi untuk langkah ini
                break;
        }
    }

    public function updateForm()
    {
        
    if ($this->siswa->foto && $this->foto) {
    Storage::disk('public')->delete($this->siswa->foto);
        }

        // Store the new photo if a new one is uploaded
        $file_upload = null;
        if ($this->foto) {
            $file_upload = $this->foto->store('images/siswa', 'public');
        }

        // Update the siswa record
        $this->siswa->update([
            'nisn'           => $this->nisn,
            'nik'            => $this->nik,
            'nama'           => $this->nama,
            'tempat_lahir'   => $this->tempat_lahir,
            'tanggal_lahir'  => $this->tanggal_lahir,
            'jenis_kelamin'  => $this->jenis_kelamin,
            'agama'          => $this->agama,
            'kelurahan'      => $this->selectedVillage,
            'rt_rw'          => $this->rt_rw,
            'alamat'         => $this->alamat,
            'kode_pos'       => $this->kode_pos,
            'foto'           => $file_upload ?? $this->siswa->foto // Keep old photo if no new photo is uploaded
        ]);

        // Update waliSiswa record
        $this->siswa->waliSiswa()->update([
            'wali'                   => $this->wali, 

            'nik_ayah'               => $this->nik_ayah,              
            'nama_ayah'              => $this->nama_ayah,
            'status_ayah'            => $this->status_ayah,               
            'tempat_lahir_ayah'      => $this->tempat_lahir_ayah,     
            'tanggal_lahir_ayah'     => $this->tanggal_lahir_ayah,     
            'agama_ayah'             => $this->agama_ayah,      
            'pekerjaan_ayah'         => $this->pekerjaan_ayah,         
            'penghasilan_ayah'       => $this->penghasilan_ayah,       
            'handphone_ayah'         => $this->handphone_ayah,        
                            
            'nik_ibu'                => $this->nik_ibu,                
            'nama_ibu'               => $this->nama_ibu,
            'status_ibu'             => $this->status_ibu,                
            'tempat_lahir_ibu'       => $this->tempat_lahir_ibu,       
            'tanggal_lahir_ibu'      => $this->tanggal_lahir_ibu,      
            'agama_ibu'              => $this->agama_ibu,      
            'pekerjaan_ibu'          => $this->pekerjaan_ibu,          
            'penghasilan_ibu'        => $this->penghasilan_ibu,        
            'handphone_ibu'          => $this->handphone_ibu,          

            'nik_wali'               => $this->nik_wali,         
            'nama_wali'              => $this->nama_wali,              
            'tempat_lahir_wali'      => $this->tempat_lahir_wali,      
            'tanggal_lahir_wali'     => $this->tanggal_lahir_wali,     
            'agama_wali'             => $this->agama_wali,             
            'pekerjaan_wali'         => $this->pekerjaan_wali,         
            'penghasilan_wali'       => $this->penghasilan_wali,       
            'handphone_wali'         => $this->handphone_wali,         
        ]);
        session()->flash('toastr', [
            'icon' => 'success',
            'message' => 'Data berhasil diperbaharui'
        ]);

        // Redirect to the 'siswa' route
        return redirect()->route('siswa');
    }

    public function render()
    {
        return view('livewire.posts.edit-data-siswa');
    }
}
