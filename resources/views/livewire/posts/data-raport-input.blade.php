<div class="p-6">
    <x-toastr/>
    <x-confirm-deleted/>
    
    <x-header title="Jadwal Pelajaran" subtitle="Dashoboard / Jadwal Pelajaran / Tambah">
        <x-slot:actions>
            <x-button wire:navigate href="{{ route('siswa')}}" icon="o-arrow-left" class="btn-sm bg-red-500 text-white hover:bg-red-800" > Kembali </x-button>
        </x-slot:actions>
    </x-header>
    <div class="mb-4 bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5 ">
        <table class="table-fixed w-full font-bold">
            <tr>
                <td class="w-1/5">Kelas</td>
                <td class="w-2/5">: {{ $siswa->kelas->nama_kelas }}</td>
                <td class="w-1/5">Tahun Ajaran</td>
                <td class="w-1/5">: {{ $siswa->tahunAjaran->tahun_ajaran }} ({{ $siswa->tahunAjaran->semester}})</td>
            </tr>
            <tr>
                <td class="w-1/5">Wali Kelas</td>
                <td class="w-2/5">: {{ $siswa->guru->nama }} </td>
            </tr>
        </table>
    </div>
    <x-header>
        <x-slot:middle class="!justify-end">
            <x-button icon="o-plus" class="text-white  bg-blue-500 btn-sm" spinner label="Tambah"  @click="$wire.showModal = true" />
        </x-slot:middle>
        <x-slot:actions>
            <x-input icon="o-magnifying-glass" placeholder="Search..." />
        </x-slot:actions>
    </x-header>
        <div class="bg-white rounded-md border border-gray-100 shadow-md shadow-black/5 ">
            <x-form wire:submit="simpan">
                <div class="relative overflow-x-auto sm:rounded-lg">
                    <table class="w-full text-md text-left rtl:text-right text-gray-500 dark:text-gray-400" id="table-siswa">
                        <thead class="text-xs text-white uppercase bg-cyan-500 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th  scope="col" class="px-4 py-3 w-2">No</th>
                                <th  scope="col" class="px-4 py-3">NISN</th>
                                <th  scope="col" class="px-4 py-3">Nama</th>
                                <th  scope="col" class="px-4 py-3">Pengetahuan (KI 3)</th>
                                <th  scope="col" class="px-4 py-3">Keterampilan (KI 4)</th>
                                <th  scope="col" class="px-4 py-3">Deskripsi (KI 3)</th>
                                <th  scope="col" class="px-4 py-3">Deskripsi (KI 4)</th>
                            </tr>
                        </thead>
                        <tbody class="text-black">
                        @forelse ($nilai as $index => $nilai)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="border px-4 py-2">{{ $loop->iteration}}</td>
                                <td class="border px-4 py-2">{{ $nilai['nisn'] }}</td>
                                <td class="border px-4 py-2">{{ $nilai['nama'] }}</td>
                                <td class="border px-4 py-2 w-20">
                                    <input type="text" wire:model="nilai.{{ $index }}.nilai_k3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-5 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                                </td>
                                <td class="border px-4 py-2 w-20">
                                    <input type="text" wire:model="nilai.{{ $index }}.nilai_k4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-5 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                                </td>
                                <td class="border px-4 py-2 w-40">
                                    <textarea id="message" rows="4" wire:model="nilai.{{ $index }}.deskripsi_k3" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>
                                </td>
                                <td class="border px-4 py-2 w-40">
                                    <textarea id="message" rows="4" wire:model="nilai.{{ $index }}.deskripsi_k4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>
                                </td>
                            </tr>
                        @empty
                            <tr><td class="px-6 py-4" colspan="4">Data Mata Pelajaran belum diisi </td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-end gap-4 -mt-4 p-4">
                    <x-button label="Input" class="bg-green-500 text-white" type="submit" spinner="simpan" />
                </div>
            </x-form>
        </div>
    </div>
</div>
