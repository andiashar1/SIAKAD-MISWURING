<div class="p-6">
    <x-toastr />
    <x-confirm-deleted />
    
    <x-header title="Wali Kelas" subtitle="Dashboard / Wali_Kelas">
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
            @scope('header_guru_id', $header)
                <h3 class="text-lg font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">
                    {{ $header['label'] }}
                </h3>
            @endscope
            @scope('header_kelas_id', $header)
                <h3 class="text-lg font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">
                    {{ $header['label'] }}
                </h3>
            @endscope
            @scope('header_ta_id', $header)
                <h3 class="text-lg font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">
                    {{ $header['label'] }}
                </h3>
            @endscope
            @scope('cell_id', $tampil)
                <strong>{{ $this->loop->iteration }}</strong>
            @endscope
            @scope('cell_guru_id', $tampil)
                {{ $tampil->guru->nama }}
            @endscope
            @scope('cell_kelas_id', $tampil)
                {{ $tampil->kelas->nama_kelas }} ({{ $tampil->kelas->kode_kelas }})
            @endscope
            @scope('cell_ta_id', $tampil)
                {{ $tampil->tahunAjaran->tahun_ajaran }} ({{ $tampil->tahunAjaran->semester }})
            @endscope
            @scope('actions', $tampil)
                <div class="flex justify-start">
                    <x-button icon="s-pencil-square" wire:click="edit('{{ $tampil->id }}')" spinner class="btn-xs text-amber-400 btn-ghost" />
                    <x-button icon="o-trash" @click="$wire.dispatch('confirm-delete', { get_id: '{{ $tampil->id }}' })" class="btn-xs text-red-500 btn-ghost" />
                </div>
            @endscope
        </x-table>

        {{-- modal create --}}
        <x-modal wire:model="showModal" persistent class="backdrop-blur" separator>
            @if ($headerEdit == false)
                <x-header title="Wali Kelas" size="text-2xl" subtitle="Tambah" separator progress-indicator />
            @else
                <x-header title="Wali Kelas" size="text-2xl" subtitle="Edit" separator progress-indicator />
            @endif
            <x-form wire:submit="simpan">
                <div class="gap-4 items-end lg:grid-cols-1">
                    <x-select label="Guru" wire:model="form.guru_id" :options="$guru" />
                    <x-select label="Kelas" wire:model="form.kelas_id" :options="$kelas" />
                    <x-select label="Tahun Ajaran" wire:model="form.ta_id" :options="$tahun_ajaran" />
                </div>
                <x-slot:actions>
                    <x-button label="Cancel" @click="$wire.showModal = false; $wire.editMode = false; $wire.headerEdit = false" />
                    <x-button label="Simpan" type="submit" class="btn-success text-white" spinner="simpan" />
                </x-slot:actions>
            </x-form>
        </x-modal>
    </div>
</div>
