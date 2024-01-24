<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Hamdan',
            'email' => 'hamdan@exindomedia.com',
            'role' => 'owner',
            'password' => Hash::make('owner123'),
        ]);
        DB::table('users')->insert([
            'name' => 'Sahal',
            'email' => 'sahal@exindomedia.com',
            'role' => 'admin',
            'password' => Hash::make('sahal123'),
        ]);
    }
}
