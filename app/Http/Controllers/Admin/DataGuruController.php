<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\DataGuru;
use Illuminate\Http\Request;
use app\models\DataAkun;

class DataGuruController extends Controller
{
    public function index()
    {
        $gurus = DataGuru::All();
        return view('data-guru.index', compact('gurus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_id = DataAkun::all();
        return view('data-guru.create', compact('user_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $guru = new DataGuru;
            $guru->nip = $request->nip;
            $guru->user_id = $request->user_id;
            $guru->nama = $request->nama;
            $guru->email = $request->email;
            $guru->jenis_kelamin = $request->jenis_kelamin;
            $guru->no_kontak = $request->no_kontak;
            $guru->alamat = $request->alamat;
            $guru->save();

            return redirect()->route('data-guru.index')->with('success', 'Data guru berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan data guru!')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $nip)
    {
        $guru = DataGuru::findOrFail($nip);
        $user_id = DataAkun::all();
        return view('data-guru.edit', compact('guru', 'user_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $guru = DataGuru::findOrFail($id);

            $guru->nip = $request->nip;
            $guru->user_id = $request->user_id;
            $guru->nama = $request->nama;
            $guru->email = $request->email;
            $guru->jenis_kelamin = $request->jenis_kelamin;
            $guru->no_kontak = $request->no_kontak;
            $guru->alamat = $request->alamat;
            $guru->save();

            return redirect()->route('data-guru.index')->with('success', 'Data guru berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data guru!')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $guru = DataGuru::findOrFail($id);
            $guru->delete();
            return redirect()->route('data-guru.index')->with('success', 'Data guru berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data guru!');
        }
    }
}
