<div class="p-6">
    <x-toastr />
    <x-confirm-deleted />
    <x-confirm-toogle-aktif/>

    <x-header title="Tahun Ajaran" subtitle="Dashboard / Tahun Ajaran">
        <x-slot:middle class="!justify-end">
            <x-input icon="o-magnifying-glass" placeholder="Search..." />
        </x-slot:middle>
        <x-slot:actions>
            <x-button icon="o-plus" class="text-white bg-blue-500 btn-sm" spinner label="Tambah" wire:click="munculModal" />
        </x-slot:actions>
    </x-header>

    <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
        <div class="flex justify-between mb-4">
            <div>
                <label for="perPage" class="text-sm font-medium text-gray-700">Items per page:</label>
                <select wire:model.live="perPage" id="perPage" class="block w-full mt-1 text-sm text-gray-700 bg-white border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @foreach($perPageOptions as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <x-table :headers="$headers" :rows="$tampil" with-pagination>
            @scope('header_id', $header)
                <h3 class="text-lg font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">
                    {{ $header['label'] }}
                </h3>
            @endscope
            @scope('header_kode_ta', $header)
                <h3 class="text-lg font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">
                    {{ $header['label'] }}
                </h3>
            @endscope
            @scope('header_tahun_ajaran', $header)
                <h3 class="text-lg font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">
                    {{ $header['label'] }}
                </h3>
            @endscope
            @scope('header_semester', $header)
                <h3 class="text-lg font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">
                    {{ $header['label'] }}
                </h3>
            @endscope
            @scope('header_aktif', $header)
                <h3 class="text-lg font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">
                    {{ $header['label'] }}
                </h3>
            @endscope
            @scope('cell_id', $tampil)
                <strong>{{ $this->loop->iteration }}</strong>
            @endscope
            @scope('cell_aktif', $tampil)
                <label class="inline-flex items-center cursor-pointer" x-data="{ open: false, id: null }">
                    <input type="checkbox" value="{{ $tampil->id }}" class="sr-only peer" 
                        wire:click="$dispatch('confirm-toogle-aktif', { get_id: '{{ $tampil->id }}' })"
                        @if($tampil->aktif) checked @endif
                        x-on:click.prevent="open = true; id = {{ $tampil->id }}">
                    <div class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600"></div>
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $tampil->aktif ? 'Aktif' : 'Non-Aktif' }}</span>
            @endscope
            @scope('actions', $tampil)
                <div class="flex justify-start">
                    <x-button icon="s-pencil-square" wire:click="edit('{{ $tampil->id }}')" spinner class="btn-xs text-amber-400 btn-ghost" />
                    <x-button icon="o-trash" wire:click="$dispatch('confirm-delete', { get_id: '{{ $tampil->id }}' })" class="btn-xs text-red-500 btn-ghost" />
                </div>
            @endscope
        </x-table>

        {{-- Modal create --}}
        <x-modal wire:model="showModal" persistent class="backdrop-blur" separator>
            @if ($headerEdit == false)
                <x-header title="Tambah" size="text-2xl" subtitle="Tahun Ajaran" separator progress-indicator />
            @else
                <x-header title="Edit" size="text-2xl" subtitle="Tahun Ajaran" separator progress-indicator />
            @endif
            <x-form wire:submit="simpan" x-data="{ kode_ta: 'TA', tahun_ajaran1: '', tahun_ajaran2: '' }">
                <div class="mb-4">
                    <x-input x-bind:value="`${kode_ta}${tahun_ajaran1}${tahun_ajaran2}`" wire:model="form.kode_ta" label="ID Tahun Ajaran" />
                </div>
                <div class="grid grid-cols-1 gap-4 items-end lg:grid-cols-2">
                    <x-input x-model="tahun_ajaran1" wire:model="form.tahun_ajaran1" label="Tahun Ajaran" />
                    <x-input x-model="tahun_ajaran2" wire:model="form.tahun_ajaran2" />
                </div>
                <x-select label="Semester" wire:model.live="form.semester" :options="$sm" placeholder="Pilih Semester" placeholder-value="0" />
                <x-slot:actions>
                    <x-button label="Cancel" @click="$wire.showModal = false" />
                    <x-button label="Simpan" type="submit" class="btn-success text-white" spinner="simpan" />
                </x-slot:actions>
            </x-form>
        </x-modal>
    </div>
</div>
