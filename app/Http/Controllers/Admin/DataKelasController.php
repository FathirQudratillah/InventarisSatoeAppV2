<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\DataAngkatan;
use App\Models\DataJurusan;
use App\Models\DataKelas;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DataKelasController extends Controller
{
    public function index()
    {
        $akun = DataKelas::orderBy('angkatan', 'desc')
            ->orderBy('id_jurusan')
            ->orderBy('subkelas')->get();
        return response()->json([
            'akun' => $akun,
        ]);
    }

    public function create()
    {
        $angkatan = DataAngkatan::select('angkatan')->get();
        $id_jurusan = DataJurusan::select('id_jurusan')->get();
        return response()->json([
            'angkatan' => $angkatan,
            'id_jurusan' => $id_jurusan,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $id_kelas = $request->angkatan . $request->id_jurusan . $request->subkelas;
            $uniqueKelas = DataKelas::where('id_kelas', $id_kelas)->exists();

            if($uniqueKelas){
                return redirect()->back()->with('error', 'Kelas Sudah Terdaftar')->withInput();
            }


            $kelas = new DataKelas;
            $kelas->id_kelas = $id_kelas;
            $kelas->id_jurusan = $request->id_jurusan;
            $kelas->angkatan = $request->angkatan;
            $kelas->kelas = $request->kelas;
            $kelas->subkelas = $request->subkelas;
            $kelas->save();

            return response()->json([
                'message' => 'Data kelas berhasil ditambahkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menambahkan data kelas!'
            ]);
        }
    }

    public function edit(string $id_kelas)
    {
        $kelas = DataKelas::findOrFail($id_kelas);
        $angkatan = DataAngkatan::all();
        $id_jurusan = DataJurusan::all();
        return response()->json([
            'kelas' => $kelas,
            'angkatan' => $angkatan,
            'id_jurusan' => $id_jurusan,
        ]);
    }

    public function update(Request $request, string $id_kelas)
    {
        try {
            $kelas = DataKelas::findOrFail($id_kelas);

            $kelas->update([
                'kelas' => $request->kelas,
            ]);
            return response()->json([
                'message' => 'Data kelas berhasil diperbarui!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal memperbarui data kelas!'
            ]);
        }
    }

    public function destroy(string $id_kelas)
    {
        try {
            $kelas = DataKelas::findOrFail($id_kelas);
            $kelas->delete();

            return response()->json([
                'message' => 'Data kelas berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus data kelas!'
            ]);
        }
    }
}
