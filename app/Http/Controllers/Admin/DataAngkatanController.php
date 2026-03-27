<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\DataAngkatan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DataAngkatanController extends Controller
{
    public function index()
    {
        $angkatans = DataAngkatan::All();
        return view('data-angkatan.index', compact('angkatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data-angkatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'angkatan'     => 'required|string|max:2|unique:data_angkatan,angkatan',
            'tahun_masuk'  => 'required|digits:4|unique:data_angkatan,tahun_masuk',
            'tahun_lulus'  => 'required|digits:4|unique:data_angkatan,tahun_lulus',
        ], [
            'angkatan.required' => 'Angkatan wajib diisi.',
            'angkatan.max'      => 'Angkatan maksimal 2 huruf.',
            'angkatan.unique'   => 'Angkatan sudah terdaftar.',

            'tahun_masuk.required' => 'Tahun masuk wajib diisi.',
            'tahun_masuk.digits'   => 'Tahun masuk harus 4 digit.',
            'tahun_masuk.unique'   => 'Tahun masuk sudah terdaftar.',

            'tahun_lulus.required' => 'Tahun lulus wajib diisi.',
            'tahun_lulus.digits'   => 'Tahun lulus harus 4 digit.',
            'tahun_lulus.unique'   => 'Tahun lulus sudah terdaftar.',
        ]);
        try {
            $angkatan = new DataAngkatan;
            $angkatan->angkatan = $request->angkatan;
            $angkatan->tahun_masuk = $request->tahun_masuk;
            $angkatan->tahun_lulus = $request->tahun_lulus;
            $angkatan->save();

            return redirect()->route('data-angkatan.index')->with('success', 'Data angkatan berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan data!')->withInput();
        }
    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $angkatan)
    {
        $angkatan = DataAngkatan::findOrFail($angkatan);
        return view('data-angkatan.edit', compact('angkatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'angkatan' => [
                'required',
                'string',
                'max:2',
                Rule::unique('data_angkatan', 'angkatan')
                    ->ignore($dataAngkatan->id_angkatan, 'id_angkatan'),
            ],

            'tahun_masuk' => [
                'required',
                'digits:4',
                Rule::unique('data_angkatan', 'tahun_masuk')
                    ->ignore($dataAngkatan->id_angkatan, 'id_angkatan'),
            ],

            'tahun_lulus' => [
                'required',
                'digits:4',
                Rule::unique('data_angkatan', 'tahun_lulus')
                    ->ignore($dataAngkatan->id_angkatan, 'id_angkatan'),
            ],
        ], [
            'angkatan.required' => 'Angkatan wajib diisi.',
            'angkatan.max'      => 'Angkatan maksimal 2 huruf.',
            'angkatan.unique'   => 'Angkatan sudah terdaftar.',

            'tahun_masuk.required' => 'Tahun masuk wajib diisi.',
            'tahun_masuk.digits'   => 'Tahun masuk harus 4 digit.',
            'tahun_masuk.unique'   => 'Tahun masuk sudah terdaftar.',

            'tahun_lulus.required' => 'Tahun lulus wajib diisi.',
            'tahun_lulus.digits'   => 'Tahun lulus harus 4 digit.',
            'tahun_lulus.unique'   => 'Tahun lulus sudah terdaftar.',
        ]);
        try {
            $angkatan = DataAngkatan::findOrFail($id);


            $angkatan->angkatan = $request->angkatan;
            $angkatan->tahun_masuk = $request->tahun_masuk;
            $angkatan->tahun_lulus = $request->tahun_lulus;
            $angkatan->save();

            return redirect()->route('data-angkatan.index')->with('success', 'Data angkatan berhasil diperbarui!');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Gagal memperbarui data!')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $angkatan)
    {
        try {
            $angkatan = DataAngkatan::findOrFail($angkatan);
            $angkatan->delete();

            return redirect()->route('data-angkatan.index')->with('success', 'Data angkatan berhasil dihapus!');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Gagal menghapus data!');
        }
    }
}
