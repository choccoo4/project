<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // Guard untuk Siswa
        'siswa' => [
            'driver' => 'session',
            'provider' => 'siswa',
        ],

        // Guard untuk Guru
        'guru' => [
            'driver' => 'session',
            'provider' => 'guru',
        ],

        // Guard untuk Admin
        'admin' => [
            'driver' => 'session',
            'provider' => 'admin',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // Provider untuk Siswa
        'siswa' => [
            'driver' => 'eloquent',
            'model' => App\Models\Siswa\Siswa::class,
        ],

        // Provider untuk Guru
        'guru' => [
            'driver' => 'eloquent',
            'model' => App\Models\Guru\Guru::class,
        ],

        // Provider untuk Admin
        'admin' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin\Admin::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'siswa' => [
            'provider' => 'siswa',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'guru' => [
            'provider' => 'guru',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'admin' => [
            'provider' => 'admin',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    */

    'password_timeout' => 10800,

];