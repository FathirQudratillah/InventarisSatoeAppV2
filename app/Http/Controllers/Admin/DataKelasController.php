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
        return view('data-kelas.index', compact('akun'));
    }

    public function create()
    {
        $angkatan = DataAngkatan::all();
        $id_jurusan = DataJurusan::all();
        return view('data-kelas.create', compact('angkatan', 'id_jurusan'));
    }

    public function store(Request $request): RedirectResponse
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

            return redirect()->route('data-kelas.index')->with('success', 'Data kelas berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan data kelas!')->withInput();
        }
    }

    public function edit(string $id_kelas)
    {
        $kelas = DataKelas::findOrFail($id_kelas);
        $angkatan = DataAngkatan::all();
        $id_jurusan = DataJurusan::all();
        return view('data-kelas.edit', compact('kelas', 'angkatan', 'id_jurusan'));
    }

    public function update(Request $request, string $id_kelas): RedirectResponse
    {
        try {
            $kelas = DataKelas::findOrFail($id_kelas);

            $kelas->update([
                'kelas' => $request->kelas,
            ]);

            return redirect()->route('data-kelas.index')->with('success', 'Data kelas berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data kelas!')->withInput();
        }
    }

    public function destroy(string $id_kelas)
    {
        try {
            $kelas = DataKelas::findOrFail($id_kelas);
            $kelas->delete();

            return redirect()->route('data-kelas.index')->with('success', 'Data kelas berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data kelas!');
        }
    }
}
