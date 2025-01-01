<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class pertanyaan extends Seeder
{

    public function run(): void
    {
        DB::table('pertanyaan')->insert([
            'q1' => 'karena saya butuh',
            'q2' => 'senormalnya',
            'q3' => 'tidak',
            'q4' => 'sangat ramah',
            'q5' => 'saya sendiri',
            'q6' => 'teratur sesuai takaran',
            'q7' => 'ada',
            'q8' => 'bawa kerumah sakit',
            'q9' => 'ya',
            'surat_perjanjian' => 'perjanjian.pdf',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
