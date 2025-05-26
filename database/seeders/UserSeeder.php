<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'nama' => 'Bendahara Admin',
            'username' => 'bendahara',
            'email' => 'bendahara@example.com',
            'password' => Hash::make('password'),
            'jabatan' => 'Bendahara',
            'divisi' => 'Keuangan',
            'role' => 'bendahara',
        ]);

        User::create([
            'nama' => 'Pegawai Biasa',
            'username' => 'user1',
            'email' => 'user1@example.com',
            'password' => Hash::make('password'),
            'jabatan' => 'Staff',
            'divisi' => 'Umum',
            'role' => 'user',
        ]);
    }
}

