<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataJenisBarang;
use App\Models\DataKategoriBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DataJenisBarangController extends Controller
{
    public function index()
    {
        $jenisBarangs = DataJenisBarang::orderBy('id_kategori')->orderBy('jenis_barang')->get();
        return response()->json([
            'jenisBarangs' => $jenisBarangs,
        ]);    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenis_barang = DataJenisBarang::select('jenis_barang')->get();
        $id_kategori = DataKategoriBarang::select('id_kategori')->get();
        return response()->json([
            'jenis_barang' => $jenis_barang,
            'id_kategori' => $id_kategori,
        ]);    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_barang' => [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($request) {
                    // Ambil huruf ke-5,6,7
                    $kode = $request->id_kategori . '-' . $value;

                    $exists = DB::table('data_jenis_barang')
                        ->where('jenis_barang', $kode)
                        ->exists();

                    if ($exists) {
                        $fail('Kode jenis Barang sudah terdaftar.');
                    }
                }
            ],

            'id_kategori'   => 'required|exists:data_kategori_barang,id_kategori',
            'nama_barang'   => 'required|string|max:100',
            'sumber'        => 'required',
            'spesifikasi'   => 'nullable|string|max:255',
            'keterangan'    => 'nullable|string|max:255',
        ], [
            'id_kategori.required' => 'Kategori wajib dipilih.',
            'id_kategori.exists'   => 'Kategori tidak valid.',

            'nama_barang.required' => 'Nama barang wajib diisi.',
            'nama_barang.max'      => 'Nama barang maksimal 100 karakter.',

            'sumber.required'      => 'Sumber barang wajib dipilih.',

            'spesifikasi.max'      => 'Spesifikasi maksimal 255 karakter.',
            'keterangan.max'       => 'Keterangan maksimal 255 karakter.',
        ]);

        try {

            $id_jenis = $request->id_kategori . '-' . $request->jenis_barang;

            $jenis_barang = new DataJenisBarang;
            $jenis_barang->jenis_barang = $id_jenis;
            $jenis_barang->id_kategori = $request->id_kategori;
            $jenis_barang->nama_barang = $request->nama_barang;
            $jenis_barang->sumber = $request->sumber;
            $jenis_barang->spesifikasi = $request->spesifikasi;
            $jenis_barang->keterangan = $request->keterangan;
            $jenis_barang->save();

            return response()->json([
                'message' => 'Data jenis barang berhasil ditambahkan!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menambahkan data jenis barang!',
            ]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $jenis_barang)
    {
        $jenis_barang = DataJenisBarang::findOrFail($jenis_barang);
        return response()->json([
            
            'jenis_barang' => $jenis_barang,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        try {
            $jenis_barang = DataJenisBarang::findOrFail($id);



            $jenis_barang->nama_barang = $request->nama_barang;
            $jenis_barang->sumber = $request->sumber;
            $jenis_barang->spesifikasi = $request->spesifikasi;
            $jenis_barang->keterangan = $request->keterangan;
            $jenis_barang->save();

            return response()->json([
                'message' => 'Data jenis barang berhasil diperbarui!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal memperbarui data jenis barang!',
            ]);
        }  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $jenis_barang)
    {
        try {
            $jenis_barang = DataJenisBarang::findOrFail($jenis_barang);
            $jenis_barang->delete();
            return response()->json([
                'message' => 'Data jenis barang berhasil dihapus!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus data jenis barang!',
            ]);
        }
    }
}
