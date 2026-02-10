<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Role: admin atau pengguna
            // Default adalah 'pengguna' agar user baru otomatis jadi pengguna biasa
            $table->enum('role', ['admin', 'pengguna'])
                ->default('pengguna')
                ->after('password'); // Posisi kolom setelah password

            // Nomor telepon
            $table->string('telepon', 20)
                ->nullable()
                ->after('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus kolom jika migration di-rollback
            $table->dropColumn(['role', 'telepon']);
        });
    }
};
