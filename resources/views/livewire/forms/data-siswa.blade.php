<div class="p-6">
    <x-toastr/>
    <x-confirm-deleted/>
    <x-header title="Users" subtitle="Check this on mobile">
            <x-slot:middle class="!justify-end">
                <x-input icon="o-magnifying-glass" placeholder="Search..." />
            </x-slot:middle>
            <x-slot:actions>
                <x-button icon="o-funnel" label="filter" wire:click="$toggle('showFilters')" class="btn-sm"/>
                <x-button icon="o-plus" class="btn-primary btn-sm" link="{{ route('siswa.tambah')}}" no-wire-navigate />
            </x-slot:actions>
        </x-header>
    <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5 ">
        <x-table :headers="$headers" :rows="$tampil" with-pagination>
            @scope('cell_id', $tampil)
            <strong>{{ $this->loop->iteration}}</strong>   
            @endscope
            @scope('header_id', $header)
                <h3 class="text-sm font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">
                    {{ $header['label'] }}
                </h3> 
            @endscope
            @scope('header_nama', $header)
                <h3 class="text-sm font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">
                    {{ $header['label'] }}
                </h3> 
            @endscope
            @scope('header_nisn', $header)
                <h3 class="text-sm font-bold text-transparent bg-gradient-to-r from-sky-600 to-cyan-400 bg-clip-text">
                    {{ $header['label'] }}
                </h3> 
            @endscope
            @scope('cell_nama', $tampil)
            <div class="w-30 avatar">
                <div class="w-10 rounded-full border-2 border-blue-500">
                    <img src="{{asset('storage/'.$tampil->foto)}}"/> 
                </div>
            <span class=" ml-2 self-center"> {{$tampil->nama}}</span>
            </div>    
            @endscope
            @scope('actions', $user)
            <div class="flex justify-start" >
                <x-button icon="o-eye" wire:click="delete({{ $user->id }})" spinner class="btn-xs text-blue-700 btn-ghost" />
                <x-button icon="o-pencil-square" link="/siswa/{{$user->id}}/edit" spinner class="btn-xs text-amber-400 btn-ghost" no-wire-navigate/>    
                <x-button icon="o-trash" wire:click="$dispatch('confirm-delete', { get_id: '{{ $user->id }}' })" spinner class="btn-xs text-red-500 btn-ghost" />
            </div>
            @endscope
        </x-table>
        <!-- filter -->
        <x-drawer wire:model="showFilters" title="Filters" subtitle="Data Siswa" separator with-close-button class="w-11/12 lg:w-1/3" right>
            <div>
                <x-select label="Tahun Ajaran" :options="$agm" placeholder="Pilih Tahun Ajaran" placeholder-value="0" 
                hint="Select one, please." />
                <x-select label="Rombel" :options="$agm" placeholder="Pilih Rombongan Belajar" placeholder-value="0" 
                hint="Select one, please." />
            </div>
        
            <x-slot:actions>
                <x-button label="Cancel" @click="$wire.showFilters = false" />
                <x-button label="Confirm" class="btn-primary" icon="o-check" />
            </x-slot:actions>
        </x-drawer>
    </div>
</div>
@push('js')
<script>
        $(document).ready(function() {
            // Set toastr options
            toastr.options = {
                closeButton: false,
                newestOnTop: true,
                progressBar: true,
                positionClass: 'toast-top-right',
            };

            // Check if there's a toastr notification in the session
            @if(session('toastr'))
                // Display the toastr notification
                toastr["{{ session('toastr')['icon'] }}"]("{{ session('toastr')['message'] }}");
            @endif
        });
    </script>
@endpush
