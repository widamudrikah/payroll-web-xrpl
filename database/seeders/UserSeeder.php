<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seeder untuk Bendahara
        DB::table('users')->insert([
            'name' => 'Bendahara',
            'email' => 'bendahara@gmail.com',
            'password' => Hash::make('12345678'), // Gantilah dengan password yang sesuai
            'role' => 'bendahara',
            'remember_token' => Str::random(10),
        ]);

        // Seeder untuk Karyawan
        DB::table('users')->insert([
            'name' => 'Karyawan 1',
            'email' => 'karyawan1@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'karyawan',
            'remember_token' => Str::random(10),
        ]);

        DB::table('users')->insert([
            'name' => 'Karyawan 2',
            'email' => 'karyawan2@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'karyawan',
            'remember_token' => Str::random(10),
        ]);
    }
}
