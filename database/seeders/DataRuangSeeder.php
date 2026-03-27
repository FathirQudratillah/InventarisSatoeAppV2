<?php

namespace Database\Seeders;

use App\Models\DataRuang;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DataRuangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ruangs = [
            ['id_ruang' => 'GDA01', 'nama_ruang' => 'A1', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung A'],
            ['id_ruang' => 'GDA02', 'nama_ruang' => 'A2', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung A'],
            ['id_ruang' => 'GDA03', 'nama_ruang' => 'A3', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung A'],
            ['id_ruang' => 'GDA04', 'nama_ruang' => 'A4', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung A'],
            ['id_ruang' => 'GDA05', 'nama_ruang' => 'A5', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung A'],
            ['id_ruang' => 'GDA06', 'nama_ruang' => 'A6', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung A'],

            ['id_ruang' => 'GDB01', 'nama_ruang' => 'B1', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung B'],
            ['id_ruang' => 'GDB02', 'nama_ruang' => 'B2', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung B'],
            
            ['id_ruang' => 'GDC01', 'nama_ruang' => 'C1', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung C'],
            ['id_ruang' => 'GDC02', 'nama_ruang' => 'C2', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung C'],
            ['id_ruang' => 'GDC03', 'nama_ruang' => 'C3', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung C'],
            ['id_ruang' => 'GDC04', 'nama_ruang' => 'C4', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung C'],
            ['id_ruang' => 'GDC05', 'nama_ruang' => 'C5', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung C'],
            ['id_ruang' => 'GDC06', 'nama_ruang' => 'C6', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung C'],

            ['id_ruang' => 'GDD01', 'nama_ruang' => 'D1', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung D'],
            ['id_ruang' => 'GDD02', 'nama_ruang' => 'D2', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung D'],
            ['id_ruang' => 'GDD03', 'nama_ruang' => 'D3', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung D'],
            ['id_ruang' => 'GDD04', 'nama_ruang' => 'D4', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung D'],
            ['id_ruang' => 'GDD05', 'nama_ruang' => 'D5', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung D'],
            ['id_ruang' => 'GDD06', 'nama_ruang' => 'D6', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung D'],
            ['id_ruang' => 'GDD07', 'nama_ruang' => 'D7', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung D'],
            ['id_ruang' => 'GDD08', 'nama_ruang' => 'D8', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung D'],
            ['id_ruang' => 'GDD09', 'nama_ruang' => 'D9', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung D'],
            ['id_ruang' => 'GDD10', 'nama_ruang' => 'D10', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung D'],
            ['id_ruang' => 'GDD11', 'nama_ruang' => 'D11', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung D'],
            ['id_ruang' => 'GDD12', 'nama_ruang' => 'D12', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung D'],

            ['id_ruang' => 'GDE01', 'nama_ruang' => 'E1', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung E'],
            ['id_ruang' => 'GDE02', 'nama_ruang' => 'E2', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung E'],
            ['id_ruang' => 'GDE03', 'nama_ruang' => 'E3', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung E'],
            ['id_ruang' => 'GDE04', 'nama_ruang' => 'E4', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung E'],

            ['id_ruang' => 'GDF01', 'nama_ruang' => 'F1', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung F'],
            ['id_ruang' => 'GDF02', 'nama_ruang' => 'F2', 'jenis_ruang' => 'Ruang Kelas', 'kapasitas' => '36', 'lokasi' => 'Gedung F'],
            
            ['id_ruang' => 'RPL01', 'nama_ruang' => 'LAB RPL 01', 'jenis_ruang' => 'Ruang Praktek', 'kapasitas' => '36', 'lokasi' => 'Gedung D'],
            ['id_ruang' => 'RPL02', 'nama_ruang' => 'LAB RPL 02', 'jenis_ruang' => 'Ruang Praktek', 'kapasitas' => '36', 'lokasi' => 'Gedung D'],
            ['id_ruang' => 'RPL03', 'nama_ruang' => 'BLUD RPL', 'jenis_ruang' => 'Ruang Praktek', 'kapasitas' => '36', 'lokasi' => 'Gedung D'],
            
            ['id_ruang' => 'TKJ01', 'nama_ruang' => 'LAB TKJ 01', 'jenis_ruang' => 'Ruang Praktek', 'kapasitas' => '36', 'lokasi' => 'Gedung D'],
            ['id_ruang' => 'TKJ02', 'nama_ruang' => 'LAB TKJ 02', 'jenis_ruang' => 'Ruang Praktek', 'kapasitas' => '36', 'lokasi' => 'Gedung D'],
            ['id_ruang' => 'TKJ03', 'nama_ruang' => 'BLUD TKJ', 'jenis_ruang' => 'Ruang Praktek', 'kapasitas' => '36', 'lokasi' => 'Gedung D'],

            ['id_ruang' => 'DKV01', 'nama_ruang' => 'LAB DKV 01', 'jenis_ruang' => 'Ruang Praktek', 'kapasitas' => '36', 'lokasi' => 'Gedung Multimedia'],
            ['id_ruang' => 'DKV02', 'nama_ruang' => 'LAB DKV 02', 'jenis_ruang' => 'Ruang Praktek', 'kapasitas' => '36', 'lokasi' => 'Gedung Multimedia'],
            
            ['id_ruang' => 'DPB01', 'nama_ruang' => 'LAB DPB 01', 'jenis_ruang' => 'Ruang Praktek', 'kapasitas' => '36', 'lokasi' => 'Gedung E'],
            
            ['id_ruang' => 'AKN01', 'nama_ruang' => 'LAB AKN 01', 'jenis_ruang' => 'Ruang Praktek', 'kapasitas' => '36', 'lokasi' => 'Gedung Akuntansi'],
            
            ['id_ruang' => 'TKR01', 'nama_ruang' => 'BENGKEL OTOMOTIF', 'jenis_ruang' => 'Ruang Praktek', 'kapasitas' => '100', 'lokasi' => 'GEDUNG OTOMOTIF'],
            
            ['id_ruang' => 'TPM01', 'nama_ruang' => 'BENGKEL PERMESINAN', 'jenis_ruang' => 'Ruang Praktek', 'kapasitas' => '100', 'lokasi' => 'GEDUNG PERMESINAN'],
            
            ['id_ruang' => 'TPL01', 'nama_ruang' => 'BENGKEL PENGELASAN', 'jenis_ruang' => 'Ruang Praktek', 'kapasitas' => '100', 'lokasi' => 'GEDUNG C'],
            
            ];


        foreach ($ruangs as $ruang) {
            DataRuang::updateOrCreate(
                ['id_ruang' => $ruang['id_ruang']],
                [
                    'nama_ruang' => $ruang['nama_ruang'],
                    'jenis_ruang' => $ruang['jenis_ruang'],
                    'kapasitas' => $ruang['kapasitas'],
                    'lokasi' => $ruang['lokasi'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
