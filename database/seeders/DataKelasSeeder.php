<?php

namespace Database\Seeders;

use App\Models\DataAngkatan;
use App\Models\DataJurusan;
use App\Models\DataKelas;
use Illuminate\Database\Seeder;

class DataKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $angkatans = DataAngkatan::all();
        $jurusans = DataJurusan::all();
        $subkelass = ['A', 'B'];


        $mapping = [
            '27' => '10',
            '28' => '11',
            '29' => '12',
        ];

        foreach ($angkatans as $angkatan) {

            $kelas = $mapping[$angkatan->angkatan] ?? 'Alumni';

            foreach ($jurusans as $jurusan) {
                foreach ($subkelass as $subkelas) {

                    DataKelas::updateOrCreate(
                        ['id_kelas' => $angkatan->angkatan . $jurusan->id_jurusan . $subkelas],
                        [
                            'id_jurusan' => $jurusan->id_jurusan,
                            'angkatan' => $angkatan->angkatan,
                            'kelas' => $kelas,
                            'subkelas' => $subkelas,
                        ]
                    );
                }
            }
        }
    }
}
