<?php

namespace Database\Seeders;


use App\Models\DataPenanggungJawab;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataPenanggungJawabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DataPenanggungJawab::factory()->count(10)->create();
    }
}
