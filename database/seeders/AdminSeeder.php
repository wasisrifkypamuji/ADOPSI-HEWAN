<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('admin')->insert([
            [
                'username' => 'admin1',
                'email' => 'wasisrifkyp23@gmail.com',
                'password' => Hash::make('1234567890'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
