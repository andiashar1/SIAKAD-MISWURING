<div class="p-6">
    <x-toastr/>
    <x-confirm-deleted/>
    
    <x-header title="Data Presensi" subtitle="Dashoboard / Presensi / Input">
        <x-slot:actions>
            <x-input icon="o-magnifying-glass" placeholder="Search..." />
        </x-slot:actions>
    </x-header>
    <div class="grid grid-cols-3 gap-4">
        <div class="h-min bg-white rounded-md border border-gray-100 shadow-md shadow-black/5">
            <div class="relative overflow-x-auto sm:rounded-lg">
                <table class="w-full text-left text-base">
                    <colgroup>
                        <col span="1" style="width: 20%;">
                        <col span="1" style="width: 5%;">
                        <col span="1" style="width: 75%;">
                    </colgroup>
                    <thead class="text-xs text-white uppercase bg-cyan-500 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th colspan="3" class="px-4 py-3">{{ $japel->mapel->nama_mapel }}</th>
                        </tr>
                    </thead>
                    <tbody>
                         <tr class="border-b-2 border-gray-200">
                            <td class="px-4 py-3">Guru</td>
                            <td class="w-1">:</td>
                            <td>{{ $japel->guru->nama }}</td>
                        </tr>
                        <tr class="border-b-2 border-gray-200">
                            <td class="px-4 py-3">Kelas</td>
                            <td class="w-1">:</td>
                            <td>{{ $japel->kelas->nama_kelas }}</td>
                        </tr>
                        <tr class="border-b-2 border-gray-200">
                            <td class="px-4 py-3">Hari</td>
                            <td class="w-1">:</td>
                            <td>{{ $hari }}</td>
                        </tr>
                        <tr class="border-b-2 border-gray-200">
                            <td class="px-4 py-3">Jam</td>
                            <td class="w-1">:</td>
                            <td>{{ $jam }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-span-2 bg-white rounded-md border border-gray-100 shadow-md shadow-black/5 ">
            <x-form wire:submit="simpan">
                <div class="relative overflow-x-auto sm:rounded-lg">
                    <table class="w-full text-md text-left rtl:text-right text-gray-500 dark:text-gray-400" id="table-siswa">
                        <thead class="text-xs text-white uppercase bg-cyan-500 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th  scope="col" class="px-4 py-3 w-2">No</th>
                                <th  scope="col" class="px-4 py-3">NISN</th>
                                <th  scope="col" class="px-4 py-3">Nama</th>
                                <th  scope="col" class="px-4 py-3">Presensi</th>
                            </tr>
                        </thead>
                        <tbody class="text-black">
                        @forelse ($presensi as $index => $presensi)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="border px-4 py-2">{{ $loop->iteration}}</td>
                                <td class="border px-4 py-2">{{ $presensi['nisn'] }}</td>
                                <td class="border px-4 py-2">{{ $presensi['nama'] }}</td>
                                <td class="border px-4 py-2 w-40">
                                      <select id="small" wire:model="presensi.{{ $index }}.presensi" class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected>Presensi</option>
                                        <option value="hadir"> Hadir</option>
                                        <option value="alpa">Alpa</option>
                                        <option value="izin">Izin</option>
                                        <option value="sakit">Sakit</option>
                                    </select>
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
</div>
