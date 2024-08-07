<div class="p-6">
    <x-header title="Guru" subtitle="dashboard/guru/tambah">
        <x-slot:actions>
            <x-button wire:navigate href="{{ route('siswa') }}" icon="o-arrow-left" class="btn-sm bg-red-500 text-white hover:bg-red-800">Kembali</x-button>
        </x-slot:actions>
    </x-header>
    <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
        <x-form wire:submit="save">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                    <div class="justify-between mb-4">
                        <x-header title="Foto Profil" size="text-x" separator />
                        <x-file wire:model="foto" class="-mt-6 flex justify-center" accept="image/png, image/jpeg" 
                            crop-after-change 
                            change-text="Change"
                            crop-text="Crop"
                            crop-title-text="Pangkas Foto"
                            crop-cancel-text="Cancel"
                            crop-save-text="Crop">
                            <img src="{{ $foto->avatar ?? asset('assets/img/empty-user.png') }}" class="h-40 rounded-full border-2 border-blue-500 mt-2" />
                        </x-file>
                        <label for="mary7762ae664472771fc8302f66bb280cc4" class="mt-3 flex py-1 px-5 justify-center text-white bg-blue-500 border-2 rounded">
                            Pilih Foto
                        </label>
                    </div>
                </div>
                <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5 lg:col-span-2">
                    <div class="justify-between mb-4">
                        <x-header title="Data Guru" size="text-x" separator />
                        <div class="grid gap-4 grid-cols-1">
                            <x-input-x type="text" nama="nip" label="Nomor Induk Pegawai" wire:model="nip" placeholder="" :disabled="$isDisabledNIP"/>
                            <div class="flex items-center ml-3">
                                <input wire:click="toggleDisabledNIP" type="checkbox" id="toggleDisabledNIP" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label for="toggleDisabledNIP" class="ms-2 text-sm font-medium text-black">Tidak Ada Nomor NIP</label>
                            </div>
                            <x-input-x type="text" nama="nuptk" label="Nomor Unik Pendidik dan Tendik" wire:model="nuptk" placeholder="" :disabled="$isDisabledNUPTK"/>
                            <div class="flex items-center ml-3">
                                <input wire:click="toggleDisabledNUPTK" type="checkbox" id="toggleDisabledNUPTK" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label for="toggleDisabledNUPTK" class="ms-2 text-sm font-medium text-black">Tidak Ada Nomor NUPTK</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                <div class="justify-between">
                    <x-header title="Biodata Guru" size="text-x" separator />
                    <div class="grid gap-4 lg:grid-cols-1">
                        <x-input-x type="text" nama="nama" label="Nama Lengkap" wire:model="nama" placeholder="" />
                    </div>
                    <div class="grid gap-4 mt-4 lg:grid-cols-2">
                        <x-input-x type="text" nama="tempat_lahir" label="Tempat Lahir" wire:model="tempat_lahir" placeholder="" />
                        <x-date-x type="date" nama="tanggal_lahir" label="Tanggal Lahir" wire:model="tanggal_lahir" placeholder="" />
                        <x-select-x nama="jenis_kelamin" label="Jenis Kelamin" wire:model="jenis_kelamin" labelOption="Pilih Jenis Kelamin" :options="$JK" :optionValue="'id'" :optionLabel="'name'" />
                        <x-select-x nama="agama" label="Agama" wire:model="agama" labelOption="Pilih Agama" :options="$agm" :optionValue="'id'" :optionLabel="'name'" />
                    </div>
                    <div class="grid gap-4 my-4 lg:grid-cols-1">
                        <label class="ml-3 font-bold">Alamat</label>
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
            <x-slot:actions>
            <x-button label="Simpan" wire:click="save" class="text-white bg-green-500 hover:bg-green-700" spinner/>
            </x-slot:actions>
        </x-form>
    </div>
</div>
