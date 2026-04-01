<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataBarang;
use App\Models\DataPenanggungJawab;
use App\Models\PemeliharaanBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemeliharaanBarangController extends Controller
{
    public function index()
    {
        $pemeliharaanBarangs = PemeliharaanBarang::with(['barang', 'penanggungjawab'])
            ->orderBy('tanggal_pemeliharaan', 'desc')
            ->get();

        return response()->json([
            'pemeliharaanBarangs' => $pemeliharaanBarangs,
        ]);    }

    public function create()
    {
        $kode_barang = DataBarang::select('kode_barang')->orderBy('kode_barang')->get();
        $id_pj = DataPenanggungJawab::select('id_pj','nama')->orderBy('nama')->get();

        return response()->json([
            'kode_barang' => $kode_barang,
            'id_pj' => $id_pj,
        ]);    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => ['required', 'exists:data_barang,kode_barang'],
            'id_pj' => ['required', 'exists:data_penanggung_jawab,id_pj'],
            'kegiatan_pemeliharaan' => ['required', 'string', 'max:255'],
            'tanggal_pemeliharaan' => ['required', 'date', 'before_or_equal:today'],
            'keterangan' => ['nullable', 'string'],
        ], [
            'kode_barang.required' => 'Barang wajib dipilih.',
            'kode_barang.exists' => 'Kode barang tidak ditemukan.',
            'id_pj.required' => 'Penanggung jawab wajib dipilih.',
            'id_pj.exists' => 'Penanggung jawab tidak valid.',
            'kegiatan_pemeliharaan.required' => 'Kegiatan pemeliharaan wajib diisi.',
            'tanggal_pemeliharaan.required' => 'Tanggal pemeliharaan wajib diisi.',
            'tanggal_pemeliharaan.date' => 'Format tanggal tidak valid.',
            'tanggal_pemeliharaan.before_or_equal' => 'Tanggal Harus Hari Ini Atau Sebelum Hari Ini.',
            
        ]);

        try {

            // Ambil pemeliharaan terakhir berdasarkan kode barang
            $last = PemeliharaanBarang::where('kode_barang', $request->kode_barang)
                ->orderBy('id_pemeliharaan', 'desc')
                ->first();

            if ($last) {
                $parts = explode('-', $last->id_pemeliharaan);
                $lastNumber = (int) end($parts);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            $formattedNumber = str_pad($newNumber, 2, '0', STR_PAD_LEFT);

            PemeliharaanBarang::create([
                'id_pemeliharaan' => 'PMH-' . $request->kode_barang . '-' . $formattedNumber,
                'kode_barang' => $request->kode_barang,
                'id_pj' => $request->id_pj,
                'kegiatan_pemeliharaan' => $request->kegiatan_pemeliharaan,
                'tanggal_pemeliharaan' => $request->tanggal_pemeliharaan,
                'keterangan' => $request->keterangan,
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Data pemeliharran barang berhasil ditambahkan!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menambahkan data pemeliharran barang!',
                
            ]);
        }
    }


  
   

    public function destroy($id)
    {
        try {

            $pemeliharaan = PemeliharaanBarang::findOrFail($id);
            $pemeliharaan->delete();

            return response()->json([
                'message' => 'Data pemeliharran barang berhasil dihapus!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus data pemeliharran barang!',
            ]);
        }
    }
}
