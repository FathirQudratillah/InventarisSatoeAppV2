<?php

namespace Database\Seeders;

use App\Models\DataAkun;
use App\Models\DataKelas;
use App\Models\DataSiswa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DataSiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = DataAkun::doesntHave('siswa')->where('user_id', 'like', 'SI%')->get();

        foreach ($users as $user) {
            DataSiswa::factory()->create([
                'user_id' => $user->user_id,
                'id_kelas' => DataKelas::inRandomOrder()->value('id_kelas'),
            ]);
        }
        }
}
