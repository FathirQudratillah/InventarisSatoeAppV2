<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DataAdmin>
 */
class DataAdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nip' => $this->faker->unique()->numerify('##########'), // 10 digit

            'nama' => $this->faker->name(),

            'email' => $this->faker->unique()->safeEmail(),

            'no_kontak' => $this->faker->numerify('08##########'),

            'alamat' => $this->faker->address(),
        ];
    }
}
