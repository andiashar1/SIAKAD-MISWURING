<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/login');
    }
}; ?>


<div class="fixed left-0 top-0 w-64 h-full text-sm bg-white p-4 z-50 sidebar-menu transition-transform dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 flex flex-col">
    <!-- Header Sidebar -->
    <div class="mb-4">
        <a href="#" class="flex items-center pb-4 border-b border-b-gray-800">
            <img src="{{ asset('assets/img/logo_sekolah.jpg') }}" alt="" class="w-8 h-8 rounded object-cover">
            <div class="ml-3">
                <p class="text-sm font-bold text-gray-800">MIS Muhammadiyah</p>
                <p class="text-sm text-gray-800 -mt-1 -mb-1">Wuring</p>
            </div>
        </a>
    </div>

    <!-- Main Sidebar (Scrollable) -->
    <div class="flex-grow overflow-hidden w-64 hover:overflow-y-auto">
        <ul class="space-y-2 tracking-wide">
            <label class="font-bold text-transparent bg-gradient-to-r from-sky-700 to-cyan-500 bg-clip-text">Dashboard</label>
            <!-- Menu Item Dashboard -->
            <li class="pr-2">
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" @click="selected = (selected === 'dashboard' ? '' : 'dashboard')">
                    <div class="bg-white shadow-lg shadow-gray-400 !text-white text-dark-700 w-8 h-8 p-2.5 mr-1 rounded-lg text-center grid place-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-m-1 h-6 w-6" viewBox="0 0 24 24" fill="none">
                            <path d="M6 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V8ZM6 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-1Z" class="fill-current text-cyan-400 dark:fill-slate-600"></path>
                            <path d="M13 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2V8Z" class="fill-current text-cyan-200 group-hover:text-cyan-300"></path>
                            <path d="M13 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-1Z" class="fill-current text-gray-600 group-hover:text-sky-300"></path>
                        </svg>
                    </div>
                    <span class="font-medium">Dashboard</span>
                </x-nav-link>
            </li>

            <!-- Menu Item Master Data -->
            <label class="font-bold text-transparent bg-gradient-to-r from-sky-700 to-cyan-500 bg-clip-text">Master Data</label>
            <div class="relative inline-block text-left">
                <li x-data="{ open: false }" @click.away="open = false">
                    <x-nav-link :active="request()->routeIs(['siswa', 'siswa.tambah', 'siswa.edit', 'guru', 'guru.tambah', 'guru.edit'])" @click="open = !open" href="#" id="options-menu1" aria-haspopup="true" aria-expanded="true" onclick="toggleDropdown('dropdown-menu1', 'dropdown-Akademik')">
                        <div class="bg-white shadow-lg shadow-gray-400 !text-white text-dark-700 w-8 h-8 p-2.5 mr-1 rounded-lg text-center grid place-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-m-1 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path class="fill-current text-gray-300 group-hover:text-cyan-300" fill-rule="evenodd" d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z" clip-rule="evenodd" />
                                <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z" />
                            </svg>
                        </div>
                        <span class="ml-2 font-medium group-hover:text-gray-700">Data Pengguna</span>
                        <svg x-bind:class="{ 'transform rotate-180': open }" class="w-4 h-4 ml-auto transform transition-transform duration-200" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 9l-7 7-7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </x-nav-link>
                </li>
                <x-nav-link-drop id="dropdown-menu1" class="translate transform overflow-hidden" aria-labelledby="options-menu1" role="menu" :active="request()->routeIs('siswa', 'siswa.tambah', 'siswa.edit', 'guru', 'guru.tambah', 'guru.edit')">
                    <div class="text-sm py-2 space-y-2">
                        <a href="#" class="flex items-center w-full p-2 font-normal text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-200 dark:text-white dark:hover:bg-gray-700 pl-11" role="menuitem">Admin</a>
                        <x-drop-link-ul href="{{ route('siswa') }}" :active="request()->routeIs(['siswa', 'siswa.tambah', 'siswa.edit'])" role="menuitem">Siswa</x-drop-link-ul>
                        <x-drop-link-ul href="{{ route('guru') }}" :active="request()->routeIs(['guru', 'guru.tambah', 'guru.edit'])" role="menuitem">Guru</x-drop-link-ul>
                    </div>
                </x-nav-link-drop>
            </div>

            <!-- Menu Item Data Akademik -->
            <div class="relative inline-block text-left">
                <li x-data="{ open: false }" @click.away="open = false">
                    <x-nav-link :active="request()->routeIs(['tahun_ajaran', 'wali_kelas', 'mata_pelajaran', 'rombel', 'rombel.anggota'])" @click="open = !open" href="#" id="options-Akademik" aria-haspopup="true" aria-expanded="true" onclick="toggleDropdown('dropdown-Akademik', 'dropdown-menu1')">
                        <div class="bg-white shadow-lg shadow-gray-400 !text-white text-dark-700 w-8 h-8 p-2.5 mr-1 rounded-lg text-center grid place-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-m-1 h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                <path class="fill-current text-gray-600 group-hover:text-cyan-600" fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd" />
                                <path class="fill-current text-gray-300 group-hover:text-cyan-300" d="M15 7a1 1 0 012 0v7a1 1 0 01-2 0V7z" />
                            </svg>
                        </div>
                        <span class="ml-2 font-medium">Data Akademik</span>
                        <svg x-bind:class="{ 'transform rotate-180': open }" class="w-4 h-4 ml-auto transform transition-transform duration-200" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 9l-7 7-7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </x-nav-link>
                    <x-nav-link-drop id="dropdown-Akademik" class="translate transform overflow-hidden" aria-labelledby="options-Akademik" role="menu" :active="request()->routeIs(['tahun_ajaran', 'wali_kelas', 'mata_pelajaran', 'rombel', 'rombel.anggota'])">
                        <div class="text-sm py-2 space-y-2">
                            <x-drop-link-ul href="{{ route('tahun_ajaran') }}" :active="request()->routeIs('tahun_ajaran')" role="menuitem">Tahun Ajaran</x-drop-link-ul>
                            <x-drop-link-ul href="{{ route('wali_kelas') }}" :active="request()->routeIs('wali_kelas')" role="menuitem">Wali Kelas</x-drop-link-ul>
                            <x-drop-link-ul href="{{ route('mata_pelajaran') }}" :active="request()->routeIs('mata_pelajaran')" role="menuitem">Mata Pelajaran</x-drop-link-ul>
                            <x-drop-link-ul href="{{ route('rombel') }}" :active="request()->routeIs(['rombel', 'rombel.anggota'])" role="menuitem">Rombongan Belajar</x-drop-link-ul>
                        </div>
                    </x-nav-link-drop>
                </li>
            </div>

            <label class="font-bold text-transparent bg-gradient-to-r from-sky-700 to-cyan-500 bg-clip-text">Pengolahan Data</label>
            <!-- Menu Item Pengolahan Data -->
                <li class="pr-2">
                    <x-nav-link href="{{ route('nilai') }}" :active="request()->routeIs(['nilai', 'nilai.input'])">
                        <div class="bg-white shadow-lg shadow-gray-400 !text-white text-dark-700 w-8 h-8 p-2.5 mr-1 rounded-lg text-center grid place-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-m-1 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                                <path class="fill-current text-gray-300 group-hover:text-cyan-300" d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
                            </svg>
                        </div>
                        <span class="font-medium">Nilai</span>
                    </x-nav-link>
                </li>

                <li class="pr-2">
                    <x-nav-link href="{{ route('presensi') }}" :active="request()->routeIs(['presensi', 'presensi.input'])">
                        <div class="bg-white shadow-lg shadow-gray-400 !text-white text-dark-700 w-8 h-8 p-2.5 mr-1 rounded-lg text-center grid place-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-m-1 w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                <path class="fill-current text-gray-300 group-hover:text-cyan-300" d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                                <path class="fill-current text-gray-600 group-hover:text-cyan-600" fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="font-medium">Presensi</span>
                    </x-nav-link>
                </li>

                <li class="pr-2">
                    <x-nav-link href="#">
                        <div class="bg-white shadow-lg shadow-gray-400 !text-white text-dark-700 w-8 h-8 p-2.5 mr-1 rounded-lg text-center grid place-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-m-1 w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                <path class="fill-current text-gray-300 group-hover:text-cyan-300" d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                                <path class="fill-current text-gray-600 group-hover:text-cyan-600" fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="font-medium">Raport</span>
                    </x-nav-link>
                </li>
                
            <label class="font-bold text-transparent bg-gradient-to-r from-sky-700 to-cyan-500 bg-clip-text">Laporan Sekolah</label>
            <!-- Menu Item Laporan -->
                <li x-data="{ open: false }" @click.away="open = false">
                    <x-nav-link :active="request()->routeIs(['siswa', 'siswa.tambah', 'siswa.edit', 'guru', 'guru.tambah', 'guru.edit'])" @click="open = !open" href="#" id="options-menu3" aria-haspopup="true" aria-expanded="true" onclick="toggleDropdown('dropdown-menu3', 'dropdown-laporan')">
                        <div class="bg-white shadow-lg shadow-gray-400 !text-white text-dark-700 w-8 h-8 p-2.5 mr-1 rounded-lg text-center grid place-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-m-1 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path class="fill-current text-gray-300 group-hover:text-cyan-300" fill-rule="evenodd" d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z" clip-rule="evenodd" />
                                <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z" />
                            </svg>
                        </div>
                        <span class="ml-2 font-medium group-hover:text-gray-700">Laporan</span>
                        <svg x-bind:class="{ 'transform rotate-180': open }" class="w-4 h-4 ml-auto transform transition-transform duration-200" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 9l-7 7-7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </x-nav-link>
                </li>
                <x-nav-link-drop id="dropdown-menu3" class="translate transform overflow-hidden" aria-labelledby="options-menu3" role="menu" 
                {{-- :active="request()->routeIs('siswa', 'siswa.tambah', 'siswa.edit', 'guru', 'guru.tambah', 'guru.edit')" --}}
                >
                    <div class="text-sm py-2 space-y-2">
                        <x-drop-link-ul href="#" role="menuitem">Siswa</x-drop-link-ul>
                        <x-drop-link-ul href="#" role="menuitem">Guru</x-drop-link-ul>
                        <x-drop-link-ul href="#" role="menuitem">Presensi</x-drop-link-ul>
                        <x-drop-link-ul href="#" role="menuitem">Mata Pelajaran</x-drop-link-ul>
                        <x-drop-link-ul href="#" role="menuitem">Jadwal Pelajaran</x-drop-link-ul>
                        <x-drop-link-ul href="#" role="menuitem">Raport</x-drop-link-ul>
                    </div>
                </x-nav-link-drop>
        </ul>
    </div>

    <!-- Footer Sidebar -->
    <div class="mt-4">
        <x-button icon="m-power" class="text-white w-full bg-gray-500 btn-sm" spinner label="logout" wire:click="logout" />
    </div>
<div class="sidebar-overlay fixed inset-0 lg:hidden"></div>
</div>

<script>
    function toggleDropdown(dropdownId, otherDropdownId) {
        var dropdown = document.getElementById(dropdownId);
        var otherDropdown = document.getElementById(otherDropdownId);

        if (dropdown.style.display === "block") {
            dropdown.style.display = "none";
        } else {
            dropdown.style.display = "block";
            if (otherDropdown) {
                otherDropdown.style.display = "none";
            }
        }
    }
</script>