<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User Admin
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => Hash::make('123456'),
        ]);

        // User Biasa
        DB::table('users')->insert([
            'name' => 'User Biasa',
            'email' => 'user@example.com',
            'role' => 'user',
            'password' => Hash::make('123456'),
        ]);
    }
}
