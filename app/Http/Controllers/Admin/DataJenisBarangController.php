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
        $jenisBarangs = DataJenisBarang::All();
        return view('data-jenis-barang.index', compact('jenisBarangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenis_barang = DataJenisBarang::All();
        $id_kategori = DataKategoriBarang::All();
        return view('data-jenis-barang.create', compact('jenis_barang', 'id_kategori'));
    }

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

            return redirect()->route('data-jenis-barang.index')->with('success', 'Data jenis barang berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan data jenis barang!')->withInput();
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $jenis_barang)
    {
        $jenis_barang = DataJenisBarang::findOrFail($jenis_barang);
        $id_kategori = DataKategoriBarang::All();
        return view('data-jenis-barang.edit', compact('jenis_barang', 'id_kategori'));
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
            $jenis_barang = DataJenisBarang::findOrFail($id);



            $jenis_barang->nama_barang = $request->nama_barang;
            $jenis_barang->sumber = $request->sumber;
            $jenis_barang->spesifikasi = $request->spesifikasi;
            $jenis_barang->keterangan = $request->keterangan;
            $jenis_barang->save();

            return redirect()->route('data-jenis-barang.index')->with('success', 'Data jenis barang berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data jenis barang!')->withInput();
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
            return redirect()->route('data-jenis-barang.index')->with('success', 'Data jenis barang berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data jenis barang!');
        }
    }
}
