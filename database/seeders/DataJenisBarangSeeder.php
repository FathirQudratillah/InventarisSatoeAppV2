<?php

namespace Database\Seeders;

use App\Models\DataJenisBarang;
use Illuminate\Database\Seeder;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DataJenisBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DataJenisBarang::factory()->count(10)->create();
    }
}
