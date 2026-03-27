<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DataSiswa>
 */
class DataSiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        

        return [
            'nis' => $this->faker->unique()->numerify('##########'), // 10 digit

            'nama' => $this->faker->name(),
            'no_absen' => $this->faker->numerify('##'),

            'email' => $this->faker->unique()->safeEmail(),

            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),

            'no_kontak' => $this->faker->numerify('08##########'),

            'alamat' => $this->faker->address(),
        ];
    }
}
