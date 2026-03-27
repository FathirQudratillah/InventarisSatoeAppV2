<?php

namespace Database\Seeders;

use App\Models\DataAkun;
use App\Models\DataKelas;
use App\Models\DataJurusan;
use App\Models\DataAngkatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DataAkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DataAkun::factory()->count(10)->state(function () {
            $number = fake()->unique()->numberBetween(1,36);
            return [
                'user_id' => 'SI' . DataAngkatan::inRandomOrder()->value('angkatan') . DataJurusan::inRandomOrder()->value('id_jurusan') . DataKelas::inRandomOrder()->value('subkelas') .  str_pad($number, 2, '0', STR_PAD_LEFT),
                'username' => fake()->name(),
                'password' => Hash::make('password'),
                'role' => 'siswa',
            ];
        })->create();

        // 10 user GU
        DataAkun::factory()->count(10)->state(function () {
            return [
                'user_id' => 'GU' . fake()->unique()->numerify('########'),
                'username' => fake()->name(),
                'password' => Hash::make('password'),
                'role' => 'guru',
            ];
        })->create();

        DataAkun::factory()->count(5)->state(function () {
            return [
                'user_id' => 'ADMIN' . fake()->unique()->numerify('#####'),
                'username' => fake()->name(),
                'password' => Hash::make('password'),
                'role' => 'admin',
            ];
        })->create();
    }
}
