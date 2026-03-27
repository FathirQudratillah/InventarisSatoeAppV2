<?php

namespace Database\Factories;

use App\Models\DataAngkatan;
use App\Models\DataJurusan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DataKelas>
 */
class DataKelasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jurusan = DataJurusan::all();
        $angkatan = DataAngkatan::all();
        $kelas = fake()->randomElement('10', '11', '12');
        $subkelas = fake()->randomElement('A', 'B');
        return [
            'id_kelas' => $angkatan . $jurusan . $subkelas,
            'jurusan' => $jurusan,
            'angkatan' => $angkatan,
            'kelas' => $kelas,
            'subkelas' => $subkelas,
        ];
    }
}
