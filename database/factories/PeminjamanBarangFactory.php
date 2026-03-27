<?php

namespace Database\Factories;

use App\Models\DataAkun;
use App\Models\DataAdmin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PeminjamanBarang>
 */
class PeminjamanBarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        static $urutan = 1;

        $tanggal = now()->format('Ymd'); // 20260212

        return [
            'id_peminjaman' => 'PMJ' . $tanggal . str_pad($urutan++, 2, '0', STR_PAD_LEFT),

            'user_id' => DataAkun::inRandomOrder()->where('user_id', 'not like', 'ADMIN%')->value('user_id'),

            'data_admin' => DataAkun::inRandomOrder()->where('user_id', 'like', 'ADMIN%')->value('user_id'),

            'status_peminjaman' => fake()->randomElement([
                'Dipinjam',
                'Dikembalikan',
                'Terlambat'
            ]),

            'tanggal_peminjaman' => fake()->date(),

            'tanggal_pengembalian' => fake()->date(),
        ];
    }
}
