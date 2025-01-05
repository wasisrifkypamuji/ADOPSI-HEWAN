<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HewanSeeder extends Seeder
{
    public function run()
    {
        DB::table('hewan')->insert([
            'id_admin' => 1,
            'id_kategori' => 1,
            'nama_kategori' => 'Kucing Persia',
            'nama_hewan' => 'Mochi',
            'umur' => 24,  // Ubah dari "2 tahun" menjadi angka bulan
            'gender' => 'Jantan',
            'ras' => 'Persia',
            'deskripsi' => 'Kucing lucu dan jinak.',
            'foto' => 'mochi.jpg',
            'status_adopsi' => 'Tersedia',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
