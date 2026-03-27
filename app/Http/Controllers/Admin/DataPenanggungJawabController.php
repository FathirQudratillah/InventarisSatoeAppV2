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
        $penanggungJawabs = DataPenanggungJawab::All();
        return view('data-penanggung-jawab.index', compact('penanggungJawabs'));
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

            return redirect()->route('data-penanggung-jawab.index')
                ->with('success', 'Data penanggung jawab berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan data penanggung jawab!')
                ->withInput();
        }
    }

   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_pj)
    {
        $penanggung_jawab = DataPenanggungJawab::findOrFail($id_pj);
        return view('data-penanggung-jawab.edit', compact('penanggung_jawab'));
    }

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
                    ->ignore($penanggungJawab->id, 'id')
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

            return redirect()->route('data-penanggung-jawab.index')->with('success', 'Data penanggung jawab berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data penanggung jawab!')->withInput();
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
            return redirect()->route('data-penanggung-jawab.index')->with('success', 'Data penanggung jawab berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data penanggung jawab!');
        }
    }
}
