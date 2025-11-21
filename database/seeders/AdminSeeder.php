<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 100,
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'is_admin' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}