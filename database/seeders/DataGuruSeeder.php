<?php

namespace Database\Seeders;

use App\Models\DataAkun;
use App\Models\DataGuru;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DataGuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = DataAkun::doesntHave('siswa')->where('user_id', 'like', 'GU%')->get();

        foreach ($users as $user) {
            DataGuru::factory()->create([
                'user_id' => $user->user_id,
                
            ]);
        }
        
    }
}
