<?php

namespace App\Livewire\Posts;

use App\Models\Siswa;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;

class DataSiswaTest extends Component
{   
    use WithFileUploads;

    public $currentStep = 1;
    public $steps = [
        1 => ['title' => 'Biodata', 'details' => 'Siswa'],
        2 => ['title' => 'Biodata', 'details' => 'Wali Siswa'],
        3 => ['title' => 'Alamat', 'details' => 'Siswa'],
    ];

    public bool $isCheckedAyah = false;
    public bool $isCheckedIbu = false;
    public bool $isCheckedWali = false;
    public bool $isDisabledAyah = false;
    public bool $isDisabledIbu = false;
    public bool $isDisabledAyahHP = false;
    public bool $isDisabledIbuHP = false;
    public bool $isDisabledWaliHP = false;
    public $status_ayah = 'Hidup';
    public $status_ibu = 'Hidup';
    public $wali; 
    public $nisn, $nik, $nama, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $agama, $alamat, $rt_rw, $kode_pos, $kelurahan, $foto;
    public $nama_ayah, $nik_ayah, $tempat_lahir_ayah, $tanggal_lahir_ayah, $jenis_kelamin_ayah, $agama_ayah, $alamat_ayah, $pekerjaan_ayah, $penghasilan_ayah, $handphone_ayah;
    public $nama_ibu, $nik_ibu, $tempat_lahir_ibu, $tanggal_lahir_ibu, $jenis_kelamin_ibu, $agama_ibu, $alamat_ibu, $pekerjaan_ibu, $penghasilan_ibu, $handphone_ibu;
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
    
public function toggleDisabled($role, $value)
{
    if ($role === 'ayah') {
        $this->isDisabledAyah = ($value === 'true');
        $this->isCheckedAyah = $this->isDisabledAyah;

        if ($this->isDisabledAyah) {
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
    } elseif ($role === 'ibu') {
        $this->isDisabledIbu = ($value === 'true');
        $this->isCheckedIbu = $this->isDisabledIbu;

        if ($this->isDisabledIbu) {
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
    }

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

    public function toggleDisabledHP($role)
    {
        if ($role === 'ayah') {
            $this->isDisabledAyahHP = !$this->isDisabledAyahHP;
            $this->isCheckedAyah = !$this->isCheckedAyah;
        } elseif ($role === 'ibu') {
            $this->isDisabledIbuHP = !$this->isDisabledIbuHP;
            $this->isCheckedIbu = !$this->isCheckedIbu;
        } elseif ($role === 'wali') {
            $this->isDisabledWaliHP = !$this->isDisabledWaliHP;
            $this->isCheckedWali = !$this->isCheckedWali;
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

    public function submitForm()
    {
        $file_upload = null;
        if ($this->foto) {
        $file_upload = $this->foto->store('images/siswa', 'public');
        }

        $siswa = Siswa::create([
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
            'foto'           => $file_upload
    ]);
        $siswa->waliSiswa()->create([
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
        return redirect()->route('siswa');
    }
    public function render()
    {
        return view('livewire.posts.data-siswa-test');
    }
}
