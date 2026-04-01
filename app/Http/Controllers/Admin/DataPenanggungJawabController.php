<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataPenanggungJawab;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DataPenanggungJawabController extends Controller
{
    public function index()
    {
        $penanggungJawabs = DataPenanggungJawab::orderBy('id_pj')->get();
        return response()->json([
            'penanggungJawabs' => $penanggungJawabs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data-penanggung-jawab.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nama_perusahaan' => 'required',
            'alamat_perusahaan' => 'required',
            'no_kontak' => 'required|unique:data_penanggung_jawab,no_kontak',
        ], [
            'nama.required'              => 'Nama wajib diisi.',
            'nama_perusahaan.required'   => 'Nama perusahaan wajib diisi.',
            'alamat_perusahaan.required' => 'Alamat perusahaan wajib diisi.',
            'no_kontak.required'         => 'No kontak wajib diisi.',
            'no_kontak.unique'           => 'No kontak sudah terdaftar.',
        ]);

        try {
            $lastPj = DataPenanggungJawab::orderBy('id_pj', 'desc')->first();

            $lastNumber = $lastPj
                ? (int) str_replace('PJ', '', $lastPj->id_pj)
                : 0;

            $id_pj = 'PJ' . str_pad($lastNumber + 1, 2, '0', STR_PAD_LEFT);

            DataPenanggungJawab::create([
                'id_pj' => $id_pj,
                'nama' => $request->nama,
                'nama_perusahaan' => $request->nama_perusahaan,
                'alamat_perusahaan' => $request->alamat_perusahaan,
                'no_kontak' => $request->no_kontak,
            ]);

            return response()->json([
                'message' => 'Data penanggung jawab berhasil ditambahkan!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menambahkan data penanggung jawab!',
            ]);
        }
    }

   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_pj)
    {
        $penanggung_jawab = DataPenanggungJawab::findOrFail($id_pj);
        return response()->json([
            'penanggung_jawab' => $penanggung_jawab,
        ]);    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'nama_perusahaan' => 'required|string|max:150',
            'alamat_perusahaan' => 'required|string|max:255',
            'no_kontak' => [
                'required',
                Rule::unique('data_penanggung_jawab', 'no_kontak')
                    ->ignore($id, 'id_pj')
            ],
        ], [
            'nama.required'              => 'Nama wajib diisi.',
            'nama_perusahaan.required'   => 'Nama perusahaan wajib diisi.',
            'alamat_perusahaan.required' => 'Alamat perusahaan wajib diisi.',
            'no_kontak.required'         => 'No kontak wajib diisi.',
            'no_kontak.unique'           => 'No kontak sudah terdaftar.',
        ]);
        try {
            $penanggung_jawab = DataPenanggungJawab::findOrFail($id);


            $penanggung_jawab->nama = $request->nama;
            $penanggung_jawab->nama_perusahaan = $request->nama_perusahaan;
            $penanggung_jawab->alamat_perusahaan = $request->alamat_perusahaan;
            $penanggung_jawab->no_kontak = $request->no_kontak;
            $penanggung_jawab->save();

            return response()->json([
                'message' => 'Data penanggung jawab berhasil diperbarui!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal memperbarui data penanggung jawab!',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_pj)
    {
        try {
            $penanggung_jawab = DataPenanggungJawab::findOrFail($id_pj);
            $penanggung_jawab->delete();
            return response()->json([
                'message' => 'Data penanggung jawab berhasil dihapus!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus data penanggung jawab!',
            ]);
        }
    }
}
