<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\DataBarang;
use App\Models\DataJenisBarang;
use App\Models\DataRuang;
use Illuminate\Http\Request;

class DataBarangController extends Controller
{
    public function index()
    {
        $barangs = DataBarang::All();
        return view('data-barang.index', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenis_barang = DataJenisBarang::All();
        $id_ruang = DataRuang::All();
        return view('data-barang.create', compact('jenis_barang', 'id_ruang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_ruang'         => 'required|exists:data_ruang,id_ruang',
            'jenis_barang'     => 'required|exists:data_jenis_barang,jenis_barang',
            'kondisi_barang'   => 'required|in:Baik,Rusak,Rusak Ringan',
            'tahun_perolehan'  => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'keterangan'       => 'nullable|string|max:255',
        ], [
            'id_ruang.required'        => 'Ruang wajib dipilih.',
            'id_ruang.exists'          => 'Ruang tidak valid.',

            'jenis_barang.required'    => 'Jenis barang wajib dipilih.',
            'jenis_barang.exists'      => 'Jenis barang tidak valid.',

            'kondisi_barang.required'  => 'Kondisi barang wajib dipilih.',
            'kondisi_barang.in'        => 'Kondisi barang tidak valid.',

            'tahun_perolehan.required' => 'Tahun perolehan wajib diisi.',
            'tahun_perolehan.integer'  => 'Tahun perolehan harus berupa angka.',
            'tahun_perolehan.digits'   => 'Tahun perolehan harus 4 digit.',
            'tahun_perolehan.min'      => 'Tahun perolehan tidak valid.',
            'tahun_perolehan.max'      => 'Tahun perolehan tidak boleh melebihi tahun sekarang.',

            'keterangan.max'           => 'Keterangan maksimal 255 karakter.',
        ]);

        try {
            $jenis = strtoupper($request->jenis_barang);

            // Ambil kode terakhir berdasarkan jenis
            $lastBarang = DataBarang::where('kode_barang', 'like', $jenis . '-%')
                ->orderBy('kode_barang', 'desc')
                ->first();

            if ($lastBarang) {
                // Ambil angka terakhir
                $lastNumber = (int) substr($lastBarang->kode_barang, -2);
                $newNumber = str_pad($lastNumber + 1, 2, '0', STR_PAD_LEFT);
            } else {
                $newNumber = '01';
            }

            $kodeBarang = $jenis . '-' . $newNumber;

            $barang = new DataBarang;
            $barang->kode_barang = $kodeBarang;
            $barang->id_ruang = $request->id_ruang;
            $barang->jenis_barang = $request->jenis_barang;
            $barang->kondisi_barang = $request->kondisi_barang;
            $barang->tahun_perolehan = $request->tahun_perolehan;
            $barang->keterangan = $request->keterangan;
            $barang->save();

            return redirect()->route('data-barang.index')->with('success', 'Data barang berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan data barang!')->withInput();
        }
    }

   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $kodeBarang)
    {
        $barang = DataBarang::findOrFail($kodeBarang);
        $jenis_barang = DataJenisBarang::All();
        $id_ruang = DataRuang::All();
        return view('data-barang.edit', compact('barang', 'jenis_barang', 'id_ruang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_ruang'         => 'required|exists:data_ruang,id_ruang',
            'jenis_barang'     => 'required|exists:data_jenis_barang,jenis_barang',
            'kondisi_barang'   => 'required|in:Baik,Rusak,Rusak Ringan',
            'tahun_perolehan'  => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'keterangan'       => 'nullable|string|max:255',
        ], [
            'id_ruang.required'        => 'Ruang wajib dipilih.',
            'id_ruang.exists'          => 'Ruang tidak valid.',

            'jenis_barang.required'    => 'Jenis barang wajib dipilih.',
            'jenis_barang.exists'      => 'Jenis barang tidak valid.',

            'kondisi_barang.required'  => 'Kondisi barang wajib dipilih.',
            'kondisi_barang.in'        => 'Kondisi barang tidak valid.',

            'tahun_perolehan.required' => 'Tahun perolehan wajib diisi.',
            'tahun_perolehan.integer'  => 'Tahun perolehan harus berupa angka.',
            'tahun_perolehan.digits'   => 'Tahun perolehan harus 4 digit.',
            'tahun_perolehan.min'      => 'Tahun perolehan tidak valid.',
            'tahun_perolehan.max'      => 'Tahun perolehan tidak boleh melebihi tahun sekarang.',

            'keterangan.max'           => 'Keterangan maksimal 255 karakter.',
        ]);
        try {
            $barang = DataBarang::findOrFail($id);


            $barang->id_ruang = $request->id_ruang;
            $barang->kondisi_barang = $request->kondisi_barang;
            $barang->tahun_perolehan = $request->tahun_perolehan;
            $barang->keterangan = $request->keterangan;
            $barang->save();

            return redirect()->route('data-barang.index')->with('success', 'Data barang berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data barang!')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $kodeBarang)
    {
        try {
            $barang = DataBarang::findOrFail($kodeBarang);
            $barang->delete();
            return redirect()->route('data-barang.index')->with('success', 'Data barang berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data barang!');
        }
    }
}
