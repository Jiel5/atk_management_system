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
            'jabatan' => 'Panitera Pengadilan Negeri Kudus',
            'role' => 'bendahara',
            'nip' => '1234567890',
            'no_hp' => '081234567890',
        ]);

        User::create([
            'nama' => 'Pegawai Biasa',
            'username' => 'user1',
            'email' => 'user1@example.com',
            'password' => Hash::make('password'),
            'jabatan' => 'Panitera Pengadilan Negeri Kudus',
            'role' => 'user',
            'nip' => '0987654321',
            'no_hp' => '089876543210',
        ]);
    }
}
