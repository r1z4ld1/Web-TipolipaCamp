<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            [
                'nama_kategori' => 'Tenda',
                'deskripsi' => 'Kategori untuk berbagai jenis tenda camping seperti tenda dome, tenda kapasitas kecil, dan tenda keluarga.',
                'status' => 'aktif',
            ],
            [
                'nama_kategori' => 'Sleeping Bag',
                'deskripsi' => 'Kategori untuk perlengkapan tidur outdoor seperti sleeping bag polar, waterproof, dan ultralight.',
                'status' => 'aktif',
            ],
            [
                'nama_kategori' => 'Carrier',
                'deskripsi' => 'Kategori untuk tas gunung atau carrier berbagai ukuran untuk kegiatan hiking dan camping.',
                'status' => 'aktif',
            ],
            [
                'nama_kategori' => 'Matras',
                'deskripsi' => 'Kategori untuk alas tidur camping seperti matras gulung, matras aluminium, dan matras inflatable.',
                'status' => 'aktif',
            ],
            [
                'nama_kategori' => 'Peralatan Masak',
                'deskripsi' => 'Kategori untuk perlengkapan masak outdoor seperti nesting cookware, kompor portable, panci, dan teko camping.',
                'status' => 'aktif',
            ],
            [
                'nama_kategori' => 'Penerangan',
                'deskripsi' => 'Kategori untuk alat penerangan seperti lampu camping, headlamp, dan lentera portable.',
                'status' => 'aktif',
            ],
            [
                'nama_kategori' => 'Furniture Camping',
                'deskripsi' => 'Kategori untuk perlengkapan duduk dan meja seperti kursi lipat, meja lipat, dan hammock.',
                'status' => 'aktif',
            ],
            [
                'nama_kategori' => 'Perlengkapan Outdoor',
                'deskripsi' => 'Kategori untuk perlengkapan pendukung outdoor seperti trekking pole, jas hujan, dan jaket outdoor.',
                'status' => 'aktif',
            ],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::updateOrCreate(
                ['slug' => Str::slug($kategori['nama_kategori'])],
                [
                    'nama_kategori' => $kategori['nama_kategori'],
                    'deskripsi' => $kategori['deskripsi'],
                    'status' => $kategori['status'],
                ]
            );
        }
    }
}