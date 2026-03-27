<?php

namespace Database\Seeders;

use App\Models\DataAngkatan;
use Illuminate\Database\Seeder;


class DataAngkatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $angkatanTerakhir = 29;
        $tahunMasukTerakhir = 2025;

        for ($i = 1; $i <= 29; $i++) {

            // Hitung selisih dari angkatan 29
            $selisih = $angkatanTerakhir - $i;

            $tahunMasuk = $tahunMasukTerakhir - $selisih;
            $tahunLulus = $tahunMasuk + 3;

            DataAngkatan::updateOrCreate(
                ['angkatan' => str_pad($i, 2, '0', STR_PAD_LEFT)],
                [
                    'tahun_masuk' => $tahunMasuk,
                    'tahun_lulus' => $tahunLulus,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
