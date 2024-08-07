<div class="p-6">
    <x-toastr />
    <x-confirm-deleted />

    <x-header title="Data Nilai" subtitle="Dashboard / Nilai / Raport">
        <x-slot:actions>
            <x-input icon="o-magnifying-glass" placeholder="Search..." />
        </x-slot:actions>
    </x-header>

    <div class="mb-6 flex items-center space-x-6 bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
        <div class="flex-shrink-0">
            <img class="w-24 h-24 rounded-full object-cover border-2 border-gray-300 dark:border-gray-600 shadow-md" src="{{ $rombel->siswa->foto ?? asset('assets/img/empty-user.png') }}" alt="Foto">
        </div>
        <div class="flex-1">
            <div class="grid grid-cols-2">
                <div>
                    <p class="text-lg font-semibold text-gray-900">Nama:</p>
                    <p class="text-base text-gray-600">{{$rombel->siswa->nama}}</p>
                </div>
                <div>
                    <p class="text-lg font-semibold text-gray-900">Kelas:</p>
                    <p class="text-base text-gray-600">{{$rombel->waliKelas->kelas->nama_kelas}}</p>
                </div>
                <div>
                    <p class="text-lg font-semibold text-gray-900">NIS:</p>
                    <p class="text-base text-gray-600">{{$rombel->siswa->nisn}}</p>
                </div>
                <div>
                    <p class="text-lg font-semibold text-gray-900">Tahun Ajaran:</p>
                    <p class="text-base text-gray-600">{{$rombel->waliKelas->TahunAjaran->tahun_ajaran}} - {{$rombel->waliKelas->TahunAjaran->semester}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-6">
        <ol class="flex items-center w-full p-3 space-x-2 text-sm font-medium text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 sm:p-4 sm:space-x-4 rtl:space-x-reverse">
            @foreach ($steps as $step => $label)
                <li class="flex items-center {{ $currentStep == $step ? 'text-blue-600 dark:text-blue-500' : 'text-gray-500 dark:text-gray-400' }} space-x-2.5 rtl:space-x-reverse">
                    <span class="flex items-center justify-center w-8 h-8 border {{ $currentStep == $step ? 'border-blue-600 dark:border-blue-500' : 'border-gray-500 dark:border-gray-400' }} rounded-full shrink-0">
                        {{ $step }}
                    </span>
                    <span>
                        <h3 class="font-bold leading-tight">{{ $label['title'] }}</h3>
                        <p class="text-sm">{{ $label['details'] }}</p>
                    </span>
                    @if ($step < count($steps))
                        <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                        </svg>
                    @endif
                </li>
            @endforeach
        </ol>
    </div>

    <div class="bg-white rounded-md border border-gray-100 shadow-md shadow-black/5">
        <div class="p-6">
            @if ($currentStep == 1)
                <ul class="mb-4 bg-white rounded-md border border-gray-100 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <li class="p-4 sm:p-6 bg-gray-100 rounded-lg shadow-lg dark:bg-gray-900 dark:border-gray-600 mb-4 last:mb-0">
                        <div class="flex flex-col sm:flex-row items-start space-y-4 sm:space-y-0 sm:space-x-8 rtl:space-x-reverse">
                            <div class="flex-1 min-w-50">
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                    Predikat
                                </p>
                                <p class="text-base text-gray-900 dark:text-white">
                                    Sikap Spritual dan Sosial
                                </p>
                            </div>
                            <div class="flex-1 mt-4 sm:mt-0">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    <div class="flex flex-col">
                                        <label for="nilai_ki1"class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-200">Spritual (KI 1)</label>
                                        <select id="nilai_ki1" wire:model="nilai_ki1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option selected>Pilih Predikat</option>
                                            <option value="Sangat Baik">Sangat Baik</option>
                                            <option value="Baik">Baik</option>
                                            <option value="Cukup Baik">Cukup Baik</option>
                                            <option value="Kurang Baik">Kurang Baik</option>
                                        </select>                                    
                                    </div>
                                    <div class="flex flex-col">
                                        <label for="nilai_ki2"class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-200">Sosial (KI 2)</label>
                                        <select id="nilai_ki2" wire:model="nilai_ki2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option selected>Pilih Predikat</option>
                                            <option value="Sangat Baik">Sangat Baik</option>
                                            <option value="Baik">Baik</option>
                                            <option value="Cukup Baik">Cukup Baik</option>
                                            <option value="Kurang Baik">Kurang Baik</option>
                                        </select>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

                <ul class="bg-white rounded-md border border-gray-100 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <li class="p-4 sm:p-6 bg-gray-100 rounded-lg shadow-lg dark:bg-gray-900 dark:border-gray-600 mb-4 last:mb-0">
                        <div class="flex flex-col sm:flex-row items-start space-y-4 sm:space-y-0 sm:space-x-8 rtl:space-x-reverse">
                            <div class="flex-1 min-w-50">
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                    Deskripsi
                                </p>
                                <p class="text-base text-gray-900 dark:text-white">
                                    Sikap Spritual dan Sosial
                                </p>
                            </div>
                            <div class="flex-1 mt-4 sm:mt-0">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                        <div class="flex flex-col">
                                            <label for="deskripsi_ki3" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Pengetahuan (KI 3)</label>
                                            <textarea id="deskripsi_ki3" wire:model="deskripsi_ki1" rows="4" class="mt-1 block w-full p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..." required></textarea>
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="deskripsi_ki4" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Keterampilan (KI 4)</label>
                                            <textarea id="deskripsi_ki4" wire:model="deskripsi_ki2" rows="4" class="mt-1 block w-full p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..." required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            @elseif ($currentStep == 2)
                <ul class="bg-white rounded-md border border-gray-100 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    @forelse ($nilai as $index => $nilai)
                        @if(is_array($nilai))
                            <li class="p-4 sm:p-6 bg-gray-100 rounded-lg shadow-lg dark:bg-gray-900 dark:border-gray-600 mb-4 last:mb-0">
                                <div class="flex flex-col sm:flex-row items-start space-y-4 sm:space-y-0 sm:space-x-8 rtl:space-x-reverse">
                                    <div class="flex-1 min-w-50">
                                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                            {{ $nilai['mapel'] }}
                                        </p>
                                    </div>
                                    <div class="flex-1 mt-4 sm:mt-0">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                            <div class="flex flex-col">
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Pengetahuan (KI 3)</label>
                                                <input type="text" wire:model="nilai.{{ $index }}.nilai_ki3" class="mt-1 block w-full bg-white border border-gray-300 text-gray-900 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                                            </div>
                                            <div class="flex flex-col">
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Keterampilan (KI 4)</label>
                                                <input type="text" wire:model="nilai.{{ $index }}.nilai_ki4" class="mt-1 block w-full bg-white border border-gray-300 text-gray-900 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @else
                            <li class="py-3 sm:py-4">
                                <div class="bg-red-100 p-4 rounded-lg border border-red-300 dark:bg-red-800 dark:border-red-600 shadow-md">
                                    <span class="text-red-700 dark:text-red-200">Data tidak valid</span>
                                </div>
                            </li>
                        @endif
                    @empty
                        <li class="py-3 sm:py-4">
                            <div class="bg-yellow-100 p-4 rounded-lg border border-yellow-300 dark:bg-yellow-800 dark:border-yellow-600 shadow-md">
                                <span class="text-yellow-700 dark:text-yellow-200">Data Mata Pelajaran belum diisi</span>
                            </div>
                        </li>
                    @endforelse
                </ul>
            @elseif ($currentStep == 3)
                <ul class="bg-white rounded-md border border-gray-100 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    @forelse ($nilai as $index => $nilai)
                        @if(is_array($nilai))
                            <li class="p-4 sm:p-6 bg-gray-100 rounded-lg shadow-lg dark:bg-gray-900 dark:border-gray-600 mb-4 last:mb-0">
                                <div class="flex flex-col sm:flex-row items-start space-y-4 sm:space-y-0 sm:space-x-8 rtl:space-x-reverse">
                                    <div class="flex-1 min-w-50">
                                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                            {{ $nilai['mapel'] }}
                                        </p>
                                    </div>
                                    <div class="flex-1 mt-4 sm:mt-0">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                            <div class="flex flex-col">
                                                <label for="deskripsi_ki3" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Pengetahuan (KI 3)</label>
                                                <textarea id="deskripsi_ki3" wire:model="nilai.{{ $index }}.deskripsi_ki3" rows="4" class="mt-1 block w-full p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..." required></textarea>
                                            </div>
                                            <div class="flex flex-col">
                                                <label for="deskripsi_ki4" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Keterampilan (KI 4)</label>
                                                <textarea id="deskripsi_ki4" wire:model="nilai.{{ $index }}.deskripsi_ki4" rows="4" class="mt-1 block w-full p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..." required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @else
                            <li class="py-3 sm:py-4">
                                <div class="bg-red-100 p-4 rounded-lg border border-red-300 dark:bg-red-800 dark:border-red-600 shadow-md">
                                    <span class="text-red-700 dark:text-red-200">Data tidak valid</span>
                                </div>
                            </li>
                        @endif
                    @empty
                        <li class="py-3 sm:py-4">
                            <div class="bg-yellow-100 p-4 rounded-lg border border-yellow-300 dark:bg-yellow-800 dark:border-yellow-600 shadow-md">
                                <span class="text-yellow-700 dark:text-yellow-200">Data Mata Pelajaran belum diisi</span>
                            </div>
                        </li>
                    @endforelse
                </ul>
                @elseif ($currentStep == 4)
                <x-button icon="o-plus" wire:click.prevent="addItemEkskul" label="Tambah Kegiatan" class="self-center text-white bg-blue-500" />
                @foreach($ekstrakulikuler as $index => $value)
                    <ul class="my-4 bg-white rounded-md border border-gray-100 shadow-md dark:bg-gray-800 dark:border-gray-700">
                        <li class="p-4 sm:p-6 bg-gray-100 rounded-lg shadow-lg dark:bg-gray-900 dark:border-gray-600 mb-4 last:mb-0">
                            <div class="flex flex-col sm:flex-row items-start space-y-4 sm:space-y-0 sm:space-x-8 rtl:space-x-reverse">
                                <div class="flex-1 min-w-50">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Bentuk Kegiatan</label>
                                    <div class="flex space-x-4">
                                        <input type="text" wire:model="ekstrakulikuler.{{ $index }}" class="mt-1 block w-full bg-white border border-gray-300 text-gray-900 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                                        <x-button icon="o-trash" wire:click.prevent="removeItemEkskul({{ $index }})" class="self-center btn-sm text-white bg-red-500" />
                                    </div>
                                </div>
                                <div class="flex-1 mt-4 sm:mt-0">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                        <div class="flex flex-col">
                                            <label for="predikat_{{ $index }}" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-200">Predikat</label>
                                            <select id="predikat_{{ $index }}" wire:model="predikat_ekstrakulikuler.{{ $index }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option selected>Pilih Predikat</option>
                                                <option value="Sangat Baik">Sangat Baik</option>
                                                <option value="Baik">Baik</option>
                                                <option value="Cukup Baik">Cukup Baik</option>
                                                <option value="Kurang Baik">Kurang Baik</option>
                                            </select> 
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="deskripsi_{{ $index }}" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Deskripsi</label>
                                            <textarea id="deskripsi_{{ $index }}" wire:model="deskripsi_ekstrakulikuler.{{ $index }}" rows="4" class="mt-1 block w-full p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..." required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                @endforeach
                @elseif ($currentStep == 5)
                 <x-button icon="o-plus" wire:click.prevent="addItemPrestasi" label="Tambah Kegiatan" class="self-center text-white bg-blue-500" />
                @foreach($prestasi as $index => $value)
                    <ul class="my-4 bg-white rounded-md border border-gray-100 shadow-md dark:bg-gray-800 dark:border-gray-700">
                        <li class="p-4 sm:p-6 bg-gray-100 rounded-lg shadow-lg dark:bg-gray-900 dark:border-gray-600 mb-4 last:mb-0">
                            <div class="flex flex-col sm:flex-row items-start space-y-4 sm:space-y-0 sm:space-x-8 rtl:space-x-reverse">
                                <div class="flex-1 min-dw-50">
                                    <div class="flex space-x-4">
                                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Prestasi
                                        </p>
                                        <x-button icon="o-trash" wire:click.prevent="removeItemPrestasi({{ $index }})" class="self-center btn-sm text-white bg-red-500" />
                                    </div>
                                </div>
                                <div class="flex-1 mt-4 sm:mt-0">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                        <div class="flex flex-col">
                                            <label for="predikat_{{ $index }}" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-200">Predikat</label>
                                            <input type="text" wire:model="prestasi.{{ $index }}" class="mt-1 block w-full bg-white border border-gray-300 text-gray-900 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="deskripsi_{{ $index }}" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Deskripsi</label>
                                            <textarea id="deskripsi_{{ $index }}" wire:model="deskripsi_prestasi.{{ $index }}" rows="4" class="mt-1 block w-full p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..." required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                @endforeach
                @elseif ($currentStep == 6)
                <ul class="bg-white rounded-md border border-gray-100 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <li class="p-4 sm:p-6 bg-gray-100 rounded-lg shadow-lg dark:bg-gray-900 dark:border-gray-600 mb-4 last:mb-0">
                        <div class="flex flex-col sm:flex-row items-start space-y-4 sm:space-y-0 sm:space-x-8 rtl:space-x-reverse">
                            <div class="flex-1 min-w-50">
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                    Catatan
                                </p>
                                <p class="text-base text-gray-900 dark:text-white">
                                    Wali Kelas
                                </p>
                            </div>
                            <div class="flex-1 mt-4 sm:mt-0">
                                <div class="grid lg:grid-cols-1 sm:grid-cols-2 gap-6">
                                    <textarea wire:model="catatan" rows="4" class="mt-1 block w-full p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..." required></textarea>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="bg-white rounded-md border border-gray-100 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <li class="p-4 sm:p-6 bg-gray-100 rounded-lg shadow-lg dark:bg-gray-900 dark:border-gray-600 mb-4 last:mb-0">
                        <div class="flex flex-col sm:flex-row items-start space-y-4 sm:space-y-0 sm:space-x-8 rtl:space-x-reverse">
                            <div class="flex-1 min-w-50">
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                    Keterangan
                                </p>
                                <p class="text-base text-gray-900 dark:text-white">
                                    Wali Kelas
                                </p>
                            </div>
                            <div class="flex-1 mt-4 sm:mt-0">
                                <div class="grid lg:grid-cols-1 sm:grid-cols-2 gap-6">
                                <select wire:model="keterangan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Pilih Predikat</option>
                                    <option value="Naik">Naik</option>
                                    <option value="Tinggal">Tinggal</option>
                                </select>                                
                            </div>
                        </div>
                    </li>
                </ul>
            @endif
        </div>

        <div class="flex justify-between p-6">
            @if ($currentStep > 1)
                <x-button wire:click="prevStep" label="Sebelumnya" class="text-white bg-gray-500" spinner />
            @endif

            @if ($currentStep > 5)
                <x-button wire:click="simpan" label="Simpan" class="text-white bg-green-500" spinner />
            @endif

            @if ($currentStep < count($steps))
                <x-button wire:click="nextStep" label="Selanjutnya" class="text-white bg-blue-500" spinner />
            @endif
        </div>
    </div>
</div>
