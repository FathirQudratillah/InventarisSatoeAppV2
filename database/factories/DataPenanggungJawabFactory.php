<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DataPenanggungJawab>
 */
class DataPenanggungJawabFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_pj' => strtoupper($this->faker->unique()->bothify('PJ##')),

            'nama' => $this->faker->name(),

            'nama_perusahaan' => $this->faker->company(),

            'alamat_perusahaan' => $this->faker->address(),

            'no_kontak' => $this->faker->numerify('08#########'),
        ];
    }
}
