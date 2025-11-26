<?php

namespace Database\Seeders;

use App\Models\Admin\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin Utama
        Admin::create([
            'email' => 'admin@algofun.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Super Admin
        Admin::create([
            'email' => 'superadmin@algofun.com',
            'password' => Hash::make('superadmin123'),
            'role' => 'admin',
        ]);

        echo "✅ Admin berhasil dibuat:\n";
        echo "   - admin@algofun.com | password: admin123\n";
        echo "   - superadmin@algofun.com | password: superadmin123\n";
    }
}