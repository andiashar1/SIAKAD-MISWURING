<div class="p-6">
    <x-toastr/>
    <x-confirm-deleted/>
    
    <x-header title="Data Presensi" subtitle="Dashoboard / Presensi"></x-header>
    <div class="bg-white rounded-md border border-gray-100 py-4 px-6 shadow-md shadow-black/5 ">
        <x-header title="Form Input Presensi" size="text-md" separator progress-indicator />
        <x-form>
            <div class="grid grid-cols-1 gap-4 items-end lg:grid-cols-2">
                <div wire:ignore>
                    <select 
                        x-init="$($el).select2({
                            width: '100%',
                            placeholder: 'Pilih Tahun Ajaran'
                        }).on('change', function (e) {
                            $wire.set('ta_id', e.target.value);
                        });"
                        wire:model="ta_id" 
                        id="ta-select" 
                        class="form-control">
                        <option value="">Pilih Tahun Ajaran</option>
                        @foreach($tahun_ajaran as $key => $option)
                            <option value="{{ $key }}">{{ $option }}</option>
                        @endforeach
                    </select>
                </div>

                <div wire:ignore>
                    <select 
                        x-init="$($el).select2({
                            width: '100%',
                            placeholder: 'Pilih Kelas'
                        }).on('change', function (e) {
                            $wire.set('kelas_id', e.target.value);
                        });"
                        wire:model="kelas_id" 
                        id="kelas-select" 
                        class="form-control">
                        <option value="">Pilih Kelas</option>
                        @foreach($kelas as $key => $option)
                            <option value="{{ $key }}">{{ $option }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="flex justify-left gap-4">
                    <x-button label="Input" class="btn-primary btn-sm" wire:click="tampilMapel" spinner />
                    <x-button label="Reset" class="btn-sm"/>
                </div>
                <x-datepicker label="Date" wire:model="hari" icon="o-calendar" hint="Hi!" />
            </div>
        </x-form>
    </div>
      
    @if (!empty($presensi))
        <x-form wire:submit="simpan">
            <div class="mt-4 relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full h-40 text-md text-left rtl:text-right text-gray-500 dark:text-gray-400" id="table-siswa">
                    <thead class="text-xs text-white uppercase bg-cyan-500 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th  scope="col" class="px-4 py-3 w-2">No</th>
                            <th  scope="col" class="px-4 py-3">NISN</th>
                            <th  scope="col" class="px-4 py-3">Nama</th>
                            <th  scope="col" class="px-4 py-3">Nilai</th>
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
            <div class="flex justify-end gap-4 mt-4 ">
                <x-button label="Input" class="bg-green-500 text-white" type="submit" spinner="simpan" />
            </div>
        </x-form>
    @endif
</div>
