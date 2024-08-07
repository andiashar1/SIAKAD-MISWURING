<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $students = [
            [
                'nisn' => 1234567890,
                'nik' => 3201011234560001,
                'nama' => 'Ahmad Fikri',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '2004-06-15',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'alamat' => 'Jalan Flores No. 10',
                'rt_rw' => '01/01',
                'kelurahan' => '5310081004',
            ],
            [
                'nisn' => 2234567890,
                'nik' => 3201011234560002,
                'nama' => 'Siti Aminah',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '2003-08-21',
                'jenis_kelamin' => 'Perempuan',
                'agama' => 'Islam',
                'alamat' => 'Jalan Flores No. 25',
                'rt_rw' => '02/02',
                'kelurahan' => '5310081004',
            ],
            [
                'nisn' => 3234567890,
                'nik' => 3201011234560003,
                'nama' => 'Budi Santoso',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '2005-02-12',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'alamat' => 'Jalan Flores No. 5',
                'rt_rw' => '03/03',
                'kelurahan' => '5310081004',
            ],
            [
                'nisn' => 4234567890,
                'nik' => 3201011234560004,
                'nama' => 'Dewi Sartika',
                'tempat_lahir' => 'Medan',
                'tanggal_lahir' => '2002-12-05',
                'jenis_kelamin' => 'Perempuan',
                'agama' => 'Islam',
                'alamat' => 'Jalan Flores No. 12',
                'rt_rw' => '04/04',
                'kelurahan' => '5310081004',
            ],
            [
                'nisn' => 5234567890,
                'nik' => 3201011234560005,
                'nama' => 'Rizky Hidayat',
                'tempat_lahir' => 'Yogyakarta',
                'tanggal_lahir' => '2004-10-10',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'alamat' => 'Jalan Flores No. 50',
                'rt_rw' => '05/05',
                'kelurahan' => '5310081004',
            ],
            [
                'nisn' => 6234567890,
                'nik' => 3201011234560006,
                'nama' => 'Lia Wulandari',
                'tempat_lahir' => 'Semarang',
                'tanggal_lahir' => '2003-07-19',
                'jenis_kelamin' => 'Perempuan',
                'agama' => 'Islam',
                'alamat' => 'Jalan Flores No. 33',
                'rt_rw' => '06/06',
                'kelurahan' => '5310081004',
            ],
            [
                'nisn' => 7234567890,
                'nik' => 3201011234560007,
                'nama' => 'Agus Salim',
                'tempat_lahir' => 'Palembang',
                'tanggal_lahir' => '2005-11-30',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'alamat' => 'Jalan Flores No. 11',
                'rt_rw' => '07/07',
                'kelurahan' => '5310081004',
            ],
            [
                'nisn' => 8234567890,
                'nik' => 3201011234560008,
                'nama' => 'Indah Permata',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '2004-05-22',
                'jenis_kelamin' => 'Perempuan',
                'agama' => 'Islam',
                'alamat' => 'Jalan Flores No. 17',
                'rt_rw' => '08/08',
                'kelurahan' => '5310081004',
            ],
            [
                'nisn' => 9234567890,
                'nik' => 3201011234560009,
                'nama' => 'Fajar Nugraha',
                'tempat_lahir' => 'Makassar',
                'tanggal_lahir' => '2003-09-14',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'alamat' => 'Jalan Flores No. 8',
                'rt_rw' => '09/09',
                'kelurahan' => '5310081004',
            ],
            [
                'nisn' => 10234567890,
                'nik' => 3201011234560010,
                'nama' => 'Rina Wijaya',
                'tempat_lahir' => 'Denpasar',
                'tanggal_lahir' => '2005-03-03',
                'jenis_kelamin' => 'Perempuan',
                'agama' => 'Islam',
                'alamat' => 'Jalan Flores No. 29',
                'rt_rw' => '10/10',
                'kelurahan' => '5310081004',
            ],
        ];

        foreach ($students as $student) {
            Siswa::create($student);
        }
    }
}
