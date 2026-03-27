<?php

namespace Database\Factories;

use App\Models\DataBarang;
use App\Models\DataPenanggungJawab;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PemeliharaanBarang>
 */
class PemeliharaanBarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pemeliharaan = DataBarang::inRandomOrder()->value('kode_barang');
        return [
            'id_pemeliharaan' => 'PMH-' . $pemeliharaan . '-' . fake()->numerify('##'),

            'kode_barang' => $pemeliharaan,

            'id_pj' => DataPenanggungJawab::inRandomOrder()->value('id_pj'),

            'kegiatan_pemeliharaan' => $this->faker->randomElement([
                'Servis Rutin',
                'Perbaikan',
                'Pembersihan',
                'Penggantian Sparepart'
            ]),

            'tanggal_pemeliharaan' => $this->faker->date(),

            'keterangan' => $this->faker->sentence(),
        ];
    }
}
