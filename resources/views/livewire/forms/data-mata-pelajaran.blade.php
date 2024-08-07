<div class="p-6">
    <x-toastr />
    <x-confirm-deleted />

    <x-header title="Mata Pelajaran" subtitle="Dashboard / Mata Pelajaran">
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
            @scope('header_kode_mapel', $header)
                <h3 class="text-lg font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">
                    {{ $header['label'] }}
                </h3>
            @endscope
            @scope('header_nama_mapel', $header)
                <h3 class="text-lg font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">
                    {{ $header['label'] }}
                </h3>
            @endscope
            @scope('header_kategori', $header)
                <h3 class="text-lg font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">
                    {{ $header['label'] }}
                </h3>
            @endscope
            @scope('header_kelompok', $header)
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
                    <x-button icon="o-trash" wire:click="$dispatch('confirm-delete', { get_id: '{{ $tampil->id_mapel }}' })" class="btn-xs text-red-500 btn-ghost" />
                </div>
            @endscope
        </x-table>

        {{-- modal create --}}
        <x-modal wire:model="showModal" persistent class="backdrop-blur" separator>
            <x-header title="Mata Pelajaran" size="text-2xl" :subtitle="$headerEdit ? 'Edit' : 'Tambah'" separator progress-indicator />

            <x-form wire:submit="simpan">
                <div x-data="{
                    kategori: '',
                    kodeMapel: '',
                    get formId() {
                        const getInitials = (text) => {
                            return text.split(' ').map(word => word.charAt(0)).join('').toUpperCase();
                        };
                        const kategoriInitials = getInitials(this.kategori);
                        return `${kategoriInitials}${this.kodeMapel}`;
                    }
                }">
                    <div class="grid grid-cols-1 gap-4 items-end lg:grid-cols-1">
                        <div class="grid grid-cols-2 gap-4">
                            <x-input x-bind:value="formId"  wire:model="form.kode_mapel" label="Kode Kelas" readonly />
                            <x-input x-model="kodeMapel" wire:model="form.kode_mapel_angka" label="." />
                        </div>
                        <x-input wire:model="form.nama_mapel" label="Mata Pelajaran" />
                        <div class="grid grid-cols-2 gap-4">
                            <x-select x-model="kategori" wire:model="form.kategori" :options="$kt" label="Kategori" placeholder="Pilih Kategori" placeholder-value="0" />
                            <x-select wire:model="form.kelompok" :options="$kl" label="Kelompok" placeholder="Pilih Kelompok" placeholder-value="0" />
                        </div>
                    </div>
                    <x-slot:actions>
                        <x-button label="Cancel" @click="$wire.showModal = false; $wire.editMode = false; $wire.headerEdit = false" />
                        <x-button label="Simpan" type="submit" class="btn-success text-white" spinner="simpan" />
                    </x-slot:actions>
                </div>
            </x-form>
        </x-modal>
    </div>
</div>
