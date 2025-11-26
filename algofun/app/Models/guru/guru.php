<?php

namespace App\Models\Guru;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Guru extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Nama tabel di database
     */
    protected $table = 'guru';

    /**
     * Guard name untuk authentication
     */
    protected $guard = 'guru';

    /**
     * Field yang boleh diisi mass assignment
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
        'foto_profil',
        'NIP',
        'nama_lengkap',
        'nama_sekolah',
        'google_id',
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
    ];

    /**
     * Default values untuk field tertentu
     */
    protected $attributes = [
        'role' => 'guru',
    ];

    /**
     * Get guard name
     */
    public function getGuardName()
    {
        return 'guru';
    }

    /**
     * Check jika profil sudah lengkap
     */
    public function isProfileComplete()
    {
        return !empty($this->nama_lengkap) && 
               !empty($this->nama_sekolah) && 
               !empty($this->NIP);
    }

    /**
     * Get foto profil URL
     */
    public function getFotoProfilUrl()
    {
        if ($this->foto_profil) {
            // Jika foto profil ada di storage
            if (file_exists(public_path('storage/' . $this->foto_profil))) {
                return asset('storage/' . $this->foto_profil);
            }
            // Jika foto profil adalah URL (dari Google)
            if (filter_var($this->foto_profil, FILTER_VALIDATE_URL)) {
                return $this->foto_profil;
            }
        }
        
        // Default foto profil jika belum ada
        return asset('images/default-teacher.png');
    }
}