<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('Memulai proses seeding database...');

        // ================================================
        // 1. Buat Akun Administrator
        // ================================================
        User::create([
            'name' => 'Administrator Fintrack',
            'email' => 'admin@fintrack.com',
            'password' => Hash::make('password'), // Gunakan Hash untuk keamanan
            'role' => 'admin',
            'telepon' => '08123456789',
            'email_verified_at' => now(),
        ]);
        $this->command->info('Akun Admin berhasil dibuat: admin@fintrack.com');

        // ================================================
        // 2. Buat Akun Pengguna Biasa (Untuk Testing)
        // ================================================
        User::create([
            'name' => 'tes',
            'email' => 'tes@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'pengguna',
            'telepon' => '08987654321',
            'email_verified_at' => now(),
        ]);
        $this->command->info('Akun Pengguna berhasil dibuat: tes@gmail.com');

        $this->command->newLine();
        $this->command->info('Database seeding selesai!');
    }
}