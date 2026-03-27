<?php

namespace Database\Seeders;

use App\Models\DataAkun;

use App\Models\DataAdmin;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DataAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = DataAkun::doesntHave('siswa')->where('user_id', 'ilike', 'ADMIN%')->get();

        foreach ($users as $user) {
            DataAdmin::factory()->create([
                'user_id' => $user->user_id,
                
            ]);
        }
    }
}
