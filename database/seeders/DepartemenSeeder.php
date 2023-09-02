<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departemen')->insert([
            [
                'nama' => 'Sales',
            ],
            [
                'nama' => 'Finance',
            ],
            [
                'nama' => 'IT'
            ]
        ]);
    }
}
