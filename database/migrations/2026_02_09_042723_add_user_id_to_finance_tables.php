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
        // Tambah user_id ke tabel saldo
        Schema::table('saldos', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->after('id');
        });

        // Tambah user_id ke tabel uang_masuk
        Schema::table('uang_masuks', function (Blueprint $table) {
            if (!Schema::hasColumn('uang_masuks', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->after('id');
            }
        });

        // Tambah user_id ke tabel uang_keluar
        Schema::table('uang_keluars', function (Blueprint $table) {
            if (!Schema::hasColumn('uang_keluars', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->after('id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('saldos', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
        Schema::table('uang_masuks', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
        Schema::table('uang_keluars', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
};
