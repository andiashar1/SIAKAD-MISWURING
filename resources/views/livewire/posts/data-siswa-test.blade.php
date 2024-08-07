<div class="p-6">
    <x-header title="Siswa" subtitle="Dashboard / Siswa / Tambah">
        <x-slot:actions>
            <x-button wire:navigate href="{{ route('siswa')}}" icon="o-arrow-left" class="btn-sm bg-red-500 text-white hover:bg-red-800" > Kembali </x-button>
        </x-slot:actions>
    </x-header>
    <div class="mb-6">
        <ol class="flex items-center w-full p-3 space-x-2 text-sm font-medium text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 sm:p-4 sm:space-x-4 rtl:space-x-reverse">
            @foreach ($steps as $step => $label)
                <li class="flex items-center {{ $currentStep == $step ? 'text-blue-600 dark:text-blue-500' : 'text-gray-500 dark:text-gray-400' }} space-x-2.5 rtl:space-x-reverse">
                    <span class="flex items-center justify-center w-8 h-8 border {{ $currentStep == $step ? 'border-blue-600 dark:border-blue-500' : 'border-gray-500 dark:border-gray-400' }} rounded-full shrink-0">
                        {{ $step }}
                    </span>
                    <span>
                        <h3 class="font-bold leading-tight">{{ $label['title'] }}</h3>
                        <p class="text-sm">{{ $label['details'] }}</p>
                    </span>
                    @if ($step < count($steps))
                        <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                        </svg>
                    @endif
                </li>
            @endforeach
        </ol>
    </div>

    <div class="bg-white rounded-md border border-gray-100 shadow-md shadow-black/5">
        <div class="p-6">
            @if ($currentStep == 1)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5 ">
                        <div class="justify-between mb-4">
                        <x-header title="Foto Profil"  size="text-x" separator />
                            <x-file wire:model="foto" class="-mt-6 flex justify-center" accept="image/png, image/jpeg" 
                                crop-after-change 
                                change-text="Change"
                                crop-text="Crop"
                                crop-title-text="Pangkas Foto"
                                crop-cancel-text="Cancel"
                                crop-save-text="Crop">
                                <img src="{{ $foto->avatar ?? asset('assets/img/empty-user.png') }}" class="h-40 rounded-full border-2 border-blue-500 mt-2" />
                            </x-file>
                            <label for="mary7762ae664472771fc8302f66bb280cc4" class="mt-3 flex py-1 px-5 justify-center text-white bg-blue-500 border-2 rounded" type="submit">
                            Pilih Foto
                            </label>
                        </div>
                    </div>
                    <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5 lg:col-span-2">
                        <div class="justify-between mb-4">
                            <x-header title="Data Siswa" size="text-x" separator />
                            <div class="grid gap-4 grid-cols-1">
                                <x-input-x type="text" nama="nisn"  label="Nomor Induk Siswa Nasional" wire:model="nisn" placeholder=""/>
                                <x-input-x type="text" nama="nik"  label="Nomor Induk Keluarga" wire:model="nik" placeholder=""/>
                                <x-input-x type="text" nama="nama"  label="Nama Lengkap" wire:model="nama" placeholder=""/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                    <div class="justify-between">
                        <div class="grid gap-4 lg:grid-cols-2">
                            <x-input-x type="text" nama="tempat_lahir"  label="Tempat Lahir" wire:model="tempat_lahir" placeholder=""/>
                            <x-date-x type="date" nama="tanggal_lahir"  label="Tanggal Lahir" wire:model="tanggal_lahir" placeholder=""/>
                            <x-select-x nama="jenis_kelamin"  label="Jenis Kelamin" wire:model="jenis_kelamin" labelOption="Pilih Jenis Kelamin" :options="$JK" :optionValue="'id'" :optionLabel="'name'"/>
                            <x-select-x nama="agama"  label="Agama" wire:model="agama" labelOption="Pilih Agama" :options="$agm" :optionValue="'id'" :optionLabel="'name'"/>
                        </div>
                    </div>
                </div>  
            @elseif ($currentStep == 2)
                <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-6 mb-6">
                    <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5 ">
                        <div class="justify-between mb-4">
                        <x-header title="Biodata Ayah"  size="text-x" separator />
                        </div>
                        <div class="grid gap-4 grid-cols-1">
                            <x-input-x type="text" nama="nama_ayah"  label="Nama Lengkap" wire:model.live="nama_ayah" placeholder=""/>
                            <label class="ml-3 font-bold">Status</label>
                            <div class="flex space-x-3">
                                <div class="flex items-center">
                                    <input wire:model="status_ayah" wire:click="toggleDisabled('ayah', 'false')" checked id="sts_hidup_ayah" type="radio" value="Hidup" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="sts_hidup_ayah" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Masih Hidup</label>
                                </div>
                                <div class="flex items-center">
                                    <input wire:model="status_ayah" wire:click="toggleDisabled('ayah', 'true')" id="sts_tdk_ayah" type="radio" value="Meninggal" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="sts_tdk_ayah" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sudah Meninggal</label>
                                </div>
                                <div class="flex items-center">
                                    <input wire:model="status_ayah" wire:click="toggleDisabled('ayah', 'true')" id="sts_meninggal_ayah" type="radio" value="Tidak diketahui" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="sts_meninggal_ayah" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tidak Diketahui</label>
                                </div>
                            </div>
                            <x-input-x type="text" nama="nik_ayah"  label="Nomor Induk Nasional" wire:model="nik_ayah" placeholder=""  disabled={{$isDisabledAyah}} />
                            <div class="grid grid-cols-1 gap-2 lg:grid-cols-3">
                            <x-input-x type="text" nama="tempat_lahir_ayah" label="Tempat Lahir" wire:model="tempat_lahir_ayah" placeholder=""  disabled={{$isDisabledAyah}} />
                            <x-date-x type="date" nama="tanggal_lahir_ayah"  label="Tanggal Lahir" wire:model="tanggal_lahir_ayah" placeholder=""  disabled={{$isDisabledAyah}} />
                            <x-select-x nama="agama_ayah"  label="Agama" wire:model="agama_ayah" labelOption="Pilih Agama" :options="$agm" :optionValue="'id'" :optionLabel="'name'" disabled={{$isDisabledAyah}} />
                            </div>
                            <div class="grid grid-cols-2 gap-2 lg:grid-cols-2">
                            <x-select-x nama="pekerjaan_ayah"  label="Pekerjaan" wire:model="pekerjaan_ayah" labelOption=" Pilih Pekerjaan" :options="$pkj" :optionValue="'id'" :optionLabel="'name'" disabled={{$isDisabledAyah}} />
                            <x-select-x nama="penghasilan_ayah"  label="Penghasilan" wire:model="penghasilan_ayah" labelOption="Penghasilan Rata-Rata" :options="$phl" :optionValue="'id'" :optionLabel="'name'" disabled={{$isDisabledAyah}} />
                            </div>
                            <div class="grid grid-cols-2 gap-2 lg:grid-cols-2">
                                <x-input-x type="text" nama="handphone_ayah" label="Nomor Handphone" wire:model="handphone_ayah" placeholder=""  disabled={{$isDisabledAyah||$isDisabledAyahHP}}  />
                                <div class="flex items-center ml-3">
                                    <input wire:click="toggleDisabledHP('ayah')"  type="Checkbox" id="DisabledAyahHP" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" @if ($isDisabledAyah) disabled checked @endif>
                                    <label for="DisabledAyahHP" class="ms-2 text-sm font-medium text-black  dark:text-gray-500 disabled:text-gray-500" @if ($isDisabledAyah) disabled @endif>Tidak Ada Nomor Handphone</label>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5 ">
                        <div class="justify-between mb-4">
                        <x-header title="Biodata ibu"  size="text-x" separator />
                        </div>
                        <div class="grid gap-4 grid-cols-1">
                            <x-input-x type="text" nama="nama_ibu"  label="Nama Lengkap" wire:model.live="nama_ibu" placeholder=""/>
                            <label class="ml-3 font-bold">Status</label>
                            <div class="flex space-x-3">
                                <div class="flex items-center">
                                    <input wire:model="status_ibu" wire:click="toggleDisabled('ibu', 'false')" checked id="default-radio-1" type="radio" value="Hidup" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="default-radio-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Masih Hidup</label>
                                </div>
                                <div class="flex items-center">
                                    <input wire:model="status_ibu" wire:click="toggleDisabled('ibu', 'true')" id="default-radio-2" type="radio" value="Meninggal" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sudah Meninggal</label>
                                </div>
                                <div class="flex items-center">
                                    <input wire:model="status_ibu" wire:click="toggleDisabled('ibu', 'true')" id="default-radio-3" type="radio" value="Tidak diketahui" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="default-radio-3" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tidak Diketahui</label>
                                </div>
                            </div>
                            <x-input-x type="text" nama="nik_ibu"  label="Nomor Induk Nasional" wire:model="nik_ibu" placeholder=""  disabled={{$isDisabledIbu}} />
                            <div class="grid grid-cols-1 gap-2 lg:grid-cols-3">
                            <x-input-x type="text" nama="tempat_lahir_ibu" label="Tempat Lahir" wire:model="tempat_lahir_ibu" placeholder=""  disabled={{$isDisabledIbu}} />
                            <x-date-x type="date" nama="tanggal_lahir_ibu"  label="Tanggal Lahir" wire:model="tanggal_lahir_ibu" placeholder="" disabledPlaceholder disabled={{$isDisabledIbu}} />
                            <x-select-x nama="agama_ibu"  label="Agama" wire:model="agama_ibu" labelOption="Pilih Agama" :options="$agm" :optionValue="'id'" :optionLabel="'name'" disabled={{$isDisabledIbu}} />
                            </div>
                            <div class="grid grid-cols-2 gap-2 lg:grid-cols-2">
                            <x-select-x nama="pekerjaan_ibu"  label="Pekerjaan" wire:model="pekerjaan_ibu" labelOption=" Pilih Pekerjaan" :options="$pkj" :optionValue="'id'" :optionLabel="'name'" disabled={{$isDisabledIbu}} />
                            <x-select-x nama="penghasilan_ibu"  label="Penghasilan" wire:model="penghasilan_ibu" labelOption=" Pilih Penghasilan" :options="$phl" :optionValue="'id'" :optionLabel="'name'" disabled={{$isDisabledIbu}} />
                            </div>
                            <div class="grid grid-cols-2 gap-2 lg:grid-cols-2">
                                <x-input-x type="text" nama="handphone_ibu" label="Nomor Handphone" wire:model="handphone_ibu" placeholder=""  disabled={{$isDisabledIbu||$isDisabledIbuHP}}  />
                                <div class="flex items-center ml-3">
                                    <input wire:click="toggleDisabledHP('ibu')"  type="Checkbox" id="DisabledIbuHP" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" @if ($isDisabledIbu) disabled checked @endif>
                                    <label for="DisabledIbuHP" class="ms-2 text-sm font-medium text-black  dark:text-gray-500 disabled:text-gray-500">Tidak Ada Nomor Handphone</label>
                                </div>                            
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5 ">
                        <div class="justify-between mb-4">
                        <x-header title="Biodata Wali"  size="text-x" separator />
                        </div>
                        <div class="grid gap-4 grid-cols-1">
                            <x-select-x nama="wali"  label="Wali siswa" wire:model.live="wali" wire:change="waliOpsi"  labelOption="Tinggal Bersama" :options="$wl" :optionValue="'id'" :optionLabel="'name'" />
                            @if ($wali === 'Ayah')
                                <x-input-x type="text" nama="nama_ayah"  label="Nama Lengkap" wire:model.live="nama_ayah" placeholder="" readonly/>
                            @elseif ($wali === 'Ibu')
                                <x-input-x type="text" nama="nama_ibu"  label="Nama Lengkap" wire:model.live="nama_ibu" placeholder="" readonly/>
                            @elseif ($wali === 'Lainnya')
                                <x-input-x type="text" nama="nama_wali"  label="Nama Lengkap" wire:model="nama_wali" placeholder=""/>
                                <label class="ml-3 font-bold">Status</label>
                                <x-input-x type="text" nama="nik_wali"  label="Nomor Induk Nasional" wire:model="nik_wali" placeholder=""  />
                                <div class="grid grid-cols-1 gap-2 lg:grid-cols-3">
                                <x-input-x type="text" nama="tempat_lahir_wali" label="Tempat Lahir" wire:model="tempat_lahir_wali" placeholder=""  />
                                <x-date-x type="date" nama="tanggal_lahir_wali"  label="Tanggal Lahir" wire:model="tanggal_lahir_wali" placeholder=""  />
                                <x-select-x nama="agama_wali"  label="Agama" wire:model="agama_wali" labelOption="Pilih Agama" :options="$agm" :optionValue="'id'" :optionLabel="'name'" />
                                </div>
                                <div class="grid grid-cols-2 gap-2 lg:grid-cols-2">
                                <x-select-x nama="pekerjaan_wali"  label="Pekerjaan" wire:model="pekerjaan_wali" labelOption=" Pilih Pekerjaan" :options="$pkj" :optionValue="'id'" :optionLabel="'name'" />
                                <x-select-x nama="penghasilan_wali"  label="Penghasilan" wire:model="penghasilan_wali" labelOption=" Pilih Penghasilan" :options="$phl" :optionValue="'id'" :optionLabel="'name'" />
                                </div>
                                <div class="grid grid-cols-2 gap-2 lg:grid-cols-2">
                                    <x-input-x type="text" nama="handphone_wali" label="Nomor Handphone" wire:model="handphone_wali" placeholder=""  disabled={{$isDisabledWaliHP}}  />
                                    <div class="flex items-center ml-3">
                                        <input wire:click="toggleDisabledHP('wali')"  type="Checkbox" id="DisabledWaliHP" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="DisabledWaliHP" class="ms-2 text-sm font-medium text-black  dark:text-gray-500 disabled:text-gray-500">Tidak Ada Nomor Handphone</label>
                                    </div>                            
                                </div>
                            @endif
                            
                        </div>
                    </div>
                </div>
            @elseif ($currentStep == 3)
                 <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-6 mb-6">
                    <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5 ">
                        <div class="justify-between mb-4">
                        <x-header title="Alamat"  size="text-x" separator />
                        </div>
                        <div class="grid gap-4 mb-4 lg:grid-cols-2">
                            <x-select-x nama="selectedProvince"  label="Provinsi" wire:model.live="selectedProvince" labelOption="Pilih Provinsi" :options="$provinces" :optionValue="'id'" :optionLabel="'name'"/>
                            <x-select-x nama="selectedRegency"  label="Kabupaten/Kota" wire:model.live="selectedRegency" labelOption="Pilih Kabupaten/Kota" :options="$regencies" :optionValue="'id'" :optionLabel="'name'" readonly={{!$selectedProvince}} />
                            <x-select-x nama="selectedDistrict"  label="Kecamatan" wire:model.live="selectedDistrict" labelOption="Pilih Kecamatan" :options="$districts" :optionValue="'id'" :optionLabel="'name'" readonly={{!$selectedRegency}} />
                            <x-select-x nama="selectedVillage"  label="Kelurahan/Desa" wire:model.live="selectedVillage" labelOption="Pilih Kelurahan/Desa" :options="$villages" :optionValue="'id'" :optionLabel="'name'" readonly={{!$selectedVillage}} />
                        </div>
                        <div class="grid gap-4 lg:grid-cols-3">
                            <x-input-x type="text" nama="rt_rw" label="RT/RW" wire:model="rt_rw" placeholder="" />
                            <x-input-x type="text" nama="alamat" label="Alamat" wire:model="alamat" placeholder="" />
                            <x-input-x type="text" nama="kode_pos" label="Kode Pos" wire:model="kode_pos" placeholder="" />
                        </div>
                    </div>
                </div>
             @endif
        </div>

        <div class="flex justify-between p-6">
            @if ($currentStep > 1)
                <x-button wire:click="previousStep" label="Sebelumnya" class="text-white bg-gray-500" spinner />
            @endif

            @if ($currentStep > 2)
                <x-button wire:click="simpan" label="Simpan" class="text-white bg-green-500" spinner />
            @endif

            @if ($currentStep < count($steps))
                <x-button wire:click="nextStep" label="Selanjutnya" class="text-white bg-blue-500" spinner />
            @endif
        </div>
    </div>
</div>

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>

<script>
    document.addEventListener('livewire:load', function () {
        $('.select2').select2();

        $('.select2').on('change', function (e) {
            let elementName = $(this).attr('id');
            @this.set(elementName, $(this).val());
        });

        Livewire.on('updatedSelect2', function () {
            $('.select2').select2();
        });
    });
</script>
    
@endpush