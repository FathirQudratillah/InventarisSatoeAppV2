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
        $kategoriBarangs = DataKategoriBarang::All();
        return view('data-kategori-barang.index', compact('kategoriBarangs'));
    }

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

            return redirect()->route('data-kategori-barang.index')->with('success', 'Data kategori barang berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan data kategori barang!')->withInput();
        }
    }

    /**
     
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_kategori)
    {
        $kategori_barang = DataKategoriBarang::findOrFail($id_kategori);
        return view('data-kategori-barang.edit', compact('kategori_barang'));
    }

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
                    ->ignore($dataKategoriBarang->id_kategori, 'id_kategori'),
            ],

            'kategori' => [
                'required',
                'string',
                'max:100',
                Rule::unique('data_kategori_barang', 'kategori')
                    ->ignore($dataKategoriBarang->id_kategori, 'id_kategori'),
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

            return redirect()->route('data-kategori-barang.index')->with('success', 'Data kategori barang berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data kategori barang!')->withInput();
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
            return redirect()->route('data-kategori-barang.index')->with('success', 'Data kategori barang berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data kategori barang!');
        }
    }
}
