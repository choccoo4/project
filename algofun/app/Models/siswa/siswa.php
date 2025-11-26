<?php

namespace App\Models\Siswa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Nama tabel di database
     */
    protected $table = 'siswa';

    /**
     * Guard name untuk authentication
     */
    protected $guard = 'siswa';

    /**
     * Field yang boleh diisi mass assignment
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'nama_pengguna',
        'nama_sekolah',
        'id_sekolah',
        'nama_lengkap',
        'level_terakhir',
        'hari_berturut_aktif',
        'total_xp',
        'google_id',
        'avatar',
    ];

    /**
     * Field yang disembunyikan saat serialization
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'level_terakhir' => 'integer',
        'hari_berturut_aktif' => 'integer',
        'total_xp' => 'integer',
        'id_sekolah' => 'integer',
    ];

    /**
     * Default values untuk field tertentu
     */
    protected $attributes = [
        'role' => 'siswa',
        'level_terakhir' => 1,
        'hari_berturut_aktif' => 0,
        'total_xp' => 0,
    ];

    /**
     * Get guard name
     */
    public function getGuardName()
    {
        return 'siswa';
    }

    /**
     * Check jika profil sudah lengkap
     */
    public function isProfileComplete()
    {
        return !empty($this->nama_pengguna) && 
               !empty($this->nama_lengkap) && 
               !empty($this->nama_sekolah);
    }

    /**
     * Get avatar URL
     */
    public function getAvatarUrl()
    {
        if ($this->avatar) {
            return $this->avatar;
        }
        
        // Default avatar jika belum ada
        return asset('images/default-avatar.png');
    }
}