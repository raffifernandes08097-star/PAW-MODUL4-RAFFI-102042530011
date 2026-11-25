<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(AdminSeeder::class);

        $daftarBuku = [
            [
                'judul'        => 'Pemrograman Laravel',
                'penulis'      => 'Taylor Otwell',
                'penerbit'     => 'Informatika',
                'tahun_terbit' => 2023,
                'stok'         => 10,
                'cover'        => null,
            ],
            [
                'judul'        => 'Basis Data',
                'penulis'      => 'Fathansyah',
                'penerbit'     => 'Informatika Bandung',
                'tahun_terbit' => 2022,
                'stok'         => 5,
                'cover'        => null,
            ],
            [
                'judul'        => 'Algoritma dan Pemrograman',
                'penulis'      => 'Rinaldi Munir',
                'penerbit'     => 'Informatika',
                'tahun_terbit' => 2021,
                'stok'         => 7,
                'cover'        => null,
            ],
            [
                'judul'        => 'Rekayasa Perangkat Lunak',
                'penulis'      => 'Rosa A.S',
                'penerbit'     => 'Modula',
                'tahun_terbit' => 2020,
                'stok'         => 0,
                'cover'        => null,
            ],
            [
                'judul'        => 'Sistem Informasi Manajemen',
                'penulis'      => 'Raymond McLeod',
                'penerbit'     => 'Salemba Empat',
                'tahun_terbit' => 2021,
                'stok'         => 4,
                'cover'        => null,
            ],
            [
                'judul'        => 'Clean Code',
                'penulis'      => 'Robert C. Martin',
                'penerbit'     => 'Prentice Hall',
                'tahun_terbit' => 2019,
                'stok'         => 3,
                'cover'        => null,
            ],
        ];

        foreach ($daftarBuku as $buku) {
            Buku::firstOrCreate(['judul' => $buku['judul']], $buku);
        }
    }
}