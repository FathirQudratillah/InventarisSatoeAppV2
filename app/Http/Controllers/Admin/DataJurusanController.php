<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\DataJurusan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DataJurusanController extends Controller
{
    public function index()
    {
        $jurusans = DataJurusan::All();
        return view('data-jurusan.index', compact('jurusans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data-jurusan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_jurusan' => 'required|max:3|unique:data_jurusan,id_jurusan',
            'jurusan' => 'required|unique:data_jurusan,jurusan',
        ], [
            'id_jurusan.required' => 'Id Jurusan wajib diisi.',
            'id_jurusan.max'      => 'Id Jurusan maksimal 3 huruf.',
            'id_jurusan.unique'   => 'Id Jurusan sudah terdaftar.',

            'jurusan.required' => 'Jurusan wajib diisi.',
            'jurusan.unique'   => 'Jurusan sudah terdaftar.',

        ]);
        try {
            $jurusan = new DataJurusan;
            $jurusan->id_jurusan = $request->id_jurusan;
            $jurusan->jurusan = $request->jurusan;
            $jurusan->save();

            return redirect()->route('data-jurusan.index')->with('success', 'Data jurusan berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan data jurusan!')->withInput();
        }
    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_jurusan)
    {
        $jurusan = DataJurusan::findOrFail($id_jurusan);
        return view('data-jurusan.edit', compact('jurusan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $request->validate([
            'id_jurusan' => [
                'required',
                'max:3',
                Rule::unique('data_jurusan', 'id_jurusan')
                    ->ignore($dataJurusan->id_jurusan, 'id_jurusan'),
            ],

            'jurusan' => [
                'required',
                Rule::unique('data_jurusan', 'jurusan')
                    ->ignore($dataJurusan->id_jurusan, 'id_jurusan'),
            ],
        ], [
            'id_jurusan.required' => 'Id Jurusan wajib diisi.',
            'id_jurusan.max'      => 'Id Jurusan maksimal 3 huruf.',
            'id_jurusan.unique'   => 'Id Jurusan sudah terdaftar.',

            'jurusan.required' => 'Jurusan wajib diisi.',
            'jurusan.unique'   => 'Jurusan sudah terdaftar.',
        ]);
        try {
            $jurusan = DataJurusan::findOrFail($id);



            $jurusan->id_jurusan = $request->id_jurusan;
            $jurusan->jurusan = $request->jurusan;
            $jurusan->save();

            return redirect()->route('data-jurusan.index')->with('success', 'Data jurusan berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data jurusan!')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_jurusan)
    {
        try {
            $jurusan = DataJurusan::findOrFail($id_jurusan);
            $jurusan->delete();
            return redirect()->route('data-jurusan.index')->with('success', 'Data jurusan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data jurusan!');
        }
    }
}
