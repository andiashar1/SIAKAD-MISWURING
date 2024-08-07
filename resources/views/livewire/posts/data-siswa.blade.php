<div class="p-6">
    <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
    <x-header title="Users" subtitle="Check this on mobile">
        <x-slot:actions>
            <x-button wire:navigate href="{{ route('siswa')}}" icon="o-arrow-left" class="btn-sm bg-red-500 text-white hover:bg-red-800" > Kembali </x-button>
        </x-slot:actions>
    </x-header>
    <x-form wire:submit="simpan">
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
                    <div class="justify-between my-4">
                        <x-header title="Data Siswa"  size="text-x" separator />
                        <div class="-mt-4 m-4"><x-input label="NISN" inline wire:model="nisn"/></div>
                        <div class="m-4"><x-input label="NIK" inline wire:model="nik"/></div>
                        <div class="mx-4 "><x-input label="Nama Lengkap" inline wire:model="nama"/></div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mb-6">
                <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                    <div class="grid justify-stretch">
                        <div class="grid lg:grid-cols-2">
                            <div class="m-2" ><x-input label="Tempat Lahir" inline wire:model="tempat_lahir"/></div>
                            <div class="m-2"><x-datetime wire:model="tanggal_lahir" icon="o-calendar" placeholder=" tanggal lahir"/></div>
                        </div>
                        <div class="grid lg:grid-cols-2">
                            <div class="m-2" ><x-select label="Jenis Kelamin" :options="$JK" wire:model="jenis_kelamin" inline /></div>
                            <div class="m-2" ><x-select label="Jenis Kelamin" :options="$agm" wire:model="agama" inline /></div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                    <div class="grid justify-stretch">
                        <div class="m-2"><x-input label="Alamat Lengkap" inline wire:model="alamat"/></div>
                        <div class="m-2" ><x-select label="Tinggal Bersama" :options="$tb" wire:model="tinggal_bersama" inline /></div>
                    </div>
                </div>
            </div>
            <x-slot:actions>
                <x-button label="Simpan" type="submit" class="btn-primary" spinner="simpan" />
            </x-slot:actions>
    </x-form>           
</div>