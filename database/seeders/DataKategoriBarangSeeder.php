<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataKategoriBarang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DataKategoriBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            ['id_kategori' => 'LAP', 'kategori' => 'Laptop'],
            ['id_kategori' => 'PRO', 'kategori' => 'Proyektor'],
            ['id_kategori' => 'MEJ', 'kategori' => 'Meja'],
            ['id_kategori' => 'BAN',  'kategori' => 'Bangku'],
            ['id_kategori' => 'KOM', 'kategori' => 'KOM'],
            ['id_kategori' => 'WIF', 'kategori' => 'Wifi'],
        ];

        foreach ($kategoris as $kategori) {
            DataKategoriBarang::updateOrCreate(
                ['id_kategori' => $kategori['id_kategori']],
                [
                    'kategori' => $kategori['kategori'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
