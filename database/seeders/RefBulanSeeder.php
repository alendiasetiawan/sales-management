<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RefBulanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ref_bulan')->insert([
            [
                'bulan' => 'Januari',
            ],
            [
                'bulan' => 'Februari',
            ],
            [
                'bulan' => 'Maret',
            ],
            [
                'bulan' => 'April',
            ],
            [
                'bulan' => 'Mei',
            ],
            [
                'bulan' => 'Juni',
            ],
            [
                'bulan' => 'Juli',
            ],
            [
                'bulan' => 'Agustus',
            ],
            [
                'bulan' => 'September',
            ],
            [
                'bulan' => 'Oktober',
            ],
            [
                'bulan' => 'November',
            ],
            [
                'bulan' => 'Desember',
            ],
        ]);
    }
}
