<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FirstUserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'Mashiyyat',
            'email' => 'delossantos.mash@gmail.com',
            'password' => Hash::make('11111111')
        ]);
    }
}
