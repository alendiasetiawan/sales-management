<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nama' => 'Alendia Setiawan',
                'email' => 'alendia@gmail.com',
                'password' => Hash::make('123456'),
                'role_id' => 1,
                'default_pw' => 'IYA',
            ],
            [
                'nama' => 'Awwab Abdillah Hazim',
                'email' => 'awwab@gmail.com',
                'password' => Hash::make('123456'),
                'role_id' => 2,
                'default_pw' => 'IYA',
            ],
        ]);
    }
}
