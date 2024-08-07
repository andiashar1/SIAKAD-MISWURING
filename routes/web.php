<?php

use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RaportController;
use App\Http\Middleware\PdfMiddleware;

// Volt::route('/', 'users.index');

Route::view('/', 'welcome');

Route::get('/dashboard', \App\Livewire\views\Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
Route::middleware(['auth'])->group(function () {
    Route::get('/siswa/tambah', \App\Livewire\posts\DataSiswaTest::class)->name('siswa.tambah');
    Route::get('/siswa', \App\Livewire\forms\DataSiswa::class)->name('siswa');
    Route::get('/siswa/{siswa}/edit', \App\Livewire\posts\EditDataSiswa::class)->name('siswa.edit');
    Route::get('/guru/tambah', \App\Livewire\posts\TambahDataGuru::class)->name('guru.tambah');
    Route::get('/guru', \App\Livewire\forms\DataGuru::class)->name('guru');
    Route::get('/guru/{guru}/edit', \App\Livewire\posts\EditDataGuru::class)->name('guru.edit');

    Route::get('/kelas', \App\Livewire\forms\DataKelas::class)->name('kelas');
    Route::get('/wali_kelas', \App\Livewire\forms\DataWaliKelas::class)->name('wali_kelas');
    Route::get('/rombel', \App\Livewire\forms\DataRombel::class)->name('rombel');
    Route::get('/rombel/{wali_kelas}/anggota', \App\Livewire\forms\DataRombelAnggota::class)->name('rombel.anggota');

    Route::get('/tahun_ajaran', \App\Livewire\forms\DataTahunAjaran::class)->name('tahun_ajaran');
    // Route::get('/test', \App\Livewire\posts\DataSiswaTest::class)->name('test');

    Route::get('/mata_pelajaran', \App\Livewire\forms\DataMataPelajaran::class)->name('mata_pelajaran');

    Route::get('/jadwal_pelajaran', \App\Livewire\forms\DataJadwalPelajaran::class)->name('jadwal_pelajaran');
    Route::get('/jadwal_pelajaran/{wali_kelas}/tambah', \App\Livewire\posts\DatajadwalPelajaranTambah::class)->name('jadwal_pelajaran.tambah');

    Route::get('/nilai', \App\Livewire\forms\DataNilai::class)->name('nilai');
    Route::get('/nilai/{rombel}/input', \App\Livewire\posts\DataNilaiInput::class)->name('nilai.input');

    Route::get('/presensi', \App\Livewire\forms\DataPresensi::class)->name('presensi');

    Route::get('/raport', \App\Livewire\forms\DataRaport::class)->name('raport');
    Route::get('/raport/{siswa}/input', \App\Livewire\posts\DataRaportInput::class)->name('raport.input');


    Route::get('/logout', \App\Livewire\actions\Logout::class)->name('logout');

    Route::get('/raport/pdf-view', [RaportController::class, 'viewRaport'])->name('raport.pdf-view');
    Route::get('/raport/view', [RaportController::class, 'view'])->name('raport.view');
    
    Route::get('/raport/print', [RaportController::class, 'printRaport'])->name('raport.print');

}
);

require __DIR__.'/auth.php';
