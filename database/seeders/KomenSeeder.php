<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KomenSeeder extends Seeder
{
    public function run()
    {
        DB::table('komen')->insert([
            'user_id' => 1,
            'id_admin' => 1,
            'username' => 'agus',
            'foto' => 'komen_foto.jpg',
            'video' => 'komen_video.mp4',
            'komen' => 'Kucing ini sangat lucu!',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
