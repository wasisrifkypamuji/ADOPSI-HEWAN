<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class LaporanSeeder extends Seeder
{
    public function run()
    {
        DB::table('laporan')->insert([
            'user_id' => 1,
            'id_adopsi' => 1,
            'foto' => 'laporan_foto.jpg',
            'video' => 'laporan_video.mp4',
            'deskripsi' => 'Hewan terlihat sehat dan ceria.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}