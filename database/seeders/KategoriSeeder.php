<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class KategoriSeeder extends Seeder
{
    public function run()
    {
        DB::table('kategori')->insert([
            'id_admin' => 1,
            'nama_kategori' => 'Kucing Persia',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}