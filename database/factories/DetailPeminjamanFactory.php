<?php

namespace Database\Factories;

use App\Models\DataBarang;
use App\Models\PeminjamanBarang;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailPeminjaman>
 */
class DetailPeminjamanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $urutan = 1;
        $peminjaman = PeminjamanBarang::inRandomOrder()->value('id_peminjaman');

        return [
            'id_detail' => 'DTL' . $peminjaman . fake()->unique()->numerify('##'),

            'kode_barang' => DataBarang::inRandomOrder()->value('kode_barang'),

            'id_peminjaman' => PeminjamanBarang::inRandomOrder()->value('id_peminjaman'),

            'kondisi_sebelum' => fake()->randomElement([
                'Baik',
                'Rusak'
            ]),

            'kondisi_sesudah' => fake()->randomElement([
                'Baik',
                'Rusak'
            ]),
        ];
    }
}
