<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataKategoriBarang;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DataKategoriBarangController extends Controller
{
    public function index()
    {
        $kategoriBarangs = DataKategoriBarang::orderBy('id_kategori')->get();
        return response()->json([
            'kategoriBarangs' => $kategoriBarangs,
        ]);    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data-kategori-barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => [
                'required',
                'string',
                'max:3',
                'unique:data_kategori_barang,id_kategori',
            ],
            'kategori' => [
                'required',
                'string',
                'max:100',
                'unique:data_kategori_barang,kategori',
            ],
        ], [
            'id_kategori.required' => 'ID kategori wajib diisi.',
            'id_kategori.max'      => 'ID kategori maksimal 3 karakter.',
            'id_kategori.unique'   => 'ID kategori sudah terdaftar.',

            'kategori.required' => 'Nama kategori wajib diisi.',
            'kategori.max'      => 'Nama kategori maksimal 100 karakter.',
            'kategori.unique'   => 'Nama kategori sudah terdaftar.',
        ]);

        try {
            $kategori_barang = new DataKategoriBarang;
            $kategori_barang->id_kategori = $request->id_kategori;
            $kategori_barang->kategori = $request->kategori;
            $kategori_barang->save();

            return response()->json([
                'message' => 'Data kategori barang berhasil ditambahkan!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menambahkan data kategori barang!',
            ]);
        }
    }

    /**
     
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_kategori)
    {
        $kategori_barang = DataKategoriBarang::findOrFail($id_kategori);
        return response()->json([
            'kategori_barang' => $kategori_barang,
        ]);    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_kategori' => [
                'required',
                'string',
                'max:3',
                Rule::unique('data_kategori_barang', 'id_kategori')
                    ->ignore($id, 'id_kategori'),
            ],

            'kategori' => [
                'required',
                'string',
                'max:100',
                Rule::unique('data_kategori_barang', 'kategori')
                    ->ignore($id, 'id_kategori'),
            ],
        ], [
            'id_kategori.required' => 'ID kategori wajib diisi.',
            'id_kategori.max'      => 'ID kategori maksimal 3 karakter.',
            'id_kategori.unique'   => 'ID kategori sudah terdaftar.',

            'kategori.required' => 'Nama kategori wajib diisi.',
            'kategori.max'      => 'Nama kategori maksimal 100 karakter.',
            'kategori.unique'   => 'Nama kategori sudah terdaftar.',
        ]);
        try {
            $kategori_barang = DataKategoriBarang::findOrFail($id);

            $request->validate([
                'id_kategori' => 'required',
                'kategori' => 'required',
            ]);

            $kategori_barang->id_kategori = $request->id_kategori;
            $kategori_barang->kategori = $request->kategori;
            $kategori_barang->save();

            return response()->json([
                'message' => 'Data kategori barang berhasil diperbarui!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal memperbarui data kategori barang!',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_kategori)
    {
        try {
            $kategori_barang = DataKategoriBarang::findOrFail($id_kategori);
            $kategori_barang->delete();
            return response()->json([
                'message' => 'Data kategori barang berhasil dihapus!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus data kategori barang!',
            ]);
        }
    }
}
