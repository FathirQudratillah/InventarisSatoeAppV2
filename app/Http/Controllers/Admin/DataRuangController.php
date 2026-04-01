<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataRuang;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class DataRuangController extends Controller
{
    public function index()
    {
        $ruangs = DataRuang::orderBy('jenis_ruang')->orderBy('id_ruang')->get();
        return response()->json([
            'ruangs' => $ruangs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data-ruang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_ruang'    => 'required|unique:data_ruang,id_ruang',
            'nama_ruang'  => 'required|unique:data_ruang,nama_ruang',
            'jenis_ruang' => 'required',
            'kapasitas'   => 'required|min:1|integer',
            'lokasi'      => 'required',
        ], [
            'id_ruang.required'    => 'ID Ruang wajib diisi.',
            'id_ruang.unique'      => 'ID Ruang sudah terdaftar.',

            'nama_ruang.required'  => 'Nama Ruang wajib diisi.',
            'nama_ruang.unique'    => 'Nama Ruang sudah terdaftar.',

            'jenis_ruang.required' => 'Jenis Ruang wajib dipilih.',

            'kapasitas.required'   => 'Kapasitas ruang wajib diisi.',
            'kapasitas.integer'   => 'Kapasitas ruang wajib angka.',

            'lokasi.required'      => 'Lokasi ruang wajib diisi.',
        ]);

        try {
            $ruang = new DataRuang;
            $ruang->id_ruang = $request->id_ruang;
            $ruang->nama_ruang = $request->nama_ruang;
            $ruang->jenis_ruang = $request->jenis_ruang;
            $ruang->kapasitas = $request->kapasitas;
            $ruang->lokasi = $request->lokasi;
            $ruang->save();

            return response()->json([
                'message' => 'Data ruang berhasil ditambahkan!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menambahkan data ruang!',
            ]);
        }
    }

    
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_ruang)
    {
        $ruang = DataRuang::findOrFail($id_ruang);
        return response()->json([
            'ruang' => $ruang,
        ]);    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_ruang' => [
                'required',
                Rule::unique('data_ruang', 'id_ruang')
                    ->ignore($id, 'id_ruang')
            ],

            'nama_ruang' => [
                'required',
                Rule::unique('data_ruang', 'nama_ruang')
                    ->ignore($id, 'id_ruang')
            ],

            'jenis_ruang' => 'required',

            'kapasitas' => 'required|integer|min:1',

            'lokasi' => 'required',
        ], [
            'id_ruang.required'    => 'ID Ruang wajib diisi.',
            'id_ruang.unique'      => 'ID Ruang sudah terdaftar.',

            'nama_ruang.required'  => 'Nama Ruang wajib diisi.',
            'nama_ruang.unique'    => 'Nama Ruang sudah terdaftar.',

            'jenis_ruang.required' => 'Jenis Ruang wajib dipilih.',

            'kapasitas.required'   => 'Kapasitas ruang wajib diisi.',
            'kapasitas.integer'    => 'Kapasitas ruang wajib angka.',
            'kapasitas.min'        => 'Kapasitas minimal 1.',

            'lokasi.required'      => 'Lokasi ruang wajib diisi.',
        ]);
        try {
            $ruang = DataRuang::findOrFail($id);

            $ruang->id_ruang = $request->id_ruang;
            $ruang->nama_ruang = $request->nama_ruang;
            $ruang->jenis_ruang = $request->jenis_ruang;
            $ruang->kapasitas = $request->kapasitas;
            $ruang->lokasi = $request->lokasi;
            $ruang->save();

            return response()->json([
                'message' => 'Data ruang berhasil diperbarui!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal memperbarui data ruang!',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_ruang)
    {
        try {
            $ruang = DataRuang::findOrFail($id_ruang);
            $ruang->delete();
            return response()->json([
                'message' => 'Data ruang berhasil dihapus!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus data ruang!',
            ]);
        }
    }
}
