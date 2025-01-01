<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KirimHewanSeeder extends Seeder
{
    public function run()
    {
        DB::table('kirim_hewans')->insert([
            'id_admin' => 1,
            'user_id' => 1,
            'id_kategori' => 1,
            'nama_kategori' => 'Kucing Persia',
            'nama_lengkap' => 'agus',
            'nama_hewan' => 'Mochi',
            'deskripsi' => 'Kucing lucu dan sehat.',
            'usia' => '2 tahun',
            'gender' => 'Jantan',
            'foto' => 'mochi.jpg',
            'video' => 'mochi_video.mp4',
            'surat_perjanjian' => 'Setuju dengan aturan.',
            'surat_keterangan_sehat' => 'Kondisi sehat berdasarkan dokter.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
