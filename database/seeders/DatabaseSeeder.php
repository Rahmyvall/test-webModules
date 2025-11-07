<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User; // pastikan modelnya di-import

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Jalankan seeder Roles terlebih dahulu
        $this->call(RolesTableSeeder::class);

        // Baru kemudian seed data users pakai Eloquent
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password123'),
            'role_id' => 1,
            'status' => 'active',
            'last_login_at' => Carbon::now(),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        User::create([
            'name' => 'User Biasa',
            'email' => 'user@gmail.com',
            'email_verified_at' => null,
            'password' => Hash::make('password123'),
            'role_id' => 2,
            'status' => 'inactive',
            'last_login_at' => null,
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}   