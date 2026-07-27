<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            // Dashboard
            'dashboard.index',

            // Manajemen user
            'user.index',
            'user.create',
            'user.edit',
            'user.delete',

            // Manajemen role
            'role.index',
            'role.create',
            'role.edit',
            'role.delete',

            // Manajemen permission
            'permission.index',
            'permission.create',
            'permission.edit',
            'permission.delete',

            // Kategori alat camping
            'kategori.index',
            'kategori.create',
            'kategori.edit',
            'kategori.delete',

            // Barang / alat camping
            'barang.index',
            'barang.create',
            'barang.edit',
            'barang.delete',

            // Penyewaan
            'penyewaan.index',
            'penyewaan.create',
            'penyewaan.edit',
            'penyewaan.delete',
            'penyewaan.status',

            // Pengembalian
            'pengembalian.index',
            'pengembalian.create',
            'pengembalian.edit',
            'pengembalian.delete',

            // Laporan
            'laporan.index',
            'laporan.cetak',
            'laporan.export',

            // Fitur penyewa
            'alat.index',
            'sewa.create',
            'sewa.riwayat',
            'sewa.status',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $admin = Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => 'web',
        ]);

        $petugas = Role::firstOrCreate([
            'name' => 'Petugas',
            'guard_name' => 'web',
        ]);

        $owner = Role::firstOrCreate([
            'name' => 'Owner',
            'guard_name' => 'web',
        ]);

        $penyewa = Role::firstOrCreate([
            'name' => 'Penyewa',
            'guard_name' => 'web',
        ]);

        // Admin: akses penuh semua fitur
        $admin->syncPermissions($permissions);

        // Petugas: operasional alat, penyewaan, pengembalian, dan laporan terbatas
        $petugas->syncPermissions([
            'dashboard.index',

            'kategori.index',

            'barang.index',
            'barang.create',
            'barang.edit',

            'penyewaan.index',
            'penyewaan.edit',
            'penyewaan.status',

            'pengembalian.index',

            'laporan.index',
            'laporan.cetak',
        ]);

        // Owner: hanya pantau dashboard dan laporan
        $owner->syncPermissions([
            'dashboard.index',

            'laporan.index',
            'laporan.cetak',
            'laporan.export',
        ]);

        // Penyewa: melihat alat, mengajukan sewa, dan melihat riwayat sewa sendiri
        $penyewa->syncPermissions([
            'alat.index',
            'sewa.create',
            'sewa.riwayat',
            'sewa.status',
        ]);

        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}