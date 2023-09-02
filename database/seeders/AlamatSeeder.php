<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AlamatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Seed tabel provinsi
        $provinsi = ['DKI Jakarta', 'Jawa Barat'];
        $id = 1;
        foreach ($provinsi as $item) {
            DB::table('provinsi')->insert([
                'id' => $id++,
                'nama_provinsi' => $item
            ]);
        }

        //Seed tabel kapubaten
        $kabupaten = [
            '1' => [
                'KABUPATEN KEPULAUAN SERIBU',
                'KOTA JAKARTA SELATAN',
                'KOTA JAKARTA TIMUR',
            ],
            '2' => [
                'KABUPATEN BOGOR',
                'KABUPATEN SUKABUMI',
                'KABUPATEN CIANJUR'
            ],
        ];
        $id = 1;

        foreach ($kabupaten as $provinsi_id => $item) {
            foreach ($item as $data) {
                DB::table('kabupaten')->insert([
                    'id' => $id++,
                    'provinsi_id' => $provinsi_id,
                    'nama_kabupaten' => $data
                ]);
            }
        }

        //Seed tabel kecamatan
        $kecamatan = [
            '1' => [
                'KEPULAUAN SERIBU SELATAN',
                'KEPULAUAN SERIBU UTARA',
            ],
            '2' => [
                'JAGAKARSA',
                'PASAR MINGGU',
                'CILANDAK',
                'PESANGGRAHAN',
                'KEBAYORAN LAMA',
                'KEBAYORAN BARU',
                'MAMPANG PRAPATAN',
                'PANCORAN',
                'TEBET',
                'SETIA BUDI'
            ],
            '3' => [
                'PASAR REBO',
                'CIRACAS',
                'CIPAYUNG',
                'MAKASAR',
                'KRAMAT JATI',
                'JATINEGARA',
                'DUREN SAWIT',
                'CAKUNG',
                'PULO GADUNG',
                'MATRAMAN'
            ],
            '4' => [
                'CILEUNGSI',
                'JONGGOL',
                'KELAPA NUNGGAL',
                'GUNUNG PUTRI',
                'TANJUNG SARI',
                'CARIU'
            ],
            '5' => [
                'CIEMAS',
                'CIRACAP',
                'WALURAN',
                'SURADE',
                'CIBITUNG',
                'KALI BUNDER',
            ],
            '6' => [
                'AGRABINTA',
                'LELES',
                'CIDAUN',
                'CIKADU',
                'CIJATI',
                'CIBEBER'
            ]
        ];
        $id = 1;

        foreach ($kecamatan as $kabupaten_id => $item) {
            foreach ($item as $data) {
                DB::table('kecamatan')->insert([
                    'id' => $id++,
                    'kabupaten_id' => $kabupaten_id,
                    'nama_kecamatan' => $data
                ]);
            }
        }
    }
}
