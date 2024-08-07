<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 10pt;
        }
        .header, .subheader { text-align: center; line-height: 5px; font-size: 10pt;}
        .header-next {
            display: none;
            font-size: 10pt; /* Sembunyikan di layar biasa */
        }
        .logo { width: 77px; height: auto; position: absolute; top: 20px; }
        .logo-left { left: 20px; }
        .logo-right { right: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; }
        th { background-color: #f2f2f2; }
        .footer { text-align: center; margin-top: 20px; font-size: 0.9em; }
        .italic-text { font-style: italic; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        .subject-header {
            font-weight: bold;
        }
        .category-title {
            font-weight: bold;
            margin-top: 20px;
            font-size: 18px;
        }
        .center {
            text-align: center;
        }

        .double-hr {
            height:1px;
            boder: none;
            border-top:2px solid black;
            border-bottom:1px solid black;
            margin-bottom: -15px;
        }
        .double-hr2 {
            height:1px;
            boder: none;
            border-top:2px solid black;
            border-bottom:1px solid black;
        }
        .no-border-table, .no-border-table th, .no-border-table td {
            border: none;
            border-collapse: collapse;
        }
        .no-border-table td {
            padding: 8px; /* Optional: Adjust padding if needed */
        }
        .name-container {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.nip {
    margin-top: 0; /* Adjusts the space between name and NIP if needed */
}
        .walikelas {
    border-collapse: collapse;
    width: 100%;
}

.walikelas .walikelas-cell {
    border: none;
    padding: 8px;
    /* Add other default styles here */
}

/* Example dynamic styles for specific classes */
.walikelas .walikelas-cell.wuring {
    font-weight: bold;
    color: #333;
}

.walikelas .walikelas-cell.wali-kelas {
    font-style: italic;
    color: #666;
}

/* Add other specific styles as needed */


        /* Aturan cetak */
        @media print {
            body {
                font-size: 8pt; /* Mengatur ukuran huruf menjadi 10pt */
            }
            .header, .subheader, .header-next {font-size: 10pt;}
            /* Memisahkan tabel Sikap Spiritual dan Sosial */
            .page-break {
                page-break-before: always; /* Memulai halaman baru sebelum elemen ini */
            }
            .header-print {
            display: block; /* Tampilkan saat cetak */
            }
            .logo {
            position: fixed;
            }
        @page {
            margin: 50px; /* Adjust margins as needed */
        }

        }
    </style>
</head>
<body>

    <div class="header-print">
        <div class="header">
            <img src="{{ asset('assets/img/logo_kementrian_agama.png') }}" alt="Logo Kementerian" class="logo logo-left">
            <h4>KEMENTERIAN AGAMA REPUBLIK INDONESIA</h4>
            <h3>MIS MUHAMMADIYAH WURING</h3>
            <p class="italic-text">Jl. Bengkunis Wuring</p>
            <p class="italic-text">Kecamatan Alok Barat, Kabupaten Sikka - Nusa Tenggara Timur</p>
            <img src="{{ asset('assets/img/logo_sekolah.jpg') }}" alt="Logo Sekolah" class="logo logo-right">
        </div>

        <div class="subheader">
            <hr class="double-hr">
                <table class="no-border-table">
                    <tbody>
                        <tr>
                            <td style="width:10%"><strong>Nama</strong></td>
                            <td style="width:40%">: {{ $rombel->siswa->nama }}</td>
                            <td><strong>Madrasah</strong></td>
                            <td>: MIS MUHAMMADIYAH WURING</td>
                        </tr>
                        <tr>
                            <td><strong>NIS</strong></td>
                            <td>: {{ $rombel->siswa->nisn }}</td>
                            <td><strong>Kelas/Semester</strong></td>
                            <td>: {{ $rombel->waliKelas->kelas->nama_kelas }}/{{ $rombel->waliKelas->tahunAjaran->semester }}</td>
                        </tr>
                        <tr>
                            <td><strong>NISN</strong></td>
                            <td>: {{ $rombel->siswa->nisn }}</td>
                            <td><strong>Tahun Ajaran</strong></td>
                            <td>: {{ $rombel->waliKelas->tahunAjaran->tahun_ajaran }}</td>
                        </tr>
                    </tbody>
                </table>
            <hr class="double-hr2">
        </div>
    </div>


    <h2><center>Capaian Belajar</center></h2>
    <h3>A. Sikap</h3>
    <h4>1. Sikap Spritual</h4>
    <table>
        <thead>
            <tr>
                <th>Predikat</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$nilai2->nilai_ki1}}</td>
                <td>{{$nilai2->deskripsi_ki1}}</td>
            </tr>
        </tbody>
    </table>

    <h4>2. Sikap Sosial</h4>
    <table>
        <thead>
            <tr>
                <th>Predikat</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$nilai2->nilai_ki2}}</td>
                <td>{{$nilai2->deskripsi_ki2}}</td>
            </tr>
        </tbody>
    </table>

    <!-- Memisahkan halaman dengan class 'page-break' -->
    <div class="page-break"></div>
    <div class="header-print header-next">
        <div class="header">
            <img src="{{ asset('assets/img/logo_kementrian_agama.png') }}" alt="Logo Kementerian" class="logo logo-left">
            <h4>KEMENTERIAN AGAMA REPUBLIK INDONESIA</h4>
            <h3>MIS MUHAMMADIYAH WURING</h3>
            <p class="italic-text">Jl. Bengkunis Wuring</p>
            <p class="italic-text">Kecamatan Alok Barat, Kabupaten Sikka - Nusa Tenggara Timur</p>
            <img src="{{ asset('assets/img/logo_sekolah.jpg') }}" alt="Logo Sekolah" class="logo logo-right">
        </div>

        <div class="subheader">
            <hr class="double-hr">
                <table class="no-border-table">
                    <tbody>
                        <tr>
                            <td style="width:10%"><strong>Nama</strong></td>
                            <td style="width:40%">: {{ $rombel->siswa->nama }}</td>
                            <td><strong>Madrasah</strong></td>
                            <td>: MIS MUHAMMADIYAH WURING</td>
                        </tr>
                        <tr>
                            <td><strong>NIS</strong></td>
                            <td>: {{ $rombel->siswa->nisn }}</td>
                            <td><strong>Kelas/Semester</strong></td>
                            <td>: {{ $rombel->waliKelas->kelas->nama_kelas }}/{{ $rombel->waliKelas->tahunAjaran->semester }}</td>
                        </tr>
                        <tr>
                            <td><strong>NISN</strong></td>
                            <td>: {{ $rombel->siswa->nisn }}</td>
                            <td><strong>Tahun Ajaran</strong></td>
                            <td>: {{ $rombel->waliKelas->tahunAjaran->tahun_ajaran }}</td>
                        </tr>
                    </tbody>
                </table>
            <hr class="double-hr2">
        </div>
    </div>

    <h3>B. PENGETAHUAN DAN KETERAMPILAN</h3>

    @php
        $startingNumber = 1; // Angka awal sebelum loop
        $nextNumber1 = $startingNumber; // Menyimpan nomor saat ini untuk digunakan di luar loop
        $nextNumber2 = $nextNumber1;
        $lastNumber = $nextNumber2;

        if (!function_exists('numberToLetter')) {
            function numberToLetter($number) {
                $alphabet = range('A', 'Z');
                return $alphabet[$number - 1] ?? '';
            }
        }

        if (!function_exists('getGrade')) {
            function getGrade($nilai) {
                if ($nilai >= 89) {
                    return 'A';
                } elseif ($nilai >= 78) {
                    return 'B';
                } elseif ($nilai >= 67) {
                    return 'C';
                } elseif ($nilai >= 0) {
                    return 'D';
                }
                return ''; // Mengembalikan string kosong jika nilai kurang dari 0
            }
        }

        // Fungsi untuk menghitung total nilai yang tersedia
        if (!function_exists('getGrade')) {
            function calculateTotals($items, $key) {
                $total = 0;
                foreach ($items as $item) {
                    $value = (int) $item[$key];
                    if ($value > 0) {
                        $total += $value;
                    }
                }
                return $total > 0 ? $total : ''; // Jika ada nilai yang dihitung, kembalikan total, jika tidak kembalikan string kosong
            }
        }

        // Inisialisasi total nilai
        $totalNilaiK3 = 0;
        $totalNilaiK4 = 0;
    @endphp

    <!-- Tabel Pendidikan Agama Islam -->
    <table>
        <thead>
            <tr>
                <th rowspan="2" colspan="2" class="center">Mata Pelajaran</th>
                <th colspan="2" class="center">Pengetahuan (KI 3)</th>
                <th colspan="2" class="center">Keterampilan (KI 4)</th>
            </tr>
            <tr>
                <th class="center">Nilai</th>
                <th class="center">Predikat</th>
                <th class="center">Nilai</th>
                <th class="center">Predikat</th>
            </tr>
        </thead>
        <tbody>
            <!-- Header Pendidikan Agama Islam -->
            <tr>
                <td colspan="2" class="subject-header">Kelompok A</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="center"> {{$startingNumber}}</td>
                <td>Pendidikan Agama Islam</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <!-- Loop Pendidikan Agama Islam -->
            @foreach ($data['kelompokA']['pendidikan agama'] as $index => $item)
                @php
                    $nilai_ki3 = (int) $item['nilai_ki3'];
                    $nilai_ki4 = (int) $item['nilai_ki4'];
                    $predikat_k3 = $nilai_ki3 > 0 ? getGrade($nilai_ki3) : '';
                    $predikat_k4 = $nilai_ki4 > 0 ? getGrade($nilai_ki4) : '';
                    $totalNilaiK3 += $nilai_ki3;
                    $totalNilaiK4 += $nilai_ki4;
                @endphp
                <tr>
                    <td></td>
                    <td>{{ numberToLetter($loop->iteration) }}. {{ $item['nama_mapel'] }}</td>
                    <td class="center">{{ $nilai_ki3 > 0 ? $nilai_ki3 : '' }}</td>
                    <td class="center">{{ $predikat_k3 }}</td>
                    <td class="center">{{ $nilai_ki4 > 0 ? $nilai_ki4 : '' }}</td>
                    <td class="center">{{ $predikat_k4 }}</td>
                </tr>
            @endforeach

            <!-- Pendidikan Umum -->
            @foreach ($data['kelompokA']['pendidikan umum'] as $index => $item)
                @php
                    $nilai_ki3 = (int) $item['nilai_ki3'];
                    $nilai_ki4 = (int) $item['nilai_ki4'];
                    $predikat_k3 = $nilai_ki3 > 0 ? getGrade($nilai_ki3) : '';
                    $predikat_k4 = $nilai_ki4 > 0 ? getGrade($nilai_ki4) : '';
                    $totalNilaiK3 += $nilai_ki3;
                    $totalNilaiK4 += $nilai_ki4;
                @endphp
                <tr>
                    <td class="center">{{ $nextNumber1 + $loop->iteration }}</td>
                    <td>{{ $item['nama_mapel'] }}</td>
                    <td class="center">{{ $nilai_ki3 > 0 ? $nilai_ki3 : '' }}</td>
                    <td class="center">{{ $predikat_k3 }}</td>
                    <td class="center">{{ $nilai_ki4 > 0 ? $nilai_ki4 : '' }}</td>
                    <td class="center">{{ $predikat_k4 }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2" class="subject-header">Kelompok B</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <!-- Pendidikan Kulikuler -->
            @foreach ($data['kelompokB']['pendidikan kulikuler'] as $index => $item)
                @php
                    $nilai_ki3 = (int) $item['nilai_ki3'];
                    $nilai_ki4 = (int) $item['nilai_ki4'];
                    $predikat_k3 = $nilai_ki3 > 0 ? getGrade($nilai_ki3) : '';
                    $predikat_k4 = $nilai_ki4 > 0 ? getGrade($nilai_ki4) : '';
                    $totalNilaiK3 += $nilai_ki3;
                    $totalNilaiK4 += $nilai_ki4;
                @endphp
                <tr>
                    <td class="center">{{ $loop->iteration }}</td>
                    <td>{{ $item['nama_mapel'] }}</td>
                    <td class="center">{{ $nilai_ki3 > 0 ? $nilai_ki3 : '' }}</td>
                    <td class="center">{{ $predikat_k3 }}</td>
                    <td class="center">{{ $nilai_ki4 > 0 ? $nilai_ki4 : '' }}</td>
                    <td class="center">{{ $predikat_k4 }}</td>
                </tr>
            @endforeach

            <!-- Muatan Lokal -->
            @foreach ($data['kelompokB']['muatan lokal'] as $index => $item)
                @php
                    $nilai_ki3 = (int) $item['nilai_ki3'];
                    $nilai_ki4 = (int) $item['nilai_ki4'];
                    $predikat_k3 = $nilai_ki3 > 0 ? getGrade($nilai_ki3) : '';
                    $predikat_k4 = $nilai_ki4 > 0 ? getGrade($nilai_ki4) : '';
                    $totalNilaiK3 += $nilai_ki3;
                    $totalNilaiK4 += $nilai_ki4;
                @endphp
                <tr>
                    <td></td>
                    <td>{{ numberToLetter($loop->iteration) }}. {{ $item['nama_mapel'] }}</td>
                    <td class="center">{{ $nilai_ki3 > 0 ? $nilai_ki3 : '' }}</td>
                    <td class="center">{{ $predikat_k3 }}</td>
                    <td class="center">{{ $nilai_ki4 > 0 ? $nilai_ki4 : '' }}</td>
                    <td class="center">{{ $predikat_k4 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tabel Total Nilai -->
    <table>
        <thead>
            <tr>
                <th colspan="2" class="center">Total Semua Nilai</th>
                <th class="center">Nilai KI3</th>
                <th class="center">Nilai KI4</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2" class="center">Jumlah Total</td>
                <td class="center">{{ $totalNilaiK3 > 0 ? $totalNilaiK3 : '' }}</td>
                <td class="center">{{ $totalNilaiK4 > 0 ? $totalNilaiK4 : '' }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Memisahkan halaman dengan class 'page-break' -->
    <div class="page-break"></div>
    <div class="header-print header-next">
        <div class="header">
            <img src="{{ asset('assets/img/logo_kementrian_agama.png') }}" alt="Logo Kementerian" class="logo logo-left">
            <h4>KEMENTERIAN AGAMA REPUBLIK INDONESIA</h4>
            <h3>MIS MUHAMMADIYAH WURING</h3>
            <p class="italic-text">Jl. Bengkunis Wuring</p>
            <p class="italic-text">Kecamatan Alok Barat, Kabupaten Sikka - Nusa Tenggara Timur</p>
            <img src="{{ asset('assets/img/logo_sekolah.jpg') }}" alt="Logo Sekolah" class="logo logo-right">
        </div>

        <div class="subheader">
            <hr class="double-hr">
                <table class="no-border-table">
                    <tbody>
                        <tr>
                            <td style="width:10%"><strong>Nama</strong></td>
                            <td style="width:40%">: {{ $rombel->siswa->nama }}</td>
                            <td><strong>Madrasah</strong></td>
                            <td>: MIS MUHAMMADIYAH WURING</td>
                        </tr>
                        <tr>
                            <td><strong>NIS</strong></td>
                            <td>: {{ $rombel->siswa->nisn }}</td>
                            <td><strong>Kelas/Semester</strong></td>
                            <td>: {{ $rombel->waliKelas->kelas->nama_kelas }}/{{ $rombel->waliKelas->tahunAjaran->semester }}</td>
                        </tr>
                        <tr>
                            <td><strong>NISN</strong></td>
                            <td>: {{ $rombel->siswa->nisn }}</td>
                            <td><strong>Tahun Ajaran</strong></td>
                            <td>: {{ $rombel->waliKelas->tahunAjaran->tahun_ajaran }}</td>
                        </tr>
                    </tbody>
                </table>
            <hr class="double-hr2">
        </div>
    </div>
    <h3>C. DESKRIPSI PENGETAHUAN DAN KETERAMPILAN</h3>

    <!-- Tabel Deskripsi Nilai -->
    <table>
        <thead>
            <tr>
                <th rowspan="2" colspan="2" class="center">Mata Pelajaran</th>
                <th class="center">Pengetahuan (KI 3)</th>
                <th class="center">Keterampilan (KI 4)</th>
            </tr>
        </thead>
        <tbody>
            <!-- Header Pendidikan Agama Islam -->
            <tr>
                <td colspan="4" class="subject-header">Kelompok A</td>
            </tr>
            <tr>
                <td class="center"> {{$startingNumber}}</td>
                <td colspan="3">Pendidikan Agama Islam</td>
            </tr>
            <!-- Loop Pendidikan Agama Islam -->
            @foreach ($data['kelompokA']['pendidikan agama'] as $index => $item)
                <tr>
                    <td></td>
                    <td>{{ numberToLetter($loop->iteration) }}. {{ $item['nama_mapel'] }}</td>
                    <td class="center">{{ $item['deskripsi_ki3']}}</td>
                    <td class="center">{{ $item['deskripsi_ki4']}}</td>
                </tr>
            @endforeach

            <!-- Pendidikan Umum -->
            @foreach ($data['kelompokA']['pendidikan umum'] as $index => $item)
                <tr>
                    <td class="center">{{ $nextNumber1 + $loop->iteration }}</td>
                    <td>{{ $item['nama_mapel'] }}</td>
                    <td class="center">{{ $item['deskripsi_ki3']}}</td>
                    <td class="center">{{ $item['deskripsi_ki4']}}</td>
                </tr>
            @endforeach

            <tr>
                <td colspan="4" class="subject-header">Kelompok B</td>
            </tr>

            <!-- Pendidikan Kulikuler -->
            @foreach ($data['kelompokB']['pendidikan kulikuler'] as $index => $item)
                <tr>
                    <td class="center">{{ $loop->iteration }}</td>
                    <td>{{ $item['nama_mapel'] }}</td>
                    <td class="center">{{ $item['deskripsi_ki3']}}</td>
                    <td class="center">{{ $item['deskripsi_ki4']}}</td>
                </tr>
            @endforeach

            <!-- Muatan Lokal -->
            @foreach ($data['kelompokB']['muatan lokal'] as $index => $item)
                <tr>
                    <td></td>
                    <td>{{ numberToLetter($loop->iteration) }}. {{ $item['nama_mapel'] }}</td>
                    <td class="center">{{ $item['deskripsi_ki3']}}</td>
                    <td class="center">{{ $item['deskripsi_ki4']}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="page-break"></div>
    <div class="header-print header-next">
        <div class="header">
            <img src="{{ asset('assets/img/logo_kementrian_agama.png') }}" alt="Logo Kementerian" class="logo logo-left">
            <h4>KEMENTERIAN AGAMA REPUBLIK INDONESIA</h4>
            <h3>MIS MUHAMMADIYAH WURING</h3>
            <p class="italic-text">Jl. Bengkunis Wuring</p>
            <p class="italic-text">Kecamatan Alok Barat, Kabupaten Sikka - Nusa Tenggara Timur</p>
            <img src="{{ asset('assets/img/logo_sekolah.jpg') }}" alt="Logo Sekolah" class="logo logo-right">
        </div>

        <div class="subheader">
            <hr class="double-hr">
                <table class="no-border-table">
                    <tbody>
                        <tr>
                            <td style="width:10%"><strong>Nama</strong></td>
                            <td style="width:40%">: {{ $rombel->siswa->nama }}</td>
                            <td><strong>Madrasah</strong></td>
                            <td>: MIS MUHAMMADIYAH WURING</td>
                        </tr>
                        <tr>
                            <td><strong>NIS</strong></td>
                            <td>: {{ $rombel->siswa->nisn }}</td>
                            <td><strong>Kelas/Semester</strong></td>
                            <td>: {{ $rombel->waliKelas->kelas->nama_kelas }}/{{ $rombel->waliKelas->tahunAjaran->semester }}</td>
                        </tr>
                        <tr>
                            <td><strong>NISN</strong></td>
                            <td>: {{ $rombel->siswa->nisn }}</td>
                            <td><strong>Tahun Ajaran</strong></td>
                            <td>: {{ $rombel->waliKelas->tahunAjaran->tahun_ajaran }}</td>
                        </tr>
                    </tbody>
                </table>
            <hr class="double-hr2">
        </div>
    </div>
    <h3>D. EKSTRAKULIKULER</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kegiatan Ekstrakurikuler</th>
                <th>Predikat</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ekstrakulikuler as $index => $nama)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $nama }}</td>
                <td>{{ $predikat_ekstrakulikuler[$index] ?? '' }}</td>
                <td>{{ $deskripsi_ekstrakulikuler[$index] ?? '' }}</td>
            </tr>
            @empty
            @for($i = 0; $i < 3; $i++)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @endfor
            @endforelse
            @if ($ekstrakulikuler)
                @for($i = count($ekstrakulikuler); $i < 3; $i++)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endfor
            @endif
        </tbody>
    </table>

    <h3>D. PRESTASI</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Prestasi</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($prestasi as $index => $nama)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $nama }}</td>
                <td>{{ $deskripsi_prestasi[$index] ?? '' }}</td>
            </tr>
            @empty
            @for($i = 0; $i < 3; $i++)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td></td>
                <td></td>
            </tr>
            @endfor
            @endforelse
            @if ($prestasi)
                                    <!-- Calculate empty rows needed -->
                @for($i = count($prestasi); $i < 3; $i++)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td></td>
                    <td></td>
                </tr>
                @endfor
            @endif
        </tbody>
    </table>

    <h3>E. Presensi</h3>
    @if ($hasil)
        <table>
            <tbody>
                <tr>
                    <td>Sakit</td>
                    <td>{{ $hasil->jumlah_sakit }}</td>
                    <td>Hari</td>
                </tr>
                <tr>
                    <td>Izin</td>
                    <td>{{ $hasil->jumlah_izin }}</td>
                    <td>Hari</td>
                </tr>
                <tr>
                    <td>Alpa</td>
                    <td>{{ $hasil->jumlah_alpa }}</td>
                    <td>Hari</td>
                </tr>
        </table>
    @endif

    <h3>F. CATATAN WALI KELAS</h3>
    <div style="width: 100%; height: 50px; border: 1px solid black; padding: 5px;">
        {{ $nilai2->catatan }}
    </div>

    <h3>G. TANGGAPAN ORANG TUA</h3>
    <div style="width: 100%; height: 60px; border: 1px solid black; padding: 5px;">
        <!-- Isi tanggapan orang tua dapat ditambahkan di sini -->
    </div>

    
    <div style="margin-top: 20px; width: 100%; border: 1px solid black; padding: 5px;">
        Keterangan kenaikan kelas: <strong>{{ $keterangan }}</strong>
    </div>

    <table class="walikelas">
        <tbody>
            <tr>
                <td class="walikelas-cell" style="width: 65%"></td>
                <td class="walikelas-cell">Wuring</td>
            </tr>
            <tr>
                <td class="walikelas-cell" style="width: 65%">Orang tua/Wali Siswa</td>
                <td class="walikelas-cell">Wali Kelas</td>
            </tr>
            <tr>
                <td class="walikelas-cell" style="width: 65%"></td>
                <td class="walikelas-cell"></td>
            </tr>
            <tr>
                <td class="walikelas-cell" style="width: 65%"></td>
                <td class="walikelas-cell"></td>
            </tr>
            <tr>
                <td class="walikelas-cell" style="width: 65%"></td>
                <td class="walikelas-cell">
                    <strong>{{$rombel->waliKelas->guru->nama}}</strong><br>
                    NIP: {{$rombel->waliKelas->guru->nip ?? "-"}}
                </td>
            </tr>
        </tbody>
    </table>

    <div style="margin-left: 45%">
        Mengetahui<br>
        kepala Sekolah<br><br><br><br>

        <strong> Halis, S.Pd.I, M.Pd </strong><br>
        NIP: -
    </div>


</body>

</html>
