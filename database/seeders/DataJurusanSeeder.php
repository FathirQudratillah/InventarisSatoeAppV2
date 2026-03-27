<?php

namespace Database\Seeders;

use App\Models\DataJurusan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DataJurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jurusan = [
            ['id_jurusan' => 'RPL', 'jurusan' => 'Rekayasa Perangkat Lunak'],
            ['id_jurusan' => 'TKJ', 'jurusan' => 'Teknik Komputer dan Jaringan'],
            ['id_jurusan' => 'TKR', 'jurusan' => 'Teknik Kendaraan Ringan'],
            ['id_jurusan' => 'TPM',  'jurusan' => 'Teknik Pemesinan'],
            ['id_jurusan' => 'TPL', 'jurusan' => 'Teknik Pengelasan'],
            ['id_jurusan' => 'DKV', 'jurusan' => 'Desain Komunikasi Visual'],
            ['id_jurusan' => 'DPB', 'jurusan' => 'Desain dan Produksi Busana'],
            ['id_jurusan' => 'AKN',  'jurusan' => 'Akuntansi'],
        ];

        foreach ($jurusan as $data) {
            DataJurusan::updateOrCreate(
                ['id_jurusan' => $data['id_jurusan']],
                [
                    'jurusan' => $data['jurusan'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
