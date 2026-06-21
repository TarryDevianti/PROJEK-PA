<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // <-- TAMBAHKAN BARIS INI
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'         => 'Muhammad Ikram',
            'npm'          => '22080010101059',
            'email'        => 'ikram@example.com',
            'password'     => bcrypt('17040565'),
            'role'         => 'Admin Pengurus',
            'ukm_kategori' => 'Seuramoe',
            'is_active'    => true, // Tambahkan ini jika kamu mengikuti migrasi blokir tadi
        ]);

        // Tambahkan satu data lagi untuk ngetes tampilan seperti di gambar
        User::create([
            'name'         => 'Tarry Devianti',
            'npm'          => '23080010101033',
            'email'        => 'tarry@example.com',
            'password'     => bcrypt('52534589'),
            'role'         => 'Anggota',
            'ukm_kategori' => 'LDF ULUL ALBAB',
            'is_active'    => true,
        ]);
    }
}