<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    public function run()
    {
        $kelas = [
            // Kelas A
            ['kode_kelas' => 'KLS01-A', 'nama_kelas' => '1-A', 'kapasitas' => '30'],
            ['kode_kelas' => 'KLS02-A', 'nama_kelas' => '2-A', 'kapasitas' => '30'],
            ['kode_kelas' => 'KLS03-A', 'nama_kelas' => '3-A', 'kapasitas' => '30'],
            ['kode_kelas' => 'KLS04-A', 'nama_kelas' => '4-A', 'kapasitas' => '30'],
            ['kode_kelas' => 'KLS05-A', 'nama_kelas' => '5-A', 'kapasitas' => '30'],
            ['kode_kelas' => 'KLS06-A', 'nama_kelas' => '6-A', 'kapasitas' => '30'],

            // Kelas B
            ['kode_kelas' => 'KLS01-B', 'nama_kelas' => '1-B', 'kapasitas' => '30'],
            ['kode_kelas' => 'KLS02-B', 'nama_kelas' => '2-B', 'kapasitas' => '30'],
            ['kode_kelas' => 'KLS03-B', 'nama_kelas' => '3-B', 'kapasitas' => '30'],
            ['kode_kelas' => 'KLS04-B', 'nama_kelas' => '4-B', 'kapasitas' => '30'],
            ['kode_kelas' => 'KLS05-B', 'nama_kelas' => '5-B', 'kapasitas' => '30'],
            ['kode_kelas' => 'KLS06-B', 'nama_kelas' => '6-B', 'kapasitas' => '30'],
        ];

        foreach ($kelas as $k) {
            Kelas::create($k);
        }
    }
}
