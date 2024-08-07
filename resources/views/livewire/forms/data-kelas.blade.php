<div class="p-6">
    <x-toastr/>
    <x-confirm-deleted/>
    
    <x-header title="Kelas" subtitle="Dashoboard / Kelas">
        <x-slot:middle class="!justify-end">
            <x-input icon="o-magnifying-glass" placeholder="Search..." />
        </x-slot:middle>
        <x-slot:actions>
            <x-button icon="o-plus" class="text-white bg-blue-500 btn-sm" spinner label="Tambah" wire:click="munculModal" />
        </x-slot:actions>
    </x-header>
    
    <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
        <x-table :headers="$headers" :rows="$tampil" with-pagination>
            @scope('header_id', $header)
                <h3 class="text-lg font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">
                    {{ $header['label'] }}
                </h3>
            @endscope
            
            @scope('header_id_kelas', $header)
                <h3 class="text-lg font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">
                    {{ $header['label'] }}
                </h3>
            @endscope
            
            @scope('header_kode_kelas', $header)
                <h3 class="text-lg font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">
                    {{ $header['label'] }}
                </h3>
            @endscope
            
            @scope('header_nama_kelas', $header)
                <h3 class="text-lg font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">
                    {{ $header['label'] }}
                </h3>
            @endscope
            
            @scope('header_kapasitas', $header)
                <h3 class="text-lg font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">
                    {{ $header['label'] }}
                </h3>
            @endscope
            
            @scope('cell_id', $tampil)
                <strong>{{ $this->loop->iteration }}</strong>
            @endscope
            
            @scope('actions', $tampil)
                <div class="flex justify-start">
                    <x-button icon="s-pencil-square" wire:click="edit('{{ $tampil->id }}')" spinner class="btn-xs text-amber-400 btn-ghost" />
                    <x-button icon="o-trash" wire:click="$dispatch('confirm-delete', { get_id: '{{ $tampil->id }}' })" class="btn-xs text-red-500 btn-ghost" />
                </div>
            @endscope
        </x-table>
        
        {{-- Modal Create/Edit --}}
        <x-modal wire:model="showModal" persistent class="backdrop-blur" separator>
            @if ($headerEdit == false)
                <x-header title="Kelas" size="text-2xl" subtitle="Tambah" separator progress-indicator />
            @else
                <x-header title="Kelas" size="text-2xl" subtitle="Edit" separator progress-indicator />
            @endif
            @if($errors->has('kode_kelas'))
                <div class="text-red-500">{{ $errors->first('kode_kelas') }}</div>
            @endif

            @if($errors->has('general'))
                <div class="text-red-500">{{ $errors->first('general') }}</div>
            @endif
            <x-form wire:submit="simpan">
                <div class="grid grid-cols-1 gap-4 items-end lg:grid-cols-2">
                    <x-input wire:model="form.nama_kelas" label="Kelas"/>
                    <x-input wire:model="form.kapasitas" label="Kapasitas"/>
                </div>
                <x-slot:actions>
                    <x-button label="Cancel" @click="$wire.showModal = false; $wire.editMode = false; $wire.headerEdit = false" />
                    <x-button label="Simpan" type="submit" class="btn-success text-white" spinner="simpan"/>
                </x-slot:actions>
            </x-form>
        </x-modal>
    </div>
</div>
