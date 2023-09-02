<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RefPekanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ref_pekan')->insert([
            [
                'pekan' => 1,
            ],
            [
                'pekan' => 2,
            ],
            [
                'pekan' => 3,
            ],
            [
                'pekan' => 4,
            ],
            [
                'pekan' => 5,
            ],
        ]);
    }
}
