<div class="p-6">
    <x-toastr/>
    <x-confirm-deleted/>
    
    <x-header title="Rombongan Belajar" subtitle="Dashboard / Rombel">
        <x-slot:actions>
            <x-button wire:navigate href="{{ route('siswa') }}" icon="o-arrow-left" class="btn-sm bg-red-500 text-white hover:bg-red-800">
                Kembali
            </x-button>
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
                <td class="w-1/5">Jumlah Siswa</td>
                <td class="w-1/5">: {{ $jumlah_siswa }}</td>
            </tr>
        </table>
    </div>

    <x-header>
        <x-slot:middle class="!justify-end">
            <x-button icon="o-plus" class="text-white bg-blue-500 btn-sm" spinner label="Tambah" @click="$wire.showModal = true" />
            <div class="relative inline-block text-right">
                @if ($wali_kelas && ($wali_kelas->tahunAjaran->semester === "Genap") && $upWali_kelas->isNotEmpty()) 
                    <x-button icon="s-arrow-small-up" id="dropdownButton" class="text-white bg-green-500 btn-sm" spinner label="Naik Kelas" />
                    <div id="dropdownMenu" class="hidden absolute right-0 bg-white p-2 mt-2 rounded shadow-md z-50 w-24">
                        @if ($upWali_kelas->isNotEmpty())
                            @foreach ($upWali_kelas as $row)
                                @if ($row->tahunAjaran->semester === "Ganjil")
                                    <button wire:click="upClass({{ $row->id }})" class="bg-green-500 btn-sm text-white px-4 py-2 mt-2 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 w-full text-left">
                                        {{ $row->kelas->nama_kelas }}
                                    </button>
                                @endif
                            @endforeach
                        @endif
                    </div>  
                @elseif($wali_kelas && ($wali_kelas->tahunAjaran->semester === "Ganjil") && $newWali_kelas->isNotEmpty())
                    <x-button icon="s-arrow-small-up" id="dropdownButton" class="text-white bg-green-500 btn-sm" spinner label="Naik Semester" />
                    <div id="dropdownMenu" class="hidden absolute right-0 bg-white p-2 mt-2 rounded shadow-md z-50 w-24">
                        @if ($newWali_kelas->isNotEmpty())
                            @foreach ($newWali_kelas as $row)
                                @if ($row->tahunAjaran->semester === "Genap")
                                    <button wire:click="upSemester({{ $row->id }})" class="bg-green-500 btn-sm text-white px-4 py-2 mt-2 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 w-full text-left">
                                        {{ $row->kelas->nama_kelas }}
                                    </button>
                                @endif
                            @endforeach
                        @endif
                    </div>                    
                @endif
            </div>
        </x-slot:middle>
        <x-slot:actions>
            <x-input icon="o-magnifying-glass" placeholder="Search..." />
        </x-slot:actions>
    </x-header>

    <div class="mt-3 bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
        <x-table :headers="$headers" :rows="$tampil" with-pagination selectable wire:model="selected" @row-selection="console.log($event.detail)">
            @scope('header_id', $header)
                <h3 class="text-lg font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">
                    {{ $header['label'] }}
                </h3>
            @endscope
            @scope('header_nis', $header)
                <h3 class="text-lg font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">
                    {{ $header['label'] }}
                </h3>
            @endscope
            @scope('header_nama_siswa', $header)
                <h3 class="text-lg font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">
                    {{ $header['label'] }}
                </h3>
            @endscope
            @scope('header_kelas_siswa', $header)
                <h3 class="text-lg font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">
                    {{ $header['label'] }}
                </h3>
            @endscope
            @scope('cell_id', $tampil)
                <strong>{{ $this->loop->iteration }}</strong>
            @endscope
            @scope('cell_nis', $tampil)
                {{ $tampil->siswa->nisn }}
            @endscope
            @scope('cell_nama_siswa', $tampil)
                {{ $tampil->siswa->nama }}
            @endscope
            @scope('cell_kelas_siswa', $tampil)
                {{ $tampil->WaliKelas->kelas->nama_kelas }}
            @endscope
            @scope('actions', $tampil)
                <div class="flex justify-start">
                    <x-button icon="o-trash" @click="$wire.dispatch('confirm-delete', { get_id: '{{ $tampil->id }}' })" class="btn-xs text-red-500 btn-ghost" />
                </div>
            @endscope
        </x-table>

        <!-- Main modal -->
<div x-data="{ open: @entangle('showModal') }" x-show="open" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-75 backdrop-blur" style="display: none;">
    <div class="relative p-4 w-full max-w-6xl max-h-full bg-white rounded-lg shadow-lg dark:bg-gray-700">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Tambah Data Rombel Siswa</h3>
            <button @click="$wire.showModal = false" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <!-- Modal body -->
        <div class="p-4 md:p-5 space-y-4">
            <x-button icon="o-plus" class="text-white bg-blue-500 btn-sm" spinner label="Tambah" wire:click="moveSelectedRows" />
            <div class="grid grid-cols-2 gap-6">
                <div class="py-4">
                    <h5 class="ml-2 mb-4 text-sm font-bold">Data Siswa</h5>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg h-80">
                        <div class="py-4">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" id="table-siswa">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3"></th>
                                        <th scope="col" class="px-6 py-3">#</th>
                                        <th scope="col" class="px-6 py-3">NIS</th>
                                        <th scope="col" class="px-6 py-3">Nama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($table1 as $index => $row)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4">
                                                <input type="checkbox" class="checkbox-row" wire:model="selectedRows" value="{{ $index }}">
                                            </td>
                                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                            <td class="px-6 py-4">{{ $row['nis'] }}</td>
                                            <td class="px-6 py-4">{{ $row['data'] }}</td>
                                        </tr>
                                    @empty
                                        <tr><td class="px-6 py-4" colspan="4">Semua Siswa Punya Rombel</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="py-4">
                    <h5 class="ml-2 mb-4 text-sm font-bold">Tambah Data Siswa</h5>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg h-80">
                        <div class="py-4">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" id="table-siswa-2">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">#</th>
                                        <th scope="col" class="px-6 py-3">NIS</th>
                                        <th scope="col" class="px-6 py-3">Nama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($table2 as $index => $row)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                            <td class="px-6 py-4">{{ $row['nis'] }}</td>
                                            <td class="px-6 py-4">{{ $row['data'] }}</td>
                                        </tr>
                                    @empty
                                        <tr><td class="px-6 py-4" colspan="4">Silahkan Masukkan Data</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal footer -->
        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
            <x-button label="Simpan" wire:click="saveMovedRows" class="btn-success text-white mr-4" spinner="simpan" />
            <x-button label="Cancel" @click="$wire.showModal = false" />
        </div>
    </div>
</div>

    </div>
</div>

@script
<script>
    document.getElementById('dropdownButton').addEventListener('click', function() {
        var menu = document.getElementById('dropdownMenu');
        menu.classList.toggle('hidden');
    });

    // Optional: Close the dropdown if clicked outside
    window.addEventListener('click', function(event) {
        var menu = document.getElementById('dropdownMenu');
        var button = document.getElementById('dropdownButton');
        if (!button.contains(event.target) && !menu.contains(event.target)) {
            menu.classList.add('hidden');
        }
    });
</script>
@endscript
