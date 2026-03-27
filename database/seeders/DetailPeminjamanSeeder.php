<?php

namespace Database\Seeders;

use App\Models\DetailPeminjaman;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailPeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DetailPeminjaman::factory()->count(10)->create();
    }
}
