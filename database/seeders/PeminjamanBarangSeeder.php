<?php

namespace Database\Seeders;

use App\Models\PeminjamanBarang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeminjamanBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PeminjamanBarang::factory()->count(10)->create();
    }
}
