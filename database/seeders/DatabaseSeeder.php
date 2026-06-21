<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Ukm; // <-- Pastikan Model Ukm di-import
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // =========================================================
        // DATA UKM UTAMA (Biar ID 1, 2, dan 3 Terbuat Otomatis)
        // =========================================================
        $ukm1 = Ukm::updateOrCreate(
            ['id' => 1],
            [
                'nama_ukm' => 'UKM SERAMOE',
                'slug' => Str::slug('UKM SERAMOE'),
                'status' => 'aktif',
            ]
        );

        $ukm2 = Ukm::updateOrCreate(
            ['id' => 2],
            [
                'nama_ukm' => 'UKM LDF ULUL ALBAB',
                'slug' => Str::slug('UKM LDF ULUL ALBAB'),
                'status' => 'aktif',
            ]
        );

        $ukm3 = Ukm::updateOrCreate(
            ['id' => 3],
            [
                'nama_ukm' => 'UKM BARRACUDA',
                'slug' => Str::slug('UKM BARRACUDA'),
                'status' => 'aktif',
            ]
        );

        // =========================================================
        // DATA AKUN USER & ADMIN (Disertai password_plain)
        // =========================================================
        User::updateOrCreate(
            ['email' => 'superadmin@gmail.com'],
            [
                'name' => 'Super Admin FMIPA',
                'password' => Hash::make('admin123'),
                'password_plain' => 'admin123', // <-- Tambahkan ini
                'npm' => '000000', 
                'program_studi' => 'Fakultas MIPA', 
                'angkatan' => '2026', 
                'telepon' => '081111111111', 
                'role' => 'super_admin',
                'is_active' => true,
                'ukm_id' => null, // Super admin tidak terikat UKM spesifik
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin_seramoe@gmail.com'],
            [
                'name' => 'Admin UKM Seramoe',
                'password' => Hash::make('seuramoe123'),
                'password_plain' => 'seuramoe123', // <-- Tambahkan ini
                'npm' => '111111', 
                'program_studi' => 'Manajemen Informatika', 
                'angkatan' => '2023', 
                'telepon' => '082222222222', 
                'role' => 'admin_seramoe',
                'is_active' => true,
                'ukm_id' => 1, // Hubungkan ke ID Seramoe
            ]
        );

        // 3. ADMIN UKM LDF ULUL ALBAB (ID: 2)
        User::updateOrCreate(
            ['email' => 'admin_ulul_albab@gmail.com'],
            [
                'name' => 'Admin LDF Ulul Albab',
                'password' => Hash::make('ululalbab123'),
                'password_plain' => 'albab123',
                'npm' => '222222', 
                'program_studi' => 'Fisika', 
                'angkatan' => '2023', 
                'telepon' => '083333333333', 
                'role' => 'admin_ulul_albab', // Sesuai mapping AccountController Anda
                'is_active' => true,
                'ukm_id' => 2,
            ]
        );

        // 4. ADMIN UKM BARRACUDA (ID: 3)
        User::updateOrCreate(
            ['email' => 'admin_barracuda@gmail.com'],
            [
                'name' => 'Admin UKM Barracuda',
                'password' => Hash::make('barracuda123'),
                'password_plain' => 'barracuda123',
                'npm' => '333333', 
                'program_studi' => 'Ilmu Komputer', 
                'angkatan' => '2023', 
                'telepon' => '084444444444', 
                'role' => 'admin_barracuda', // Sesuai mapping AccountController Anda
                'is_active' => true,
                'ukm_id' => 3,
            ]
        );

        // 5. DATA ANGGOTA UJI COBA
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Tarry Devianti',
                'password' => Hash::make('123'),
                'password_plain' => '123',
                'npm' => '2308001010033', 
                'program_studi' => 'Manajemen Informatika D3', 
                'angkatan' => '2023', 
                'telepon' => '087747351474', 
                'role' => 'anggota',
                'is_active' => true,
                'ukm_id' => 1,
            ]
        );
    }
}


