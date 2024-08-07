<div class="p-6">
    <x-toastr/>
    <x-confirm-deleted/>
    
    <x-header title="Jadwal Pelajaran" subtitle="Dashoboard / Jadwal Pelajaran / Tambah">
        <x-slot:actions>
            <x-button wire:navigate href="{{ route('siswa') }}" icon="o-arrow-left" class="btn-sm bg-red-500 text-white hover:bg-red-800">Kembali</x-button>
        </x-slot:actions>
    </x-header>
    
    <div class="mb-4 bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
        <table class="table-fixed w-full font-bold">
            <tr>
                <td class="w-1/5">Kelas</td>
                <td class="w-2/5">: {{ $wali_kelas->kelas->nama_kelas }}</td>
                <td class="w-1/5">Tahun Ajaran</td>
                <td class="w-1/5">: {{ $wali_kelas->tahunAjaran->tahun_ajaran }} ({{ $wali_kelas->tahunAjaran->semester }})</td>
            </tr>
            <tr>
                <td class="w-1/5">Wali Kelas</td>
                <td class="w-2/5">: {{ $wali_kelas->guru->nama }}</td>
            </tr>
        </table>
    </div>
    
    <x-header>
        <x-slot:middle class="!justify-end">
            <x-button icon="o-plus" class="text-white bg-blue-500 btn-sm" spinner label="Tambah" @click="$wire.showModal = true"/>
        </x-slot:middle>
        <x-slot:actions>
            <x-input icon="o-magnifying-glass" placeholder="Search..."/>
        </x-slot:actions>
    </x-header>
    
    <div class="-mt-5 bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
        <x-table :headers="$headers" :rows="$tampil" with-pagination>
            @scope('header_id', $header)
                <h3 class="text-lg font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">{{ $header['label'] }}</h3> 
            @endscope
            @scope('header_id_japel', $header)
                <h3 class="text-lg font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">{{ $header['label'] }}</h3> 
            @endscope
            @scope('header_mapel_id', $header)
                <h3 class="text-lg font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">{{ $header['label'] }}</h3> 
            @endscope
            @scope('header_guru_id', $header)
                <h3 class="text-lg font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">{{ $header['label'] }}</h3> 
            @endscope
            @scope('header_kelas_id', $header)
                <h3 class="text-lg font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">{{ $header['label'] }}</h3> 
            @endscope
            @scope('header_hari', $header)
                <h3 class="text-lg font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">{{ $header['label'] }}</h3> 
            @endscope
            @scope('header_jam', $header)
                <h3 class="text-lg font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">{{ $header['label'] }}</h3> 
            @endscope
            @scope('cell_id', $tampil)
                <strong>{{ $this->loop->iteration }}</strong>   
            @endscope
            @scope('cell_mapel_id', $tampil)
                {{ $tampil->mapel->nama_mapel }}
            @endscope
            @scope('cell_guru_id', $tampil)
                {{ $tampil->guru->nama }}
            @endscope
            @scope('cell_kelas_id', $tampil)
                {{ $tampil->kelas->nama_kelas }} ({{ $tampil->kelas_id }})
            @endscope
            @scope('cell_jam', $tampil)
                {{ $tampil->jam_awal }} - {{ $tampil->jam_akhir }}
            @endscope
            @scope('actions', $tampil)
                <div class="flex justify-start">
                    <x-button icon="s-pencil-square" wire:click="edit('{{ $tampil->id }}')" spinner class="btn-xs text-amber-400 btn-ghost"/>    
                    <x-button icon="o-trash" @click="$wire.dispatch('confirm-delete', { get_id: '{{ $tampil->id }}' })" class="btn-xs text-red-500 btn-ghost"/>
                </div>
            @endscope
        </x-table>
    </div>
    
    <!-- Main modal -->
    <div x-data="{ open: @entangle('showModal') }" x-show="open" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-75 backdrop-blur" style="display: none;">
        <div class="relative p-4 w-full max-w-6xl max-h-full bg-white rounded-lg shadow-lg dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                @if ($headerEdit == false)
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Tambah Data Rombel Siswa</h3>
                @else
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Edit Data Rombel Siswa</h3>
                @endif
                <button @click="$wire.showModal = false" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            
            <!-- Modal content -->
            <x-form wire:submit="simpan">
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="py-4">
                            <x-select label="Guru" :options="$guru" wire:model="form.guru_id" placeholder="Pilih Guru" placeholder-value="0"/>
                            <x-select label="Mata Pelajaran" :options="$mapel" wire:model="form.mapel_id" placeholder="Pilih Mata Pelajaran" placeholder-value="0"/>
                        </div>
                        <div class="py-4">
                            <x-select label="Hari" :options="$hr" wire:model="form.hari" placeholder="Pilih Hari" placeholder-value="0"/>
                            <div class="grid grid-cols-2 space-x-4">
                                <x-datetime label="Pukul" wire:model="form.jam_awal" icon="o-calendar" type="time"/>
                                <x-datetime label="." wire:model="form.jam_akhir" icon="o-calendar" type="time"/>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <x-button label="Simpan" type="submit" class="btn-success text-white mr-4" spinner="simpan"/>
                    <x-button label="Cancel" wire:click="tutupModal" spinner/>
                </div> 
            </x-form>
        </div>
    </div>
</div>
