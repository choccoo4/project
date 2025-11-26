<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // ============================================
        // TABEL SISWA
        // ============================================
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            
            // WAJIB DIISI SAAT REGISTER
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['siswa'])->default('siswa');
            
            // NULLABLE - Diisi nanti di halaman profil
            $table->string('nama_pengguna')->nullable();
            $table->string('nama_sekolah')->nullable();
            $table->unsignedBigInteger('id_sekolah')->nullable();
            $table->string('nama_lengkap')->nullable();
            
            // Field untuk game progress
            $table->integer('level_terakhir')->default(1);
            $table->integer('hari_berturut_aktif')->default(0);
            $table->integer('total_xp')->default(0);
            
            // Google OAuth
            $table->string('google_id')->nullable()->unique();
            $table->string('avatar')->nullable();
            
            $table->rememberToken();
            $table->timestamps();
        });

        // ============================================
        // TABEL GURU
        // ============================================
        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            
            // WAJIB DIISI SAAT REGISTER
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['guru'])->default('guru');
            
            // NULLABLE - Diisi nanti di halaman profil
            $table->string('foto_profil')->nullable();
            $table->string('NIP')->nullable();
            $table->string('nama_lengkap')->nullable();
            $table->string('nama_sekolah')->nullable();
            
            // Google OAuth
            $table->string('google_id')->nullable()->unique();
            
            $table->rememberToken();
            $table->timestamps();
        });

        // ============================================
        // TABEL ADMIN
        // ============================================
        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            
            // WAJIB DIISI
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['admin'])->default('admin');
            
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
        Schema::dropIfExists('guru');
        Schema::dropIfExists('admin');
    }
};