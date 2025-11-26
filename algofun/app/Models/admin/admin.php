<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Nama tabel di database
     */
    protected $table = 'admin';

    /**
     * Guard name untuk authentication
     */
    protected $guard = 'admin';

    /**
     * Field yang boleh diisi mass assignment
     */
    protected $fillable = [
        'email',
        'password',
        'role',
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
        'role' => 'admin',
    ];

    /**
     * Get guard name
     */
    public function getGuardName()
    {
        return 'admin';
    }
}