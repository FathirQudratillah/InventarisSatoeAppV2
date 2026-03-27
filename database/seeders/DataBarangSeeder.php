<?php

namespace Database\Seeders;

use App\Models\DataBarang;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DataBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DataBarang::factory()->count(20)->create();
    }
}
