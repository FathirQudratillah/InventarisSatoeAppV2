<?php

namespace Database\Seeders;

use App\Models\PemeliharaanBarang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PemeliharaanBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PemeliharaanBarang::factory()->count(10)->create();
    }
}
