<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'agus',
            'email' => 'agus@example.com',
            'nama_lengkap' => 'agus',
            'no_telepon' => '081234567890',
            'alamat' => 'Jl. Merpati No. 123',
            'media_sosial' => 'agus123',
            'usia' => '25',
            'pekerjaan' => 'Karyawan Swasta',
            'password' => bcrypt('1234567890'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}