<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PoinSalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('poin_sales')->insert([
            [
                'nama' => 'Cold Call',
                'poin' => 1,
            ],
            [
                'nama' => 'Warm Call',
                'poin' => 2,
            ],
            [
                'nama' => 'Lead Generated',
                'poin' => 3,
            ],
            [
                'nama' => 'Sales Closing',
                'poin' => 4,
            ],
        ]);
    }
}
