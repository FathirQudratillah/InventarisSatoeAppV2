<?php

namespace Database\Factories;

use App\Models\DataKategoriBarang;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DataJenisBarang>
 */
class DataJenisBarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $kategori = DataKategoriBarang::inRandomOrder()->value('id_kategori');
        return [
            // PRIMARY KEY char(10)
            'jenis_barang' => $kategori . '-' . strtoupper($this->faker->unique()->lexify('???')),

            // Ambil random dari tabel kategori
            'id_kategori' => $kategori,

            'nama_barang' => $this->faker->words(10, true),

            

            'sumber' => $this->faker->randomElement([
                'APBN',
                'APBD',
                'BOS',
                'Donasi',
                'Hibah'
            ]),

            'spesifikasi' => $this->faker->sentence(10),

            'keterangan' => $this->faker->sentence(),
        ];
    }
}
