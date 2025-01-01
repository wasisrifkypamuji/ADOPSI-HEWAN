<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdopsiSeeder extends Seeder
{
    public function run()
    {
        DB::table('adopsi')->insert([
            'id_admin' => 1,
            'user_id' => 1,
            'username' => 'agus',
            'nama_lengkap' => 'agus',
            'email' => 'agus@example.com',
            'no_telepon' => '081234567890',
            'alamat' => 'Jl. Merpati No. 123',
            'pekerjaan' => 'Karyawan Swasta',
            'id_hewan' => 1,
            'id_pertanyaan' => 1,
            'nama_hewan' => 'Mochi',
            'status_adopsi' => 'Diadopsi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}