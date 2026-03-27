<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\DataSiswa;
use Illuminate\Http\Request;
use app\Models\DataAkun;
use app\Models\DataKelas;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DataSiswaController extends Controller
{
    public function index()
    {
        $siswas = DataSiswa::All();
        return view('data-siswa.index', compact('siswas'));
    }

    public function create()
    {
        $user_id = DataAkun::all();
        $id_kelas = DataKelas::all();
        return view('data-siswa.create', compact('user_id', 'id_kelas'));
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $siswa = new DataSiswa;
            $siswa->nis = $request->nis;
            $siswa->id_kelas = $request->id_kelas;
            $siswa->user_id = $request->user_id;
            $siswa->nama = $request->nama;
            $siswa->email = $request->email;
            $siswa->jenis_kelamin = $request->jenis_kelamin;
            $siswa->no_kontak = $request->no_kontak;
            $siswa->alamat = $request->alamat;
            $siswa->save();

            return redirect()->route('data-siswa.index')->with('success', 'Data siswa berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan data siswa!')->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $siswa = DataSiswa::find($id);
            $siswa->delete();
            return redirect()->route('data-siswa.index')->with('success', 'Data siswa berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data siswa!');
        }
    }

    public function edit(string $nis)
    {
        $siswa = DataSiswa::findOrFail($nis);
        $user_id = DataAkun::all();
        $id_kelas = DataKelas::all();
        return view('data-siswa.edit', compact('siswa', 'user_id', 'id_kelas'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        try {
            $siswa = DataSiswa::findOrFail($id);

            $siswa->nis = $request->nis;
            $siswa->id_kelas = $request->id_kelas;
            $siswa->user_id = $request->user_id;
            $siswa->nama = $request->nama;
            $siswa->email = $request->email;
            $siswa->jenis_kelamin = $request->jenis_kelamin;
            $siswa->no_kontak = $request->no_kontak;
            $siswa->alamat = $request->alamat;
            $siswa->save();

            return redirect()->route('data-siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data siswa!')->withInput();
        }
    }
}
