<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pegawai')->insert([
            [
                'nip' => 'alendia@gmail.com',
                'nama_pegawai' => 'Alendia Setiawan',
                'jk' => 'Laki-Laki',
                'prefix_hp' => 62,
                'no_hp' => '85775768232',
                'departemen_id' => 1,
                'role_id' => 1,
            ],
            [
                'nip' => 'awwab@gmail.com',
                'nama_pegawai' => 'Awwab Abdillah Hazim',
                'jk' => 'Laki-Laki',
                'prefix_hp' => 62,
                'no_hp' => '85720004944',
                'departemen_id' => 1,
                'role_id' => 2,
            ]
        ]);
    }
}
