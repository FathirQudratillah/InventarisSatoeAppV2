<?php

namespace Database\Factories;

use App\Models\DataRuang;
use App\Models\DataJenisBarang;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DataBarang>
 */
class DataBarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jenis = DataJenisBarang::inRandomOrder()->value('jenis_barang');
        return [
            // CHAR(11) PRIMARY KEY
            'kode_barang' => $jenis . '-' . fake()->unique()->numerify('##'),

            // Foreign Keys (ambil random dari tabel terkait)
            'id_ruang' => DataRuang::inRandomOrder()->value('id_ruang'),

            'jenis_barang' => $jenis,

            

            'kondisi_barang' => $this->faker->randomElement([
                'Baik',
                'Rusak',
                'Perbaikan',
                'Baru'
            ]),

            'tahun_perolehan' => $this->faker->numberBetween(2015, 2025),

            'keterangan' => $this->faker->sentence(),
        ];
    }
}
