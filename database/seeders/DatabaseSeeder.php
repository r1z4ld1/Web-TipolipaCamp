<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RolePermissionSeeder::class);

        $admin = User::firstOrCreate(
            ['email' => 'admin@camping.com'],
            [
                'name' => 'Admin Camping',
                'password' => Hash::make('password'),
            ]
        );
        $admin->syncRoles(['Admin']);

        $petugas = User::firstOrCreate(
            ['email' => 'petugas@camping.com'],
            [
                'name' => 'Petugas Camping',
                'password' => Hash::make('password'),
            ]
        );
        $petugas->syncRoles(['Petugas']);

        $owner = User::firstOrCreate(
            ['email' => 'owner@camping.com'],
            [
                'name' => 'Owner Camping',
                'password' => Hash::make('password'),
            ]
        );
        $owner->syncRoles(['Owner']);

        $penyewa = User::firstOrCreate(
            ['email' => 'penyewa@camping.com'],
            [
                'name' => 'Penyewa Camping',
                'password' => Hash::make('password'),
            ]
        );
        $penyewa->syncRoles(['Penyewa']);
    }
}