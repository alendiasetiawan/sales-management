<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role')->insert([
            [
                'nama_role' => 'Sales',
                'hak_akses' => 'Mengelola Data Pelanggan',
            ],
            [
                'nama_role' => 'Sales Manager',
                'hak_akses' => 'Mengelola Kinerja Tim Sales'
            ]
        ]);
    }
}
