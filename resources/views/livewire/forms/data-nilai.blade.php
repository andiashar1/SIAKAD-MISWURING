<div class="p-6">
    <x-toastr/>
    <x-confirm-deleted/>
    
    <x-header title="Data Nilai" subtitle="Dashoboard / Nilai"></x-header>
    <div class="bg-white rounded-md border border-gray-100 py-4 px-6 shadow-md shadow-black/5 ">
        <x-header title="Form Input Nilai" size="text-md" separator progress-indicator />
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
            </div>
        </x-form>
    </div>
    
    @if (!empty($japel))
        <x-form wire:submit="simpan">
            <div class="mt-4 relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-md text-left rtl:text-right text-gray-500 dark:text-gray-400" id="table-siswa">
                    <thead class="text-xs text-white uppercase bg-cyan-500 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th  scope="col" class="px-4 py-3 w-2">No</th>
                            <th  scope="col" class="px-4 py-3">NISN</th>
                            <th  scope="col" class="px-4 py-3">Nama</th>
                            <th  scope="col" class="px-4 py-3">Nilai</th>
                        </tr>
                    </thead>
                    <tbody class="text-black">
                    @forelse ($japel as $index => $japel)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="border px-4 py-2">{{ $loop->iteration}}</td>
                            <td class="border px-4 py-2">{{ $japel['nisn'] }}</td>
                            <td class="border px-4 py-2">{{ $japel['nama'] }}</td>
                            <td class="border px-4 py-2 w-40">
                                <x-button icon="s-pencil-square" label="Input Nilai" link="/nilai/{{ $japel['id'] }}/input" class="btn-xs text-cyan-500 btn-ghost" no-wire-navigate />    
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
      
    {{-- @if (!empty($jadwal))
        <div class="mt-4 relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-md text-left rtl:text-right text-gray-500 dark:text-gray-400" id="table-siswa">
            <thead class="text-xs text-white uppercase bg-cyan-500 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th  scope="col" class="px-4 py-3 w-2">No</th>
                    <th  scope="col" class="px-4 py-3">ID</th>
                    <th  scope="col" class="px-4 py-3">Mata Pelajaran</th>
                    <th  scope="col" class="px-4 py-3 w-40">Action</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($jadwal as $mapel)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="border px-4 py-2">{{ $loop->iteration}}</td>
                    <td class="border px-4 py-2">{{ $mapel->mapel->kode_mapel }}</td>
                    <td class="border px-4 py-2">{{ $mapel->mapel->nama_mapel }}</td>
                    <td class="border px-4 py-2 w-40">
                        <x-button icon="s-pencil-square" label="Input Nilai" link="/nilai/{{$mapel->id}}/input" class="btn-xs text-cyan-500 btn-ghost" no-wire-navigate />    
                    </td>
                </tr>
            @empty
                <tr><td class="px-6 py-4" colspan="4">Data Mata Pelajaran belum diisi </td></tr>
            @endforelse
            </tbody>
        </table>
        </div>
    @endif --}}
</div>
