<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\MataPelajaran;
use App\Models\Rombel;
use App\Models\JadwalPelajaran;
use App\Models\Nilai;
use App\Models\Nilai2;
use App\Models\Siswa;
use App\Models\Presensi;

class RaportController extends Controller
{
    public function viewRaport()
    {
        $raport = Rombel::with('waliKelas', 'siswa')->get(); // Sesuaikan dengan relasi yang ada
        $pdf = PDF::loadView('raport.pdf', compact('raport'));

        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="raport.pdf"')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Cache-Control', 'post-check=0, pre-check=0')
            ->header('Pragma', 'no-cache');
    }

public function view(Request $request)
{
    $rombel_id = $request->input('siswa');
    
    // Ambil data mata pelajaran berdasarkan kategori
    $categories = [
        'kelompokA' => ['pendidikan agama', 'pendidikan umum'],
        'kelompokB' => ['pendidikan kulikuler', 'muatan lokal']
    ];

    $data = [];

    foreach ($categories as $group => $categoriesList) {
        foreach ($categoriesList as $category) {
            $mataPelajaran = MataPelajaran::where('kategori', $category)->get();
            $japelIds = JadwalPelajaran::whereIn('mapel_id', $mataPelajaran->pluck('id'))->pluck('id');
            $nilaiData = Nilai::where('rombel_id', $rombel_id)
                              ->whereIn('japel_id', $japelIds)
                              ->get()
                              ->keyBy('japel_id');

            $data[$group][$category] = $mataPelajaran->map(function($mapel) use ($nilaiData) {
                $nilai = $nilaiData->values()->first(fn($item) => JadwalPelajaran::where('mapel_id', $mapel->id)
                                                                             ->where('id', $item->japel_id)
                                                                             ->exists());

                return [
                    'nama_mapel' => $mapel->nama_mapel,
                    'nilai_ki3' => $nilai->nilai_ki3 ?? '',
                    'deskripsi_ki3' => $nilai->deskripsi_ki3 ?? '',
                    'nilai_ki4' => $nilai->nilai_ki4 ?? '',
                    'deskripsi_ki4' => $nilai->deskripsi_ki4 ?? '',
                ];
            })->toArray();
        }
    }

    $nilai2 = Nilai2::find($rombel_id); 

        // Decode JSON data
    $ekstrakulikuler = json_decode($nilai2->ekstrakulikuler, true) ?? [];
    $predikat_ekstrakulikuler = json_decode($nilai2->predikat_ekstrakulikuler, true) ?? [];
    $deskripsi_ekstrakulikuler = json_decode($nilai2->deskripsi_ekstrakulikuler, true) ?? [];

    $prestasi = json_decode($nilai2->prestasi, true) ?? [];
    $deskripsi_prestasi = json_decode($nilai2->deskripsi_prestasi, true) ?? [];

    // Ambil data siswa
    $rombel = Rombel::find($rombel_id);
    $nama_kelas = $rombel->waliKelas->kelas->nama_kelas;

        if (strtolower($nilai2->keterangan) === 'naik') {
            $kelasParts = explode('-', $nama_kelas);
            $kelasNumber = intval($kelasParts[0]);
            $kelasBaru = $kelasNumber + 1;
            $keterangan = "Naik ke kelas {$kelasBaru}";
        } else {
            $kelasParts = explode('-', $nama_kelas);
            $kelasLama = intval($kelasParts[0]);
            $keterangan = "Masih di kelas {$kelasLama}";
        }

        if (!$rombel) {
        abort(404, 'Rombel tidak ditemukan');
    }

    // Hitung jumlah hadir, alpa, dan sakit berdasarkan rombel_id
    $hasil = Presensi::select('rombel_id')
        ->selectRaw('
            COUNT(CASE WHEN presensi = "izin" THEN 1 END) AS jumlah_izin,
            COUNT(CASE WHEN presensi = "alpa" THEN 1 END) AS jumlah_alpa,
            COUNT(CASE WHEN presensi = "sakit" THEN 1 END) AS jumlah_sakit
        ')
        ->where('rombel_id', $rombel_id)
        ->groupBy('rombel_id')
        ->first();

    return view('raport.pdf', compact('data', 'rombel', 'nilai2', 
    'ekstrakulikuler', 'predikat_ekstrakulikuler', 'deskripsi_ekstrakulikuler', 
    'prestasi', 'deskripsi_prestasi', 'keterangan', 'hasil'));
}







    public function printRaport()
    {
        $raport = Rombel::with('waliKelas', 'siswa')->where('siswa_id', 17)->get();
        $pdf = PDF::loadView('raport.pdf', compact('raport'));

        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf');
    }
}
