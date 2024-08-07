<div class="p-6">
    <x-toastr/>
    <x-confirm-deleted/>
    
    <x-header title="Rombongan Belajar" subtitle="Dashoboard / Rombel">
        <x-slot:middle class="!justify-end">
            <x-input icon="o-magnifying-glass"  placeholder="Search..." />
        </x-slot:middle>
        <x-slot:actions>
            <x-button icon="o-funnel" label="filter" wire:click="$toggle('showFilters')" class="btn-sm"/>
        </x-slot:actions>
    </x-header>
    <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5 ">
        <x-table :headers="$headers" :rows="$tampil" with-pagination>
            @scope('header_id', $header)
                <h3 class="text-lg font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">
                    {{ $header['label'] }}
                </h3> 
            @endscope
            @scope('header_id_wl', $header)
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
            @scope('header_jumlah_siswa', $header)
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
            <strong>{{ $this->loop->iteration}}</strong>   
            @endscope
            @scope('cell_guru_id', $tampil)
            {{ $tampil->guru->nama}}
            @endscope
            @scope('cell_kelas_id', $tampil)
            {{ $tampil->kelas->nama_kelas}}  ({{$tampil->kelas->kode_kelas}})
            @endscope
              @scope('cell_jumlah_siswa', $tampil)
            {{ $tampil->jumlah_siswa}} Siswa
            @endscope
            @scope('cell_ta_id', $tampil)
            {{ $tampil->tahunAjaran->tahun_ajaran}} ({{ $tampil->tahunAjaran->semester}})
            @endscope
            @scope('actions', $tampil)
            <div class="flex justify-start" >
                <x-button icon="s-table-cells" link="/rombel/{{$tampil->id}}/anggota" spinner class="btn-xs text-green-400 btn-ghost" no-wire-navigate />
            </div>
            @endscope
        </x-table>

        <x-drawer wire:model="showFilters" title="Filters" subtitle="Data Siswa" separator with-close-button class="w-11/12 lg:w-1/3" right>
            <div>
                <x-select label="Tahun Ajaran" wire:model.live="filtersTa" :options="$tahun_ajaran" placeholder="Semua Tahun Ajaran" placeholder-value="0"/>
            </div>
        
            <x-slot:actions>
                <x-button label="Tutup" class="btn-primary" icon="o-check" @click="$wire.showFilters = false" />
            </x-slot:actions>
        </x-drawer>
        
    </div>
</div>