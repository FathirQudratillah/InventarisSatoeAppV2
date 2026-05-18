<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataBarang;
use App\Models\DetailPeminjaman;

use App\Models\PeminjamanBarang;
use Illuminate\Http\Request;

class PeminjamanBarangController extends Controller
{
    public function index()
    {
        $peminjamanBarangs = PeminjamanBarang::All();
        return response()->json([
            'peminjamanBarangs' => $peminjamanBarangs,
        ]);    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kode_barangs = DataBarang::all();
        return response()->json([
            'kode_barangs' => $kode_barangs,
        ]);    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return response()->json([
        //     $request->kode_barang[0]["kode_barang"]
        // ]);
        
        $request->validate(
            [
                'kode_barang'   => ['required', 'array', 'min:1'],
                'kode_barang.*.kode_barang' => ['required', 'exists:data_barang,kode_barang'],

            ],
            [
                'kode_barang.required'   => 'Barang wajib dipilih.',
                'kode_barang.array'      => 'Format data barang tidak valid.',
                'kode_barang.min'        => 'Minimal pilih 1 barang.',
                'kode_barang.*.required' => 'Kode barang tidak boleh kosong.',
                'kode_barang.*.exists'   => 'Kode barang :input tidak terdaftar di data barang .',
            ]
        );
        $date = str_replace('-', '', $request->tanggal_peminjaman);
        $prefix = 'PMJ' . $date;
        $kode_barangs = $request->kode_barang;


        // cek barang sedang dipinjam
        foreach ($kode_barangs as $kode_barang) {

            $cek = DetailPeminjaman::where('kode_barang', $kode_barang["kode_barang"])->whereNull("kondisi_sesudah")
                ->exists();
 
            if ($cek) {
                return response()->json([
                    'message' => 'Barang ' . $kode_barang["kode_barang"] . ' masih dipinjam'
                ], 422);
            }
        }

        // generate id peminjaman
        $lastPeminjaman = PeminjamanBarang::where('id_peminjaman', 'like', $prefix . '%')
            ->orderBy('id_peminjaman', 'desc')
            ->first();

        $newNumberPMJ = $lastPeminjaman
            ? str_pad(((int) substr($lastPeminjaman->id_peminjaman, -2)) + 1, 2, '0', STR_PAD_LEFT)
            : '01';

        $id_peminjaman = $prefix . $newNumberPMJ;

        // simpan peminjaman
        $peminjaman = PeminjamanBarang::create([
            'id_peminjaman' => $id_peminjaman,
            'user_id' => auth()->user()->user_id,
            'status_peminjaman' => 'Pending',
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
        ]);

        $no = 1;

        foreach ($kode_barangs as $kode_barang) {

            $barang = DataBarang::findOrFail($kode_barang["kode_barang"]);

            $id_detail = 'DTL' . $id_peminjaman . str_pad($no, 2, '0', STR_PAD_LEFT);

            $peminjaman->detail()->create([
                'id_detail' => $id_detail,
                'kode_barang' => $kode_barang["kode_barang"],
                'kondisi_sebelum' => $barang->kondisi_barang,
            ]);

            $no++;
        }

        return response()->json([
            'message' => 'Permintaan Peminjaman Berhasil, Menunggu Persetujuan Admin',
        ]);    }

    /**
     * Display the specified resource.
     */
    public function accept(string $id)
    {

        $peminjaman = PeminjamanBarang::findOrFail($id);
        $peminjaman->data_admin = auth()->user()->user_id;
        $peminjaman->status_peminjaman = 'dipinjam';
        $peminjaman->save();

        return response()->json([
            'message' => 'Barang Berhasil Dipinjam',
        ]);
    }

    public function back(string $id)
    {
        try {

            $peminjaman = PeminjamanBarang::findOrFail($id);

            $peminjaman->update([
                'status_peminjaman' => 'menunggu_kembali'
            ]);

            return response()->json([
                'message' => 'Menunggu Persetujuan Admin',
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'message' => 'Gagal Mengirim Pengembalian',
            ]);
        }
    }

    public function kembalikan(string $id, Request $request)
    {
        try {

            $peminjaman = PeminjamanBarang::with('detail.barang')->findOrFail($id);

            $peminjaman->update([
                'status_peminjaman' => 'dikembalikan'
            ]);

            foreach ($peminjaman->detail as $detail) {
                $detail->update([
                    'kondisi_sesudah'=> $request->kondisi_barang
                ]);

                if ($detail->barang) {

                    $detail->barang->update([
                        'status_barang' => 'tersedia',
                        'kondisi_barang' => $request->kondisi_barang
                    ]);
                }
            }

            return response()->json([
                'message' => 'Barang Berhasil Dikembalikan',
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'message' => 'Gagal Menerima Pengembalian',
            ]);
        }
    }

    
}
